@extends('web.admins.main-layout')
@section('main-content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Generate Report</h5>
            </div>
            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <form method="post" action="{{ route('admin.reports.process-generate-report') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Course Of Study</label>
                        <select class="form-select mb-3" name="course_of_study_id">
                            <option value="">
                                Select Course of Study
                            </option>
                            @foreach ($courseOfStudies as $courseOfStudy)
                            <option value="{{ $courseOfStudy->id }}">
                                {{ $courseOfStudy->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year of WAEC</label>
                        <select class="form-select mb-3" name="year">
                            <option value="">
                                Select Year of WAEC
                            </option>
                            @foreach ($years as $year)
                            <option value="{{ $year }}">
                                {{ $year }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Application Status</label>
                        <select class="form-select mb-3" name="year">
                            <option value="">
                                Select Application Status
                            </option>
                            <option value="Applying">
                                Applying
                            </option>
                            <option value="Submitted">
                                Submitted
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
