
  {!! @$applicant_badge !!}              

  @foreach( $app_ids as $app_id )
    <iframe src="https://testing.insidifyenterprise.com/sort_result/{{ $app_id }}/{{ $cv_ids[0] }}" style="width:100%; border:none;height:700px;">
      
    </iframe>
  @endforeach


  <div class="clearfix"></div>
