@if(session('message'))
<div class="alert alert-info" role="alert">
    <strong>
        <i class="fa-solid fa-thumbs-up fa-shake fa-lg me-2"></i>
    </strong> {{session('message')}}
</div>
@endif