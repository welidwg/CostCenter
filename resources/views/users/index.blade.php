@extends('layout')

@section('title', 'Users')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">Users <a href="{{ route('user.create') }}"><i
                class="bi bi-plus-circle"></i>
        </a></h1>
    <div class="col-md-6 mx-auto">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Login</th>
                    <th scope="col">Role</th>
                    <th scope="">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->role == 0 ? 'User' : 'Admin' }}</td>
                        <td>--</td>
                    </tr>
                @empty
                    <td>

                    </td>
                    <td></td>
                    <td>No users found</td>
                    <td></td>
                @endforelse



            </tbody>
        </table>
    </div>


@endsection
