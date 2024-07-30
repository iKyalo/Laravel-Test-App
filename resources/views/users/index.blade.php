@extends('layouts.master')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                Users
            </div>
            <a href="/users/create" class="btn btn-primary">
                Add New
            </a>
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
                                <ul class="action-list">
                                    <a href="/users/edit/{{ $user->id }}" class="btn btn-primary"><i
                                            class="fa fa-pencil"></i></a>

                                    <!-- Button trigger JavaScript alert -->
                                    <button type="button" class="btn btn-danger"
                                        onclick="confirmDelete({{ $user->id }})">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form id="deleteForm" method="post" action="{{ route('users.destroy') }}">
            @csrf
            <input type="hidden" name="user_id" id="deleteUserId" />
        </form>
    </div>

    <script>
        function confirmDelete(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                document.getElementById('deleteUserId').value = userId;
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
@endsection
