@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

@php
// $configData = Helper::appClasses();
// dd($configData);
$contentLayout = "layout-wide";
@endphp

@extends('dblogger::layouts.master')

@section('title', 'System Logs')

@section('styles')
<style>
	.page-link {
		padding: 0.5rem 1rem;
		color: #6c757d;
		background-color: #fff;
		border: 1px solid #dee2e6;
		margin: 0 2px;
	}

	.page-link:hover {
		background-color: #e9ecef;
		color: #0056b3;
	}

	.page-item.active .page-link {
		background-color: #007bff;
		border-color: #007bff;
		color: #fff;
	}

	.table th {
		white-space: nowrap;
	}
</style>
@endsection

@section('content')
<div class="card shadow-sm">
	<div class="card-header d-flex justify-content-between align-items-center">
		<h5 class="mb-0">System Logs</h5>
	</div>
	<div class="card-body">
		<form action="{{ route('dblogger.logs.index') }}" method="GET" class="mb-4">
			<div class="row g-2 align-items-end">
				<div class="col-md-2">
					<label for="level" class="form-label">Log Level</label>
					<select name="level" id="level" class="form-select">
						<option value="">All Levels</option>
						@foreach(['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'] as $level)
						<option value="{{ $level }}" {{ isset($filters['level']) && $filters['level']==$level ? 'selected' : '' }}>
							{{ ucfirst($level) }}
						</option>
						@endforeach
					</select>
				</div>

				<div class="col-md-2">
					<label for="ref_type" class="form-label">Type</label>
					<select name="ref_type" id="ref_type" class="form-select">
						<option value="">All Types</option>
						@foreach($types as $type)
						<option value="{{ $type }}" {{ isset($filters['ref_type']) && $filters['ref_type']==$type ? 'selected' : ''
							}}>
							{{ $type }}
						</option>
						@endforeach
					</select>
				</div>

				<div class="col-md-2">
					<label for="ref_no" class="form-label">Reference No.</label>
					<input type="text" name="ref_no" id="ref_no" class="form-control" value="{{ $filters['ref_no'] ?? '' }}"
						placeholder="Enter ref no">
				</div>

				<div class="col-md-2">
					<label for="start_date" class="form-label">Start Date</label>
					<input type="date" name="start_date" id="start_date" class="form-control"
						value="{{ $filters['start_date'] ?? '' }}">
				</div>

				<div class="col-md-2">
					<label for="end_date" class="form-label">End Date</label>
					<input type="date" name="end_date" id="end_date" class="form-control"
						value="{{ $filters['end_date'] ?? '' }}">
				</div>

				<div class="col-md-2 d-flex gap-2">
					<button type="submit" class="btn btn-primary flex-grow-1">Apply</button>
					<a href="{{ route('dblogger.logs.index') }}" class="btn btn-secondary flex-grow-1">Reset</a>
				</div>
			</div>
		</form>

		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Date</th>
						<th>Ref #</th>
						<th>Type</th>
						<th>Level</th>
						<th style="min-width: 300px;">Message</th>
						<th>Created By</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($logs as $log)
					<tr>
						<td>{{ $log->created_at->format('d-m-Y') }}</td>
						<td>{{ $log->ref_id ?? '-' }}</td>
						<td>{{ $log->ref_type ?? '-' }}</td>
						<td><span class="badge bg-{{ ($log->level == 'error') ? 'danger' : 'info' }}">{{ $log->level }}</span></td>
						<td>{{ Str::limit($log->message, 100) }}</td>
						<td>{{ $log->user_name ?? 'System' }}</td>
						<td><span class="badge bg-{{ ($log->level == 'error') ? 'danger' : 'info' }}">{{ $log->response_status ??
								'-' }}</span></td>
						<td>
							<a href="{{ route('dblogger.logs.show', $log) }}" class="btn btn-sm btn-info">View</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="d-flex justify-content-between align-items-center mt-4">
			<div class="text-muted">
				Showing {{ $logs->firstItem() ?? 0 }} to {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} entries
			</div>
			<nav>
				<ul class="pagination mb-0">
					{{-- Previous Page Link --}}
					@if ($logs->onFirstPage())
					<li class="page-item disabled">
						<span class="page-link">«</span>
					</li>
					@else
					<li class="page-item">
						<a class="page-link" href="{{ $logs->previousPageUrl() }}" rel="prev">«</a>
					</li>
					@endif

					{{-- Pagination Elements --}}
					@foreach ($logs->getUrlRange(max(1, $logs->currentPage() - 2), min($logs->lastPage(), $logs->currentPage() +
					2)) as $page => $url)
					@if ($page == $logs->currentPage())
					<li class="page-item active">
						<span class="page-link">{{ $page }}</span>
					</li>
					@else
					<li class="page-item">
						<a class="page-link" href="{{ $url }}">{{ $page }}</a>
					</li>
					@endif
					@endforeach

					{{-- Next Page Link --}}
					@if ($logs->hasMorePages())
					<li class="page-item">
						<a class="page-link" href="{{ $logs->nextPageUrl() }}" rel="next">»</a>
					</li>
					@else
					<li class="page-item disabled">
						<span class="page-link">»</span>
					</li>
					@endif
				</ul>
			</nav>
		</div>

		<style>
			.pagination {
				margin: 0;
				padding: 0;
			}

			.page-item {
				margin: 0 2px;
			}

			.page-link {
				padding: 8px 16px;
				color: #6c757d;
				background-color: #fff;
				border: 1px solid #dee2e6;
				border-radius: 4px;
				transition: all 0.2s ease-in-out;
			}

			.page-link:hover {
				color: #0056b3;
				background-color: #e9ecef;
				border-color: #dee2e6;
				text-decoration: none;
			}

			.page-item.active .page-link {
				background-color: #007bff;
				border-color: #007bff;
				color: #fff;
			}

			.page-item.disabled .page-link {
				color: #6c757d;
				pointer-events: none;
				background-color: #fff;
				border-color: #dee2e6;
			}
		</style>
	</div>
</div>
@endsection