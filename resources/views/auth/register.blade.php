@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Create Account</h3>
                    </div>
                    <div class="card-body">
                        <form id="register-form" role="form" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputFirstName" name="name" type="text"
                                            placeholder="Enter your Name" />
                                        <label for="inputFirstName">Name</label>
                                    </div>
                                </div>

                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="email" name="email"
                                    placeholder="name@example.com" />
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputPassword" name="password" type="password"
                                            placeholder="Create a password" />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputPasswordConfirm" name="password_confirmation"
                                            type="password" placeholder="Confirm password" />
                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            <hr />

                            <!-- Submit Button -->
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-send pt-2 btn-block"
                                    value="Create Account">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="/login">Have an account? Go to login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
