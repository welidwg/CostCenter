@extends('layout')

@section('title', 'Profile')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">My profile </h1>
    <div class="col-md-6 mx-auto">
        <form class="row g-3 needs-validation">
            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">Login</label>
                <input type="text" class="form-control shadow-none border-0" id="validationCustom01"
                    value="{{ Auth::user()->login }}" readonly>

            </div>
            <div class="col-md-6">
                <label for="validationCustom02" class="form-label">Role</label>
                <input type="text" class="form-control shadow-none border-0" id="validationCustom02"
                    value="{{ Auth::user()->role == 1 ? 'Admin' : 'User' }}" readonly>

            </div>
            <input type="hidden" name="" id="user_id">

            <div class="col-12">
                <label for="validationCustom03" class="form-label">New password</label>
                <input type="password" id="password" class="form-control" id="validationCustom03" required>

            </div>


            <div class="col-12">
                <a class="btn btn-primary w-100" type="submit" id="submit">Change password</a>
            </div>

            <div id="response"></div>
        </form>
        <script>
            $("#submit").on("click", (e) => {
                $("#response").html("")
                if ($("#password").val() != "") {

                    let data = {
                        "password": $("#password").val()
                    }
                    axios.post("/profile/{{ Auth::user()->id }}", data)
                        .then(res => {
                            console.log(res)

                            $("#response").html(`
                        <div class=" alert alert-success" role="alert">
                        Updated
            </div>`)

                            $("#password").val("")
                        })
                        .catch(err => {
                            console.error(err);
                            $("#response").html(`
                        <div class=" alert alert-danger" role="alert">
                        ${err.response.data.message}
            </div>`)
                        })
                } else {
                    $("#response").html(`
                        <div class=" alert alert-danger" role="alert">
                       Please enter a password
            </div>`)
                }

            })
        </script>

    </div>


@endsection
