@extends('layout')

@section('title', 'Users')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">Users <a href="{{ route('user.create') }}"><i
                class="bi bi-plus-circle"></i>
        </a></h1>
    <div class="col-md-6 mx-auto">
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Login</th>
                    <th scope="col">Role</th>
                    <th scope="col">Type</th>
                    <th scope="">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->role == 0 ? 'User' : 'Admin' }}</td>
                        <td>{{ $user->type == 0 ? 'ECT' : 'ACT' }}</td>
                        <td>
                            <a href="{{ route('user.show', $user) }}"><i class="bi bi-pen"></i></a>
                            <a id="delete{{ $user->id }}" class="text-danger"><i class="bi bi-trash3"></i></a>
                        </td>
                    </tr>
                    <script>
                        $("#delete{{ $user->id }}").on("click", (e) => {
                            if (confirm("Are you sure you want to delete this user ?")) {
                                axios.post("{{ route('user.delete', $user->id) }}")
                                    .then(res => {
                                        console.log(res)
                                        window.location.reload();
                                    })
                                    .catch(err => {
                                        console.error(err.response.data);
                                    })
                            }
                        })
                    </script>
                @empty
                    <td>

                    </td>
                    <td></td>
                    <td>No users found</td>
                    <td></td>
                @endforelse



            </tbody>
        </table>
        <script>
            $('#table').DataTable();
        </script>
    </div>


@endsection
