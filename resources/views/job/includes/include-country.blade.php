@php
    $countries = countries();
    $locations = locations();
@endphp

<label for="job-title" class="pull-left">Country</label>
<select required
        name="country"
        id="country"
        class="form-control job_country"
        type="text">
    <option value="">--choose country--</option>
    @foreach($countries as $country)
        <option value="{{ $country }}" >{{ $country }}</option>
    @endforeach
</select>

<div class="state_section @if($errors->has('location'))  @else hidden @endif"
     style="margin-top: 10px">
    <label for="job-title" class="pull-left">Current Location</label>
    <select required name="location" id="location" class="form-control job_location" type="text">
        <option value="">--choose state--</option>
        @foreach($locations as $state)
            <option value="{{$state != 'Nigeria' ? $state : 'Across Nigeria' }}">{{ $state}}</option>
        @endforeach
    </select>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        var country = $('#country');

        country.change(function () {

            if (country.val() == 'Nigeria') {
                $('.state_section').removeClass('hidden');
                $('#location').prop('required', true)
            } else {
                $('.state_section').addClass('hidden');
                $('#location').prop('required', false)
            }
        });

        $('.submitButton').click(function () {
            if (country.val() != 'Nigeria') {
                $('#location').prop('required', false)
            }
        })
    });
</script>