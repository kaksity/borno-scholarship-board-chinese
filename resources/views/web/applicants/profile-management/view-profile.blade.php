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
                <form action="{{ route('applicant.profile-management.process-profile-form') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Surname</label>
                        <input class="form-control form-control-lg" type="text" name="surname" placeholder="Enter your surname" value="{{ $applicant->surname ?? old('surname') }}" />
                        @error('surname')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Other names</label>
                        <input class="form-control form-control-lg" type="text" name="other_names" placeholder="Enter your other names" value="{{$applicant->other_names ?? old('other_names') }}" />
                        @error('other_names')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input class="form-control form-control-lg" disabled type="text" placeholder="Enter your email address" value="{{$applicant->email}}" />
                        @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input class="form-control form-control-lg" type="text" name="phone_number" placeholder="Enter your phone number" value="{{$applicant->phone_number ?? old('phone_number') }}" />
                        @error('phone_number')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year of WAEC</label>
                        <input class="form-control form-control-lg" disabled type="text" value="{{$applicant->year }}" />
                        @error('phone_number')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">National Identity Number(NIN)</label>
                        <input class="form-control form-control-lg" type="text" name="national_identity_number" placeholder="Enter Farmer's National Identity Number" value="{{$applicant?->nin ?? old('nin') }}" />
                        @error('nin')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Local Government Area(LGA)</label>
                        <select class="form-select mb-3" name="lga_id" id="select_lga">
                            <option selected>Select a lga</option>
                            @foreach ($lgas as $lga)
                            <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" value="Update Profile">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
