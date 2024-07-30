@extends('layouts.master')

@section('content')
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card my-2">
                        <div class="card-header">
                            Profile Information
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Name</h5>
                            <p class="card-text">{{ auth()->user()->name }}</p>
                            <hr />
                            <h5 class="card-title">Email</h5>
                            <p class="card-text">{{ auth()->user()->email }}</p>
                            <hr />
                            <h5 class="card-title">Role</h5>
                            <p class="card-text">{{ ucwords(auth()->user()->role) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
