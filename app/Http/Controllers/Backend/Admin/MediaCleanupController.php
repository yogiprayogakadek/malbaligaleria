<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MediaCleanupController extends Controller
{
    protected $directories = [
        'tenant_images'  => 'Tenant Images',
        'event_images'   => 'Event Photos',
        'gallery_images' => 'Gallery Images',
        'promo_images'   => 'Promo Banners',
        'career/cv'      => 'CV Uploads'
    ];

    public function index()
    {
        $orphanedFiles = $this->scanOrphanedFiles();

        $stats = [
            'total_count' => count($orphanedFiles),
            'total_size' => $this->formatBytes(array_sum(array_column($orphanedFiles, 'raw_size'))),
            'by_category' => []
        ];

        foreach ($this->directories as $dir => $label) {
            $catFiles = array_filter($orphanedFiles, fn($f) => $f['category'] === $label);
            $stats['by_category'][$label] = [
                'count' => count($catFiles),
                'size' => $this->formatBytes(array_sum(array_column($catFiles, 'raw_size')))
            ];
        }

        return view('backend.admin.media-cleanup.index', compact('orphanedFiles', 'stats'));
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        $path = $request->path;

        // Security check: ensure path is inside allowed directories
        $valid = false;
        foreach (array_keys($this->directories) as $dir) {
            if (str_starts_with($path, $dir)) {
                $valid = true;
                break;
            }
        }

        if (!$valid) {
            return response()->json(['error' => 'Invalid file path.'], 400);
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return response()->json(['success' => 'Orphaned media file deleted successfully.']);
        }

        return response()->json(['error' => 'File not found on disk.'], 404);
    }

    public function destroyMass(Request $request)
    {
        $orphanedFiles = $this->scanOrphanedFiles();
        $deletedCount = 0;

        foreach ($orphanedFiles as $file) {
            $path = $file['path'];
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                $deletedCount++;
            }
        }

        return response()->json(['success' => "Successfully deleted {$deletedCount} orphaned media files."]);
    }

    private function scanOrphanedFiles()
    {
        // 1. Gather all database paths
        $dbPaths = array_merge(
            DB::table('tenant_photos')->pluck('path')->toArray(),
            DB::table('event_photos')->pluck('path')->toArray(),
            DB::table('galleries')->pluck('path')->toArray(),
            DB::table('promos')->whereNotNull('banner')->pluck('banner')->toArray(),
            DB::table('job_applications')->whereNotNull('cv_path')->pluck('cv_path')->toArray()
        );

        // Normalize DB paths for fast lookup
        $normalizedDbPaths = [];
        foreach ($dbPaths as $path) {
            if (!empty($path)) {
                $pathLower = strtolower($path);
                $normalizedDbPaths[$pathLower] = true;
                $normalizedDbPaths[strtolower(basename($path))] = true;
            }
        }

        $orphaned = [];
        $disk = Storage::disk('public');

        // 2. Scan physical directories
        foreach ($this->directories as $folder => $label) {
            if ($disk->exists($folder)) {
                $files = $disk->allFiles($folder);

                foreach ($files as $file) {
                    $fileLower = strtolower($file);
                    $fileBaseLower = strtolower(basename($file));

                    // If file is not in database paths
                    if (!isset($normalizedDbPaths[$fileLower]) && !isset($normalizedDbPaths[$fileBaseLower])) {
                        // Skip system files like .gitignore or .DS_Store
                        if ($fileBaseLower === '.gitignore' || $fileBaseLower === '.ds_store') {
                            continue;
                        }

                        $size = $disk->size($file);
                        $lastModified = $disk->lastModified($file);

                        $orphaned[] = [
                            'path' => $file,
                            'filename' => basename($file),
                            'category' => $label,
                            'size' => $this->formatBytes($size),
                            'raw_size' => $size,
                            'modified_at' => Carbon::createFromTimestamp($lastModified)->format('Y-m-d H:i:s'),
                            'raw_time' => $lastModified
                        ];
                    }
                }
            }
        }

        // Sort by last modified date (newest first)
        usort($orphaned, fn($a, $b) => $b['raw_time'] <=> $a['raw_time']);

        return $orphaned;
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
