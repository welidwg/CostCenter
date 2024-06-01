@extends('layout')

@section('title', 'Department')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('departement.index') }}"><i
                class="bi bi-arrow-left"></i></a>
        Add
        Department </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Abt</label>
            <input type="text" class="form-control" id="abt">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" id="desc">
        </div>
        <div class="mb-3">
            <label class="form-label">Code</label>
            <input type="text" class="form-control" id="code">

        </div>
        <button type="submit" class="btn btn-primary w-100" id="submit">Add</button>
        <script>
            $("#submit").on("click", (e) => {
                let data = {
                    "abt": $("#abt").val(),
                    "description": $("#desc").val(),
                    "code": $("#code").val()
                }
                axios.post("/departement", data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        console.log(res)
                        window.location.href = `{{ route('departement.index') }}`
                    })
                    .catch(err => {
                        console.error(err);
                    })
            })
        </script>
    </div>
@endsection
