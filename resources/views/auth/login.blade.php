@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login</h3>
                    </div>
                    <div class="card-body">
                        <form id="login-form" role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="email" name="email"
                                    placeholder="name@example.com" />
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputPassword" type="password" name="password"
                                    placeholder="Password" />
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                <label class="form-check-label" for="inputRememberPassword">Remember Me</label>
                            </div>
                            <hr />
                            <!-- Submit Button -->
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-send pt-2 btn-block" value="Login">
                            </div>

                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="/register">Need an account? Sign up!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
