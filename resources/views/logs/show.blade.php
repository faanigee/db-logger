@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

@php
// $configData = Helper::appClasses();
// dd($configData);
$contentLayout = "layout-wide";
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Accounts - Logs')

@section('vendor-style')

@endsection

@section('page-style')
<style>
	pre {
		border-radius: 3px;
		margin: 15px 0;
	}

	pre.theme-dark {
		background: #1e2638;
		border: 1px solid #10141e;
		color: #e1e4e8;
	}

	pre.theme-light {
		background: #f6f8fa;
		border: 1px solid #e1e4e8;
		color: #24292e;
	}

	pre code {
		font-size: 14px;
		line-height: 1.5;
		display: block;
		padding: 10px;
		color: #333;
		overflow-x: auto;
		border-left: 3px solid #f28d1a;

	}

	.json-string {
		color: #008000;
	}

	.json-number {
		color: #89b6e8;
	}

	.json-boolean {
		color: #b22222;
	}

	.json-null {
		color: #808080;
	}

	.json-key {
		color: #e36209;
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
				<div class="card-header d-flex justify-content-between align-items-center">
					<h2>Log Details</h2>
					<a href="{{ route('dblogger.logs.index') }}" class="btn btn-secondary">Back to Logs</a>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-3">ID</dt>
						<dd class="col-sm-9">{{ $log->ref_id ?? '-'}}</dd>

						{{-- <dt class="col-sm-3">Level</dt>
						<dd class="col-sm-9">
							<span class="badge bg-{{ ($log->level == 'error') ? 'danger' : $log->level }}">{{ $log->level }}</span>
						</dd> --}}

						<dt class="col-sm-3">Status</dt>
						<dd class="col-sm-9">
							<span class="badge bg-{{ ($log->response_status == 'Failed') ? 'danger' : 'success' }}">{{
								$log->response_status }}</span>
						</dd>

						<dt class="col-sm-3">Creator Name</dt>
						<dd class="col-sm-9">{{ $log->user_name ?? 'System' }}</dd>

						<dt class="col-sm-3">IP Address</dt>
						<dd class="col-sm-9">{{ $log->ip_address }}</dd>

						<dt class="col-sm-3">User Agent</dt>
						<dd class="col-sm-9">{{ $log->user_agent }}</dd>

						<dt class="col-sm-3">Dated</dt>
						<dd class="col-sm-9">{{ $log->created_at->format('d F Y ( H:i:s )') }}</dd>

						<dt class="col-sm-3">Message</dt>
						<dd class="col-sm-9 text-info">{{ $log->message }}</dd>

						<dt class="col-sm-3">Context</dt>
						<dd class="col-sm-9">
							<pre
								class="theme-{{ $pageConfigs['myStyle'] }}"><code class="json">@formatJson($log->context)</code></pre>
						</dd>

						@if(count($log->extra) > 0)
						<dt class="col-sm-3">Extra Data</dt>
						<dd class="col-sm-9">
							<pre class="theme-{{ $pageConfigs['myStyle'] }}"><code class="json">@formatJson($log->extra)</code></pre>
						</dd>
						@endIf

					</dl>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection