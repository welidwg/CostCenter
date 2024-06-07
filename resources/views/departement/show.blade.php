@extends('layout')

@section('title', 'Department')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('departement.index') }}"><i
                class="bi bi-arrow-left"></i></a>
        Edit
        Department </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Abt</label>
            <input type="text" class="form-control" id="abt" value="{{ $departement->abt }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" id="desc" value="{{ $departement->description }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Code</label>
            <input type="text" class="form-control" id="code" value="{{ $departement->code }}">

        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3" id="submit">Save</button>
        <div class="infos"></div>
        <script>
            $("#submit").on("click", (e) => {
                let data = {
                    "abt": $("#abt").val(),
                    "description": $("#desc").val(),
                    "code": $("#code").val()
                }
                axios.put("{{ route('departement.update', $departement) }}", data, {
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
                            window.location.href = `{{ route('departement.index') }}`
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
