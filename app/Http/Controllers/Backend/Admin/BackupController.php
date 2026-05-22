<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupController extends Controller
{
    protected $backupPath = 'backups';

    public function index()
    {
        // 1. Get database size and stats
        $dbName = DB::connection()->getDatabaseName();
        $tables = DB::select('SHOW TABLE STATUS');
        
        $totalSize = 0; // in bytes
        $tableCount = count($tables);
        $totalRows = 0;

        foreach ($tables as $table) {
            $totalSize += $table->Data_length + $table->Index_length;
            $totalRows += $table->Rows;
        }

        $dbSizeFormatted = $this->formatBytes($totalSize);

        // 2. Get backup files list
        $disk = Storage::disk('local');
        if (!$disk->exists($this->backupPath)) {
            $disk->makeDirectory($this->backupPath);
        }

        $files = $disk->files($this->backupPath);
        $backups = [];

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $backups[] = [
                    'filename' => basename($file),
                    'size' => $this->formatBytes($disk->size($file)),
                    'created_at' => Carbon::createFromTimestamp($disk->lastModified($file))->format('Y-m-d H:i:s'),
                    'raw_time' => $disk->lastModified($file)
                ];
            }
        }

        // Sort backups by latest first
        usort($backups, fn($a, $b) => $b['raw_time'] <=> $a['raw_time']);

        $dbEngine = DB::connection()->getDriverName();

        return view('backend.admin.backup.index', compact('backups', 'dbName', 'dbSizeFormatted', 'tableCount', 'totalRows', 'dbEngine'));
    }

    public function run()
    {
        try {
            $dbName = DB::connection()->getDatabaseName();
            $tables = DB::select('SHOW TABLES');
            $tablesKey = 'Tables_in_' . $dbName;
            
            $sqlDump = "-- Mal Bali Galeria Database Backup\n";
            $sqlDump .= "-- Generated: " . Carbon::now()->toDateTimeString() . "\n";
            $sqlDump .= "-- Database: {$dbName}\n";
            $sqlDump .= "-- ------------------------------------------------------\n\n";
            $sqlDump .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $tableObj) {
                $tableName = $tableObj->$tablesKey;

                // Structure
                $sqlDump .= "--\n-- Table structure for table `{$tableName}`\n--\n\n";
                $sqlDump .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
                
                $createTableQuery = DB::select("SHOW CREATE TABLE `{$tableName}`");
                $createTableKey = 'Create Table';
                $sqlDump .= $createTableQuery[0]->$createTableKey . ";\n\n";

                // Data (Chunked query to prevent memory limits)
                $sqlDump .= "--\n-- Dumping data for table `{$tableName}`\n--\n\n";
                
                DB::table($tableName)->orderBy(DB::raw('1'))->chunk(500, function ($rows) use (&$sqlDump, $tableName) {
                    if ($rows->count() > 0) {
                        $sqlDump .= "INSERT INTO `{$tableName}` VALUES \n";
                        $rowLines = [];

                        foreach ($rows as $row) {
                            $values = [];
                            foreach ((array) $row as $val) {
                                if (is_null($val)) {
                                    $values[] = "NULL";
                                } elseif (is_numeric($val)) {
                                    $values[] = $val;
                                } else {
                                    // Escape string values safely
                                    $escaped = str_replace(
                                        ['\\', "\0", "\n", "\r", "'", '"', "\x1a"],
                                        ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'],
                                        $val
                                    );
                                    $values[] = "'{$escaped}'";
                                }
                            }
                            $rowLines[] = "(" . implode(", ", $values) . ")";
                        }

                        $sqlDump .= implode(",\n", $rowLines) . ";\n";
                    }
                });

                $sqlDump .= "\n";
            }

            $sqlDump .= "SET FOREIGN_KEY_CHECKS=1;\n";

            // Save file
            $filename = 'backup_mbg_' . Carbon::now()->format('Y-m-d_His') . '.sql';
            Storage::disk('local')->put($this->backupPath . '/' . $filename, $sqlDump);

            return response()->json(['success' => "Backup `{$filename}` generated successfully."]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Backup generation failed: ' . $e->getMessage()], 500);
        }
    }

    public function download($filename)
    {
        $filePath = $this->backupPath . '/' . $filename;
        if (Storage::disk('local')->exists($filePath)) {
            return Storage::disk('local')->download($filePath);
        }
        abort(404, 'Backup file not found.');
    }

    public function delete($filename)
    {
        $filePath = $this->backupPath . '/' . $filename;
        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
            return response()->json(['success' => 'Backup file deleted successfully.']);
        }
        return response()->json(['error' => 'Backup file not found.'], 404);
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
