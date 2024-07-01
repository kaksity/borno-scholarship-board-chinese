@extends('web.applicants.main-layout')

@section('page-title', 'Profile')
@section('main-content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Profile Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('applicant.profile-management.process-profile-form') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-2">
                        <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Surname</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" disabled name="surname" value="{{ $applicant->surname }}" placeholder="Surname">
                                @error('surname')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Other Names</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" disabled name="other_names" value="{{ $applicant->other_names }}" placeholder="Other Names">
                                @error('other_names')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Guardian Full Name</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" name="guardian_full_name" value="{{ $applicant?->applicantBioData->guardian_full_name ?? old('guardian_full_name')}}" placeholder="Other Names">
                                @error('guardian_full_name')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label for="phone" class="col-form-label">Phone Number</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" name="phone_number" value="{{ $applicant->phone_number ?? old('phone_number') }}" placeholder="Phone Number">
                                @error('phone_number')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label for="nin" class="col-form-label">Gender</label>
                            <div>
                                <select name="gender" class="form-select mb-3">
                                    <option value="">Select a Gender</option>
                                    <option value="Male" @if($applicant?->applicantBioData->gender === 'Male')
                                        selected
                                        @endif
                                        @if(old('gender') == 'Male')
                                        selected
                                        @endif
                                        >
                                        Male
                                    </option>
                                    <option value="Male" @if($applicant->applicantBioData->gender === 'Female')
                                        selected
                                        @endif
                                        @if(old('gender') == 'Female')
                                        selected
                                        @endif
                                        >
                                        Female
                                    </option>
                                </select>
                                @error('gender')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label for="nin" class="col-form-label">National Identity Number(NIN)</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" value="{{ $applicant?->applicantBioData->nin ?? old('nin') }}" name="nin" placeholder="National Identity Number(NIN)">
                                @error('nin')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label for="nin" class="col-form-label">Candidate WAEC Number</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" value="{{ $applicant?->candidate_number ?? old('candidate_number') }}" name="candidate_number" placeholder="Candidate WAEC Number">
                                @error('candidate_number')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label for="nin" class="col-form-label">Date of Birth</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" placeholder="Date of Birth (YYYY-MM-DD)" value="{{ $applicant?->applicantBioData->date_of_birth ?? old('date_of_birth') }}" name="date_of_birth">
                                @error('date_of_birth')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Place of Birth</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" placeholder="Place of Birth" value="{{ $applicant?->applicantBioData->place_of_birth ?? old('place_of_birth') }}" name="place_of_birth">
                                @error('place_of_birth')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Contact Address</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" placeholder="Contact Address" value="{{ $applicant?->applicantBioData->contact_address ?? old('contact_address') }}" name="contact_address">
                                @error('contact_address')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Local Government Area</label>
                            <div>
                                <select class="form-select mb-3" name="lga_id">
                                    <option value="">Select Local Government Aread</option>
                                    @foreach ($lgas as $lga)
                                    <option value="{{ $lga->id }}" @if($lga->id == old('lga_id')) selected @endif
                                        @if($lga->id == $applicant?->applicantBioData->lga_id) selected @endif
                                        >
                                        {{ $lga->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('lga_id')
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
