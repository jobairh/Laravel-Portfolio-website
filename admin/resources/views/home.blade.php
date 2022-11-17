@extends('layout.app')

@section('title','Home')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $TotalVisitor }}</h3>
                        <h3 class="card-text">Total Visitor</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $TotalService }}</h3>
                        <h3 class="card-text">Total Services</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $TotalProject }}</h3>
                        <h3 class="card-text">Total Projects</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $TotalCourse }}</h3>
                        <h3 class="card-text">Total Courses</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $TotalContact }}</h3>
                        <h3 class="card-text">Total Contacts</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $TotalReview }}</h3>
                        <h3 class="card-text">Total Reviews</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
