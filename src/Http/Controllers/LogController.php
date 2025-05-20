<?php

namespace Faanigee\DbLogger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Faanigee\DbLogger\Models\Log;

class LogController extends Controller
{
    /**
     * Display a listing of the logs.
     */
    public function index(Request $request)
    {
        // Get settings
        $settings = config('dblogger');

        // Get filter values from request if filters are enabled
        $filters = ($settings['enable_filters'] ?? true) ? $this->getFilters($request) : [];

        // Get unique ref_types from logs table if filters are enabled
        $types = ($settings['enable_filters'] ?? true)
            ? Log::distinct()->pluck('ref_type')->filter()->values()->toArray()
            : [];

        // Build query with filters
        $query = $this->buildQuery($filters);

        // Get paginated results
        $logs = $query->orderBy('created_at', 'desc')
            ->paginate($settings['per_page'])
            ->withQueryString(); // This preserves query parameters in pagination links

        return view('dblogger::logs.index', [
            'logs' => $logs,
            'filters' => $filters, // Pass filters to view to maintain input values
            'types' => $types
        ]);
    }

    /**
     * Get filter values from request
     */
    private function getFilters(Request $request): array
    {
        return [
            'level' => $request->get('level'),
            'ref_type' => $request->get('ref_type'),
            'ref_no' => $request->get('ref_no'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date')
        ];
    }

    /**
     * Build query with filters
     */
    private function buildQuery(array $filters)
    {
        $query = Log::query();

        // Apply level filter
        if (!empty($filters['level'])) {
            $query->level($filters['level']);
        }

        // Apply type filter
        if (!empty($filters['ref_type'])) {
            $query->where('ref_type', $filters['ref_type']);
        }

        // Apply reference number filter
        if (!empty($filters['ref_no'])) {
            $query->where(function ($q) use ($filters) {
                $q->RefId($filters['ref_no'])
                    ->orWhere('ref_id', 'LIKE', '%' . $filters['ref_no'] . '%');
            });
        }

        // Apply date range filters
        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        return $query;
    }

    /**
     * Display the specified log.
     */
    public function show($log)
    {
        $pageConfigs = [
            'myLayout' => 'blank',
            'myStyle' => config('dblogger.myStyle'),
            'contentLayout' => 'wide'
        ];

        $log = Log::findOrFail($log);

        return view('dblogger::logs.show', compact('log', 'pageConfigs'));
    }
}
