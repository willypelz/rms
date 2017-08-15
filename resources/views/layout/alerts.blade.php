@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif


<!-- For Ajax Requests -->
<div class="alert alert-success" id="success" style="display:none"></div>


<div class="alert alert-warning" id="error" style="display:none"></div>
