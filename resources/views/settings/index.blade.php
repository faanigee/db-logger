@extends('dblogger::layouts.master')

@section('title', 'Logger Settings')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Logger Settings</h5>
  </div>
  <div class="card-body">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('dblogger.settings.update') }}" method="POST">
      @csrf

      <div class="row mb-4">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="per_page" class="form-label">Records Per Page</label>
            <input type="number" class="form-control @error('per_page') is-invalid @enderror" id="per_page"
              name="per_page" value="{{ old('per_page', $settings['per_page'] ?? 100) }}" min="10" max="500">
            @error('per_page')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="date_format" class="form-label">Date Format</label>
            <select class="form-select @error('date_format') is-invalid @enderror" id="date_format" name="date_format">
              <option value="Y-m-d H:i:s" {{ (old('date_format', $settings['date_format'] ?? '' )=='Y-m-d H:i:s' )
                ? 'selected' : '' }}>
                YYYY-MM-DD HH:mm:ss
              </option>
              <option value="d-m-Y H:i:s" {{ (old('date_format', $settings['date_format'] ?? '' )=='d-m-Y H:i:s' )
                ? 'selected' : '' }}>
                DD-MM-YYYY HH:mm:ss
              </option>
              <option value="m/d/Y H:i:s" {{ (old('date_format', $settings['date_format'] ?? '' )=='m/d/Y H:i:s' )
                ? 'selected' : '' }}>
                MM/DD/YYYY HH:mm:ss
              </option>
            </select>
            @error('date_format')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label d-block">Enable Filters</label>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input @error('enable_filters') is-invalid @enderror"
                id="enable_filters_yes" name="enable_filters" value="1" {{ old('enable_filters',
                $settings['enable_filters'] ?? true) ? 'checked' : '' }}>
              <label class="form-check-label" for="enable_filters_yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" id="enable_filters_no" name="enable_filters" value="0" {{
                old('enable_filters', $settings['enable_filters'] ?? true) ? '' : 'checked' }}>
              <label class="form-check-label" for="enable_filters_no">No</label>
            </div>
            @error('enable_filters')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label d-block">Dark Mode</label>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input @error('dark_mode') is-invalid @enderror" id="dark_mode_yes"
                name="dark_mode" value="1" {{ old('dark_mode', $settings['dark_mode'] ?? false) ? 'checked' : '' }}>
              <label class="form-check-label" for="dark_mode_yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" id="dark_mode_no" name="dark_mode" value="0" {{
                old('dark_mode', $settings['dark_mode'] ?? false) ? '' : 'checked' }}>
              <label class="form-check-label" for="dark_mode_no">No</label>
            </div>
            @error('dark_mode')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary">Save Settings</button>
      </div>
    </form>
  </div>
</div>
@endsection