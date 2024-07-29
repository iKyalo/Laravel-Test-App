@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="text-center mt-5">
            <h1>{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>
        </div>

        <div class="row mb-5">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form id="user-form" role="form" method="POST"
                                action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
                                @csrf
                                @if (isset($user))
                                    @method('PUT')
                                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                                @endif
                                <div class="controls">

                                    <!-- Name Field -->
                                    <div class="form-group">
                                        <label for="form_name">Name *</label>
                                        <input id="form_name" type="text" name="name" class="form-control"
                                            placeholder="Please enter user name *" required="required"
                                            data-error="Name is required."
                                            value="{{ isset($user) ? $user->name : old('name') }}">
                                    </div>

                                    <!-- Email Field -->
                                    <div class="form-group">
                                        <label for="form_email">Email *</label>
                                        <input id="form_email" type="email" name="email" class="form-control"
                                            placeholder="Please enter user email *" required="required"
                                            data-error="Valid email is required."
                                            value="{{ isset($user) ? $user->email : old('email') }}">
                                    </div>

                                    <!-- Role Field -->
                                    <div class="form-group">
                                        <label for="form_role">Role *</label>
                                        <select id="form_role" name="role" class="form-control" required="required"
                                            data-error="Role is required.">
                                            <option value="" disabled>--Select Role--</option>
                                            <option value="user"
                                                {{ isset($user) && $user->role == 'user' ? 'selected' : '' }}>User
                                            </option>
                                            <option value="admin"
                                                {{ isset($user) && $user->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Password Field (only show on create) -->
                                    @if (!isset($user))
                                        <div class="form-group">
                                            <label for="form_password">Password *</label>
                                            <input id="form_password" type="password" name="password" class="form-control"
                                                placeholder="Please enter user password *" required="required"
                                                data-error="Password is required.">
                                        </div>

                                        <!-- Password Confirmation Field (only show on create) -->
                                        <div class="form-group">
                                            <label for="form_password_confirmation">Confirm Password *</label>
                                            <input id="form_password_confirmation" type="password"
                                                name="password_confirmation" class="form-control"
                                                placeholder="Please confirm user password *" required="required"
                                                data-error="Password confirmation is required.">
                                        </div>
                                    @endif

                                    <hr />

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success btn-send pt-2 btn-block"
                                            value="{{ isset($user) ? 'Update' : 'Save' }}">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
