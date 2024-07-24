@extends('web.admins.main-layout')

@section('main-content')
<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

<div class="row">
    <div class="col-xl-12 col-xxl-12 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-12 d-flex">
                    @foreach($applicationStatusMetrics as $status => $count)
                    <div class="card mx-1 col-md-6 col-lg-6 col-sm-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">{{ $status }} Applications</h5>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $count }}</h1>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 d-flex">
                    @foreach($courseOfStudyMetrics as $course => $count)
                    <div class="card mx-1 col-md-4 col-lg-4 col-sm-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">{{ $course }} Applications</h5>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $count }}</h1>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 d-flex">
                    @foreach($paymentSummaries as $status => $count)
                    <div class="card mx-1 col-md-6 col-lg-6 col-sm-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">{{ $status }} payments</h5>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $count }}</h1>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
