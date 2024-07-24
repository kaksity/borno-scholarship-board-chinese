@extends('web.admins.main-layout')

@section('page-title', 'List of Applications')

@section('main-content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">List of Applications</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-btn" class="table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Full Name</th>
                                <th>Course of Study</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>year</th>
                                <th>Total Endpoint</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applicants as $applicant)
                            <tr>
                                <td>{{ "$applicant->surname $applicant->other_names"}}</td>
                                <td>{{ $applicant->courseOfStudy->name }}</td>
                                <td>{{ $applicant->email }}</td>
                                <td>{{ $applicant->phone_number }}</td>
                                <td>{{ $applicant->year }}</td>
                                <td>{{ $applicant->earned_grades }}</td>
                                <td>{{ $applicant->status }}</td>
                                <td>
                                    <a href="{{ route('admin.application-management.display-single-application-details', [
                                        $applicant->id
                                    ]) }}">
                                        <i class="align-middle" data-feather="eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex mt-3">
                        {!! $applicants->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
