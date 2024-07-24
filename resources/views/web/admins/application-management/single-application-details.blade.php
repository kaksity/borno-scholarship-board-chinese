@extends('web.admins.main-layout')

@section('page-title', 'Profile')
@section('main-content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="mr-5">
                        <h5 class="card-title mb-0">Application Details</h5>
                    </div>
                    <div class="ml-5">
                        <h5>
                            <b>
                                ({{ $applicant->courseOfStudy->name }})
                            </b>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <div class="px-2">
                        <div>
                            <h3>Profile Information</h3>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Surname
                                </b>
                                <div>
                                    {{ $applicant->surname }}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Other Names
                                </b>
                                <div>
                                    {{ $applicant->other_names }}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Guardian Full Name
                                </b>
                                <div>
                                    {{ $applicant?->applicantBioData->guardian_full_name }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Phone Number
                                </b>
                                <div>
                                    {{ $applicant->phone_number }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Gender
                                </b>
                                <label for="nin" class="col-form-label"></label>
                                <div>
                                    {{ $applicant?->applicantBioData->gender }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    National Identity Number(NIN)
                                </b>
                                <div>
                                    {{ $applicant?->applicantBioData->nin }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Candidate WAEC Number
                                </b>
                                <div>
                                    {{ $applicant?->candidate_number }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Date of Birth
                                </b>
                                <div>
                                    {{ $applicant?->applicantBioData->date_of_birth }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Place of Birth
                                </b>
                                <div>
                                    {{ $applicant?->applicantBioData->place_of_birth }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Contact Address
                                </b>
                                <div>
                                    {{ $applicant?->applicantBioData->contact_address }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <b>
                                    Local Government Area
                                </b>
                                <div>
                                    {{ $applicant?->applicantBioData->lga_id }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 px-2">
                        <div>
                            <h3>Uploaded Documents</h3>
                        </div>
                        <div class="table-responsive">
                            <table id="basic-btn" class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Uploaded Document</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicant->applicantUploadedDocumentData as $applicantUploadDocument)
                                    <tr>
                                        <td>{{ $applicantUploadDocument->documentType->name }}</td>
                                        <td>
                                            <a href="{{str_replace('public', '/storage', $applicantUploadDocument->file_path)}}">
                                                <i class="align-middle" data-feather="eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-5 px-2">
                        <div>
                            <h3>WAEC Subjects Information</h3>
                        </div>
                        <div class="table-responsive">
                            <table id="basic-btn" class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicant->applicantSubjectData as $applicantSubject)
                                    <tr>
                                        <td>{{ $applicantSubject->subject->name }}</td>
                                        <td>{{ $applicantSubject->grade->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
