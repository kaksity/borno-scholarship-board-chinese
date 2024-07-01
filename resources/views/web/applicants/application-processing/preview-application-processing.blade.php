@extends('web.applicants.main-layout')

@section('page-title', 'Profile')
@section('main-content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Preview Application</h5>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicant->applicantUploadedDocumentData as $applicantUploadDocument)
                                    <tr>
                                        <td>{{ $applicantUploadDocument->documentType->name }}</td>
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
                                        <th>Percentage Earned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicant->applicantSubjectData as $applicantSubject)
                                    <tr>
                                        <td>{{ $applicantSubject->subject->name }}</td>
                                        <td>{{ $applicantSubject->grade->name }}</td>
                                        <td>{{ $applicantSubject->grade->grade }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div>
                            <p>I hereby certify that all the information provided in this scholarship application is true, accurate, and complete to the best of my knowledge. I understand that any false statements, misrepresentations, or omissions may result in the forfeiture of the scholarship, including its immediate withdrawal if I am found guilty of providing inaccurate information. Furthermore, I acknowledge that any deliberate falsification or dishonesty will subject me to disciplinary actions as deemed appropriate by the scholarship committee.</p>
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
</div>

@endsection
