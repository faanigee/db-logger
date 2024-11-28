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
        $query = Log::query();

        // Apply filters
        if ($request->has('level') && $request->level != null) {
            $query->level($request->level);
        }

        if ($request->has('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        $logs = $query->orderBy('created_at', 'desc')
            ->paginate(config('dblogger.pagination.per_page', 15));

        return view('dblogger::logs.index', compact('logs'));
    }

    /**
     * Display the specified log.
     */
    public function show($log)
    {
        $log = Log::find($log);
        // dd($log);
        return view('dblogger::logs.show', compact('log'));
    }
}