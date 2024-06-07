@extends('layout')

@section('title', 'Fonction')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('fonction.index') }}"><i
                class="bi bi-arrow-left"></i></a>
        Edit
        Fonction </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Fonction</label>
            <input type="text" class="form-control" id="fct" value="{{ $fonction->fonction }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" id="desc" value="{{ $fonction->description }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Code</label>
            <input type="number" class="form-control" id="code" value="{{ $fonction->code }}">

        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3" id="submit">Save</button>
        <div class="infos"></div>
        <script>
            $("#submit").on("click", (e) => {
                let data = {
                    "fonction": $("#fct").val(),
                    "description": $("#desc").val(),
                    "code": $("#code").val(),
                }
                axios.put("{{ route('fonction.update', $fonction) }}", data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        $(".infos").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Updated ! </strong>
            </div>`)
                        setTimeout(() => {
                            window.location.href = `{{ route('fonction.index') }}`
                        }, 1400);
                    })
                    .catch(err => {
                        console.error(err);
                        $(".infos").html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Server Error ! </strong>
            </div>`)
                    })
            })
        </script>
    </div>
@endsection
