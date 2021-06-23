<div class="col-sm-4">
    <h6 class="text-brandon text-uppercase l-sp-5 no-margin">company
        details</h6><br>
    <p class="text-muted">{{ $company->name }}</p>

    <p><img src="{{ $company->logo }}" alt="" width="60%"></p><br>
    <p class="small">{{ $company->about }}</p>
    <p><i class="fa fa-map-marker"></i> {{ $company->address }}</p>
    <!--p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4448.570052456479!2d3.3791209324273184!3d6.618898622434336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b93a899b7c9b7%3A0x8630de71dbc44ffd!2sMagodo+GRA+Phase+II%2C+Lagos!5e0!3m2!1sen!2sng!4v1457754339276" frameborder="0" width="100%" height="200px" allowfullscreen></iframe>
    </p-->
    <p>
        <i class="fa fa-envelope"></i> {{ $company->email }} <br>
        <i class="fa fa-globe"></i> {{ $company->website }}
    @if(isset($privacy_policy))
        <p>
            <i class="fa fa-lock"></i>
            By applying to this job, you are agreeing to our
            <a target="_blank" href="{{$privacy_policy->value}}">
                data privacy </a> terms and conditions
        </p>
        @endif
        </p>
</div>
