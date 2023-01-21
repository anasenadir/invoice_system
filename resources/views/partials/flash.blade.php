@if (session()->has('message'))
    <div class="alert {{session()->get('message')['alter_type'] }} alert-dismissible fade show" role="alert">
        {{session()->get('message')['value']}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif