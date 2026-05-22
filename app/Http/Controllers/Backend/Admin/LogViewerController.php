<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class LogViewerController extends Controller
{
    public function index(Request $request)
    {
        $levelFilter = $request->get('level', 'all');
        $search = $request->get('search', '');

        $logs = $this->parseLogs(500);

        // Filter by Level and Search Keyword
        $filteredLogs = [];
        foreach ($logs as $log) {
            if ($levelFilter !== 'all' && strtolower($log['level']) !== strtolower($levelFilter)) {
                continue;
            }

            if (!empty($search)) {
                $searchLower = strtolower($search);
                $messageMatch = strpos(strtolower($log['message']), $searchLower) !== false;
                $stackMatch = strpos(strtolower($log['stack']), $searchLower) !== false;
                $timeMatch = strpos(strtolower($log['timestamp']), $searchLower) !== false;

                if (!$messageMatch && !$stackMatch && !$timeMatch) {
                    continue;
                }
            }

            $filteredLogs[] = $log;
        }

        $logLevels = [
            'EMERGENCY' => 'danger',
            'ALERT'     => 'danger',
            'CRITICAL'  => 'danger',
            'ERROR'     => 'danger',
            'WARNING'   => 'warning',
            'NOTICE'    => 'info',
            'INFO'      => 'info',
            'DEBUG'     => 'secondary'
        ];

        // Stats
        $stats = [
            'total' => count($logs),
            'filtered' => count($filteredLogs),
            'errors' => count(array_filter($logs, fn($l) => in_array($l['level'], ['ERROR', 'CRITICAL', 'ALERT', 'EMERGENCY']))),
            'warnings' => count(array_filter($logs, fn($l) => $l['level'] === 'WARNING')),
        ];

        return view('backend.admin.log-viewer.index', compact('filteredLogs', 'levelFilter', 'search', 'logLevels', 'stats'));
    }

    public function clear()
    {
        $logPath = storage_path('logs/laravel.log');
        if (file_exists($logPath)) {
            File::put($logPath, '');
            return response()->json(['success' => 'Log file cleared successfully.']);
        }
        return response()->json(['error' => 'Log file not found.'], 404);
    }

    private function parseLogs($limit = 500)
    {
        $logPath = storage_path('logs/laravel.log');
        if (!file_exists($logPath)) {
            return [];
        }

        $fileSize = filesize($logPath);
        $maxRead = 5 * 1024 * 1024; // 5MB limit for performance safety

        $handle = fopen($logPath, 'r');
        if (!$handle) {
            return [];
        }

        if ($fileSize > $maxRead) {
            fseek($handle, -$maxRead, SEEK_END);
            // Skip the first partial line
            fgets($handle);
        }

        $entries = [];
        $currentEntry = null;

        while (($line = fgets($handle)) !== false) {
            // Check if line matches Laravel's log header format
            if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.*)/', $line, $matches)) {
                if ($currentEntry) {
                    $entries[] = $currentEntry;
                }
                $currentEntry = [
                    'timestamp' => $matches[1],
                    'env' => $matches[2],
                    'level' => strtoupper($matches[3]),
                    'message' => trim($matches[4]),
                    'stack' => ''
                ];
            } else {
                if ($currentEntry) {
                    $currentEntry['stack'] .= $line;
                }
            }
        }
        if ($currentEntry) {
            $entries[] = $currentEntry;
        }
        fclose($handle);

        // Reverse to display latest logs first
        $entries = array_reverse($entries);

        return array_slice($entries, 0, $limit);
    }
}
