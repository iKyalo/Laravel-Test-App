@if (session('message'))
    <div class="d-flex justify-content-center mt-3" style="position: fixed; z-index: 1000000; width: 100%;">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="max-width: 600px;">
            <strong>Alert!</strong> {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="d-flex justify-content-center mt-3" style="position: fixed; z-index: 1000000; width: 100%;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="max-width: 600px;">
            <strong>Oops!</strong> There were some problems with your input.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <hr />
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    </div>
@endif
