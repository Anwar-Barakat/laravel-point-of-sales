@if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <ul class="p-0 m-0 list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
