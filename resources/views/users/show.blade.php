@extends('layout')

@section('title', 'Edit user')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('user.index') }}"><i class="bi bi-arrow-left"></i></a>
        Edit
        user {{ $user->login }} </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Login</label>
            <input type="text" class="form-control" required id="login" value="{{ $user->login }}">
        </div>
        <div class="mb-3">
            <label class="form-label">New password</label>
            <input type="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>

            <select id="role" class="form-select form-select-lg mb-3">
                @if ($user->role == 0)
                    <option selected value="0">User</option>
                    <option value="1">Admin</option>
                @else
                    <option value="0">User</option>
                    <option selected value="1">Admin</option>
                @endif

            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>

            <select id="type" class="form-select form-select-lg mb-3">
                @if ($user->type == 0)
                    <option selected value="0">ECT</option>
                    <option value="1">ACT</option>
                @else
                    <option value="0">ECT</option>
                    <option selected value="1">ACT</option>
                @endif


            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3" id="submit">Save</button>

        <div class="infos">

        </div>
        <script>
            $("#submit").on("click", (e) => {
                $(".infos").html(``)
                let data = {
                    "login": $("#login").val(),
                    "newPass": $("#password").val(),
                    "role": $("#role").val(),
                    "type": $("#type").val()

                }
                axios.put("{{ route('user.update', $user) }}", data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        console.log(res)
                        //window.location.href = `{{ route('user.index') }}`
                        $(".infos").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Updated ! </strong>
            </div>`)
                        setTimeout(() => {
                            window.location.href = "/user"
                        }, 1400)
                    })

                    .catch(err => {
                        console.error(err.response.data);
                        $(".infos").html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Server Error! </strong>
            </div>`)
                    })
            })
        </script>
    </div>
@endsection
