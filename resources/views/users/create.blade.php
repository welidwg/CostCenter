@extends('layout')

@section('title', 'Users')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('user.index') }}"><i class="bi bi-arrow-left"></i></a>
        Add
        user </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Login</label>
            <input type="text" class="form-control" id="login">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>

            <select id="role" class="form-select form-select-lg mb-3">
                <option value="1">Admin</option>
                <option value="0">User</option>

            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>

            <select id="type" class="form-select form-select-lg mb-3">
                <option value="0">ECT</option>
                <option value="1">ACT</option>

            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100" id="submit">Add</button>
        <script>
            $("#submit").on("click", (e) => {
                let data = {
                    "login": $("#login").val(),
                    "password": $("#password").val(),
                    "role": $("#role").val(),
                    "type": $("#type").val()

                }
                axios.post("/user", data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        console.log(res)
                        window.location.href = `{{ route('user.index') }}`
                    })
                    .catch(err => {
                        console.error(err);
                    })
            })
        </script>
    </div>
@endsection
