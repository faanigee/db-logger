@extends('layouts/layoutMaster')

@section('title', 'Accounts - Logs')

@section('vendor-style')
@endsection

@section('page-style')
<style>
	.pagination-spacing .page-item {
		margin-right: 5px;
		/* Adds space between pagination items */
	}

	.pagination-spacing .page-item:last-child {
		margin-right: 0;
		/* Removes margin from last item */
	}
</style>
@endsection

@section('vendor-script')

@endsection

@section('page-script')
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h2>Logs</h2>
				</div>
				<div class="card-body">
					<!-- Filters -->
					<form method="GET" action="{{ route('dblogger.logs.index') }}" class="mb-4">
						<div class="row">
							<div class="col-md-2">
								<select name="level" class="form-select">
									<option value="">All Levels</option>
									@foreach(['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info',
									'debug'] as $level)
									<option value="{{ $level }}" {{ request('level')==$level ? 'selected' : '' }}>
										{{ ucfirst($level) }}
									</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-2">
								<input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}"
									placeholder="Start Date">
							</div>
							<div class="col-md-2">
								<input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}"
									placeholder="End Date">
							</div>
							<div class="col-md-3">
								<input type="search" name="ref_no" class="form-control" value="{{ request('ref_no') }}"
									placeholder="Reference No for search a particular record data">
							</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-primary">Filter</button>
								<a href="{{ route('dblogger.logs.index') }}" class="btn btn-secondary">Reset</a>
							</div>
						</div>
					</form>

					<!-- Logs Table -->
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Date</th>
									<th>Ref #</th>
									<th>Level</th>
									<th>Message</th>
									<th>Created By</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($logs as $index => $log)
								<tr>
									<td>{{ $log->created_at->format('d-m-Y') }}</td>
									<td>{{ $log?->ref_id ?? '-' }}</td>
									<td><span class="badge bg-{{ ($log->level == 'error') ? 'danger' : $log->level }}">{{
											$log->level }}</span></td>
									<td>{{ Str::limit($log->message, 80) }}</td>
									<td>{{ $log?->user_name ?? 'System' }}</td>
									<td>
										<a href="{{ route('dblogger.logs.show', $log) }}" class="btn btn-sm btn-info">
											View
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<!-- Pagination -->
					{{-- add the margin top with mt-5 to give some space to table and pagination buttons --}}
					<div class=" text-end mt-5">
						<div class="d-inline-flex gap-2">
							<!-- Add this wrapper -->
							{{ $logs->links() }}
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection