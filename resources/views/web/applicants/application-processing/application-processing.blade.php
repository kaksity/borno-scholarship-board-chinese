@extends('web.applicants.main-layout')

@section('page-title', 'Application Processing')

@section('main-content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Application Information</h5>
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
                <form action="{{ route('applicant.application-processing.process-application-processing-form') }}" method="POST">
                    @csrf
                    <div class="form-group row mb-2">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Subject</label>
                            <div>
                                <select class="form-select mb-3" name="subject_id">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" @if (old('subject_id')===$subject->id) selected @endif
                                        >
                                        {{ $subject->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Grade</label>
                            <div>
                                <select class="form-select mb-3" name="grade_id">
                                    <option value="">Select Grade</option>
                                    @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}" @if (old('grade_id')===$grade->id) selected @endif
                                        >
                                        {{ $grade->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <button type="submit" class="btn btn-primary" @if($applicant->status == 'Submitted') disabled @endif>Save</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="basic-btn" class="table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th>Percentage Earned</th>
                                @if($applicant->status == 'Applying')
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applicantSubjectData as $applicantSubject)
                            <tr>
                                <td>{{ $applicantSubject->subject->name }}</td>
                                <td>{{ $applicantSubject->grade->name }}</td>
                                <td>{{ $applicantSubject->grade->grade }}</td>
                                @if($applicant->status == 'Applying')
                                <td>
                                    <form action="{{ route('applicant.application-processing.process-delete-application-processing', [$applicantSubject->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <div>
                        <p>Contract Clause</p>
                    </div>
                    <form action="{{ route('applicant.application-processing.process-submit-application-processing-form') }}" method="post">
                        @csrf
                        <input type="submit" value="Submit Application" class="btn btn-primary" @if($applicant->status == 'Submitted') disabled @endif>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
