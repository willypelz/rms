<section class="s-div dark scroll-to">
    <div class="container">
        <div class="row">
            @php
                $user_role = getCurrentLoggedInUserRole();
            @endphp
            <div class="col-xs-6">
                <h3> Interview Note </h3>
            </div>
            <div class="col-xs-6 text-right"><br>
                <a href="{{ route('interview-note-templates') }}" class="btn btn-info"> View templates </a>
                @if($user_role->name == 'admin')
                <a href="{{ route('interview-note-template-create') }}" class="btn btn-success"> Create new
                    template </a>
                @endif
            </div>

        </div>
    </div>
</section>