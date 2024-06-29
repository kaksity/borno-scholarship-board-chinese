@extends('web.applicants.main-layout')

@section('page-title', 'Profile')
@section('main-content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Document Uploads Information</h5>
            </div>
            <div class="card-body">
                @if (session()->has('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form action="{{ route('applicant.upload-management.process-upload-document-form') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-2">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Documents Obtained</label>
                            <div>
                                <select class="form-select mb-3" name="document_type_id">
                                    <option value="">Select Document</option>
                                    @foreach ($documentTypes as $documentType)
                                    <option value="{{ $documentType->id }}" @if (old('document_type_id')===$documentType->id) selected @endif
                                        >
                                        {{ $documentType->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('document_type_id')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="name" class="form-label">Document</label>
                            <div>
                                <input type="file" class="form-control" name="file" value="{{ old('file') }}" placeholder="Document">
                                @error('file')
                                <div class="p-1 text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        {{-- @if (auth('applicant')->user()->status === 'Applying') --}}
                        <button type="submit" class="btn btn-primary">Save</button>
                        {{-- @else
                            <button type="button" class="btn btn-primary" disabled>Application already been submitted</button>
                        @endif --}}
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="basic-btn" class="table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Uploaded Document</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applicantUploadDocuments as $applicantUploadDocument)
                            <tr>
                                <td>{{ $applicantUploadDocument->documentType->name }}</td>
                                <td>
                                    <form action="{{ route('applicant.upload-management.process-delete-uploaded-document', [$applicantUploadDocument->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{str_replace('public', '/storage', $applicantUploadDocument->file_path)}}" class="btn btn-secondary">
                                            View
                                        </a>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
