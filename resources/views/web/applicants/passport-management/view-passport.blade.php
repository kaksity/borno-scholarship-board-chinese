@extends('web.applicants.main-layout')

@section('page-title', 'Passport')
@section('main-content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Passport</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('applicant.passport-management.process-upload-passport-form') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-2">
                        <div class="mb-3">
                            <img src="{{
                                    $applicantBioData?->passport_path != null
                                        ? str_replace('public', '/storage', $applicantBioData?->passport_path)
                                        : '/applicant-assets/img/user_placeholder.jpg'
                                }}" class="user-passport" alt="">
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                            <div>
                                <input type="file" class="form-control form-control-lg" name="passport">
                                @error('passport')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" @if($applicant->status == 'Submitted') disabled @endif class="btn btn-primary">Save & Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
