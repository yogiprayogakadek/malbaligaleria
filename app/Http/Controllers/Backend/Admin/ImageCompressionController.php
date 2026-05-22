<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ImageCompressionController extends Controller
{
    protected $directories = [
        'tenant_images'  => 'Tenant Images',
        'event_images'   => 'Event Photos',
        'gallery_images' => 'Gallery Images',
        'promo_images'   => 'Promo Banners'
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $images = $this->scanImages();

            return \Yajra\DataTables\DataTables::of($images)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="checkbox" data-path="' . e($row['path']) . '">';
                })
                ->addColumn('thumbnail', function ($row) {
                    $url = asset('storage/' . $row['path']);
                    return '<img src="' . $url . '" alt="Preview" class="img-thumbnail img-fluid" style="max-height: 50px; cursor: zoom-in;" onclick="zoomImage(\'' . $url . '\')">';
                })
                ->addColumn('action', function ($row) {
                    return '<button type="button" class="btn btn-sm btn-primary btn-compress" data-path="' . e($row['path']) . '"><i class="ti ti-minimize"></i> Compress</button>';
                })
                ->rawColumns(['checkbox', 'thumbnail', 'action'])
                ->make(true);
        }

        $allImages = $this->scanImages();
        $stats = [
            'total_count' => count($allImages),
            'total_size' => $this->formatBytes(array_sum(array_column($allImages, 'raw_size'))),
            'raw_total_size' => array_sum(array_column($allImages, 'raw_size')),
        ];

        return view('backend.admin.image-compression.index', compact('stats'));
    }

    public function compress(Request $request)
    {
        if (!extension_loaded('gd')) {
            return response()->json(['error' => 'PHP GD extension is not enabled on this server. Please enable the GD extension in php.ini or your cPanel PHP Extensions manager.'], 422);
        }

        $request->validate([
            'path' => 'required|string'
        ]);

        $path = $request->path;

        if (!$this->isValidPath($path)) {
            return response()->json(['error' => 'Invalid file path.'], 400);
        }

        $result = $this->compressSingleImage($path);
        if ($result) {
            return response()->json([
                'success' => 'Image compressed successfully.',
                'original_size' => $this->formatBytes($result['original_size']),
                'new_size' => $this->formatBytes($result['new_size']),
                'savings' => $this->formatBytes($result['savings']),
                'percentage' => round(($result['savings'] / ($result['original_size'] ?: 1)) * 100, 1) . '%'
            ]);
        }

        return response()->json(['error' => 'Could not compress image (format not supported or file inaccessible).'], 422);
    }

    public function compressSelected(Request $request)
    {
        if (!extension_loaded('gd')) {
            return response()->json(['error' => 'PHP GD extension is not enabled on this server. Please enable the GD extension in php.ini or your cPanel PHP Extensions manager.'], 422);
        }

        $request->validate([
            'paths' => 'required|array',
            'paths.*' => 'string'
        ]);

        $paths = $request->paths;
        $totalOriginal = 0;
        $totalNew = 0;
        $compressedCount = 0;

        foreach ($paths as $path) {
            if ($this->isValidPath($path)) {
                $res = $this->compressSingleImage($path);
                if ($res) {
                    $totalOriginal += $res['original_size'];
                    $totalNew += $res['new_size'];
                    $compressedCount++;
                }
            }
        }

        $savings = $totalOriginal - $totalNew;

        return response()->json([
            'success' => "Successfully compressed {$compressedCount} images.",
            'compressed_count' => $compressedCount,
            'original_size' => $this->formatBytes($totalOriginal),
            'new_size' => $this->formatBytes($totalNew),
            'savings' => $this->formatBytes($savings),
            'percentage' => $totalOriginal > 0 ? round(($savings / $totalOriginal) * 100, 1) . '%' : '0%'
        ]);
    }

    private function isValidPath($path)
    {
        foreach (array_keys($this->directories) as $dir) {
            if (str_starts_with($path, $dir)) {
                return true;
            }
        }
        return false;
    }

    private function compressSingleImage($filePath, $quality = 70)
    {
        $disk = Storage::disk('public');
        $absolutePath = $disk->path($filePath);

        if (!file_exists($absolutePath)) {
            return false;
        }

        $info = @getimagesize($absolutePath);
        if (!$info) {
            return false;
        }

        $mime = $info['mime'];
        $originalSize = filesize($absolutePath);

        switch ($mime) {
            case 'image/jpeg':
                $image = @imagecreatefromjpeg($absolutePath);
                if ($image) {
                    @imagejpeg($image, $absolutePath, $quality);
                    @imagedestroy($image);
                } else {
                    return false;
                }
                break;
            case 'image/png':
                $image = @imagecreatefrompng($absolutePath);
                if ($image) {
                    @imagealphablending($image, false);
                    @imagesavealpha($image, true);
                    @imagepng($image, $absolutePath, 7);
                    @imagedestroy($image);
                } else {
                    return false;
                }
                break;
            case 'image/webp':
                $image = @imagecreatefromwebp($absolutePath);
                if ($image) {
                    @imagewebp($image, $absolutePath, $quality);
                    @imagedestroy($image);
                } else {
                    return false;
                }
                break;
            default:
                return false;
        }

        clearstatcache();
        $newSize = filesize($absolutePath);

        return [
            'original_size' => $originalSize,
            'new_size' => $newSize,
            'savings' => max(0, $originalSize - $newSize)
        ];
    }

    private function scanImages()
    {
        $disk = Storage::disk('public');
        $images = [];

        foreach ($this->directories as $folder => $label) {
            if ($disk->exists($folder)) {
                $files = $disk->allFiles($folder);

                foreach ($files as $file) {
                    $fileBaseLower = strtolower(basename($file));
                    $ext = pathinfo($fileBaseLower, PATHINFO_EXTENSION);

                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                        if ($disk->exists($file)) {
                            $size = $disk->size($file);
                            $lastModified = $disk->lastModified($file);
                            $absolutePath = $disk->path($file);

                            $resolution = 'Unknown';
                            $dimensions = @getimagesize($absolutePath);
                            if ($dimensions) {
                                $resolution = $dimensions[0] . ' x ' . $dimensions[1];
                            }

                            $images[] = [
                                'path' => $file,
                                'filename' => basename($file),
                                'category' => $label,
                                'size' => $this->formatBytes($size),
                                'raw_size' => $size,
                                'resolution' => $resolution,
                                'modified_at' => Carbon::createFromTimestamp($lastModified)->format('Y-m-d H:i:s'),
                                'raw_time' => $lastModified
                            ];
                        }
                    }
                }
            }
        }

        usort($images, fn($a, $b) => $b['raw_size'] <=> $a['raw_size']);

        return $images;
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
