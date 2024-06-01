@extends('layout')

@section('title', 'Fonction')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('fonction.index') }}"><i
                class="bi bi-arrow-left"></i></a>
        Add
        Fonction </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Fonction</label>
            <input type="text" class="form-control" id="fct">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" id="desc">
        </div>
        <div class="mb-3">
            <label class="form-label">Code</label>
            <input type="number" class="form-control" id="code">

        </div>

        <button type="submit" class="btn btn-primary w-100" id="submit">Add</button>
        <script>
            $("#submit").on("click", (e) => {
                let data = {
                    "fonction": $("#fct").val(),
                    "description": $("#desc").val(),
                    "code": $("#code").val(),
                }
                axios.post("/fonction", data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        console.log(res)
                        window.location.href = `{{ route('fonction.index') }}`
                    })
                    .catch(err => {
                        console.error(err);
                    })
            })
        </script>
    </div>
@endsection
