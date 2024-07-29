@extends('layouts.master')

@section('content')
    <div class="card mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Users
                </div>
                <a href="/users/create" class="btn btn-primary">
                    Add New
                </a>
            </div>

        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucwords($user->role) }}</td>
                            <td>
                                <span class="action-list">
                                    <a href="/users/edit/{{ $user->id }}" class="btn btn-primary"><i
                                            class="fa fa-pencil"></i></a>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#userDeleteModal{{ $user->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="userDeleteModal{{ $user->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="userDeleteModalLabel" aria-hidden="true">
                                        <form method="post" action="{{ route('users.destroy') }}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}" />
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="userDeleteModalLabel">Confirm Delete
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this user?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
@endsection
