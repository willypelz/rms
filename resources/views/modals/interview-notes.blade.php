
  {!! @$applicant_badge !!}              

@if( count($notes) > 0 && count($note) == 0 )
  <div class="row">
        <div class="col-sm-12 ">  
          
          <div class="alert alert-warning text-center">

              You have interviewed this candidate {{ count($notes) }} {{ ( count($notes) == 1) ? 'time' : 'times' }}.
          </div>
        </div>
  </div>
@endif
<style type="text/css">
  .br-theme-bars-movie .br-widget .br-current-rating{ width: 100% !important; }
  .form-group {
    margin-bottom: 30px;
}
</style>
<form role="form" class="form-signin" method="POST" id="interview-note-form" action="" style="height: 300px;overflow: scroll;">
    {!! csrf_field() !!}
    
    <div class="row">
        <div class="col-sm-12">  


            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Appropriate Appearance <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="general_appearance" id="general_appearance" required>
                    <option value></option>
                    <option value="1" @if( @$note->general_appearance == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->general_appearance == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->general_appearance == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->general_appearance == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->general_appearance == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>


             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Educational Background <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="educational_background" id="educational_background" required>
                    <option value></option>
                    <option value="1" @if( @$note->educational_background == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->educational_background == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->educational_background == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->educational_background == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->educational_background == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>



            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Communication Skills <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="verbal_communication" id="verbal_communication" required>
                    <option value></option>
                    <option value="1" @if( @$note->verbal_communication == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->verbal_communication == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->verbal_communication == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->verbal_communication == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->verbal_communication == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Relevant Work Experience <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="relevant_experience" id="relevant_experience" required>
                    <option value></option>
                    <option value="1" @if( @$note->relevant_experience == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->relevant_experience == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->relevant_experience == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->relevant_experience == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->relevant_experience == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>

            

            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">General Knowledge <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="general_knowledge" id="general_knowledge" required>
                    <option value></option>
                    <option value="1" @if( @$note->general_knowledge == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->general_knowledge == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->general_knowledge == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->general_knowledge == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->general_knowledge == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>




            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Applicable Work Skills <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="prior_work_experience" id="prior_work_experience" required>
                    <option value></option>
                    <option value="1" @if( @$note->prior_work_experience == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->prior_work_experience == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->prior_work_experience == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->prior_work_experience == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->prior_work_experience == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>



            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Reasoning <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="reasoning" id="reasoning" required>
                    <option value></option>
                    <option value="1" @if( @$note->reasoning == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->reasoning == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->reasoning == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->reasoning == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->reasoning == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>


            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Attitude <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="attitude_to_issues" id="attitude_to_issues" required>
                    <option value></option>
                    <option value="1" @if( @$note->attitude_to_issues == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->attitude_to_issues == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->attitude_to_issues == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->attitude_to_issues == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->attitude_to_issues == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Knowledge of Industry <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="knowledge_of_industry" id="knowledge_of_industry" required>
                    <option value></option>
                    <option value="1" @if( @$note->knowledge_of_industry == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->knowledge_of_industry == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->knowledge_of_industry == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->knowledge_of_industry == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->knowledge_of_industry == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>





            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Motivation <span class="text-danger">*</span></label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="candidate_enthusiasm" id="candidate_enthusiasm" required>
                    <option value></option>
                    <option value="1" @if( @$note->candidate_enthusiasm == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->candidate_enthusiasm == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->candidate_enthusiasm == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->candidate_enthusiasm == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->candidate_enthusiasm == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>


             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Professional Qualifications</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="professional_qualifications" id="professional_qualifications">
                    <option value></option>
                    <option value="1" @if( @$note->professional_qualifications == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->professional_qualifications == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->professional_qualifications == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->professional_qualifications == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->professional_qualifications == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>




            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Customer Service Orientation</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="customer_service_orientation" id="customer_service_orientation">
                    <option value></option>
                    <option value="1" @if( @$note->customer_service_orientation == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->customer_service_orientation == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->customer_service_orientation == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->customer_service_orientation == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->customer_service_orientation == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>




            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Time Management</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="time_management" id="time_management">
                    <option value></option>
                    <option value="1" @if( @$note->time_management == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->time_management == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->time_management == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->time_management == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->time_management == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>




            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Brand Projection</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="brand_projection" id="brand_projection">
                    <option value></option>
                    <option value="1" @if( @$note->brand_projection == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->brand_projection == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->brand_projection == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->brand_projection == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->brand_projection == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>





            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Technical Inclination</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="technology_enablement" id="technology_enablement">
                    <option value></option>
                    <option value="1" @if( @$note->technology_enablement == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->technology_enablement == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->technology_enablement == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->technology_enablement == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->technology_enablement == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>



            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Learning Skills</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="learning_skills" id="learning_skills">
                    <option value></option>
                    <option value="1" @if( @$note->learning_skills == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->learning_skills == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->learning_skills == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->learning_skills == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->learning_skills == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>
            




            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Predesposition to Training</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="predesposition_to_training" id="predesposition_to_training">
                    <option value></option>
                    <option value="1" @if( @$note->predesposition_to_training == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->predesposition_to_training == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->predesposition_to_training == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->predesposition_to_training == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->predesposition_to_training == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>



            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Availability</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="availability" id="availability">
                    <option value></option>
                    <option value="1" @if( @$note->availability == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->availability == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->availability == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->availability == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->availability == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="5" > 5 </label> -->
                </div>
                
            <div class="clearfix"></div>
            </div>
             


            

             
            

             
            

             
            <!-- <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Career Progression</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="career_progression" id="career_progression">
                    <option value></option>
                    <option value="1" @if( @$note->career_progression == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->career_progression == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->career_progression == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->career_progression == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->career_progression == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Initiative</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="initiative" id="initiative">
                    <option value></option>
                    <option value="1" @if( @$note->initiative == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->initiative == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->initiative == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->initiative == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->initiative == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            

          

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Intellectual Capacity</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="intellectual_capacity" id="intellectual_capacity">
                    <option value></option>
                    <option value="1" @if( @$note->intellectual_capacity == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->intellectual_capacity == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->intellectual_capacity == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->intellectual_capacity == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->intellectual_capacity == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            
            
             
            
            
             
            
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Quantitative Capacity</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="quantitative_capacity" id="quantitative_capacity">
                    <option value></option>
                    <option value="1" @if( @$note->quantitative_capacity == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->quantitative_capacity == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->quantitative_capacity == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->quantitative_capacity == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->quantitative_capacity == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            
            
             
            
            
             
            


            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Verbal Skills</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="verbal_skills" id="verbal_skills">
                    <option value></option>
                    <option value="1" @if( @$note->verbal_skills == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->verbal_skills == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->verbal_skills == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->verbal_skills == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->verbal_skills == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Career Focus</label>
                </div>
                
                <div class="col-sm-5">
                  <select id="rating" name="career_focus" id="career_focus">
                    <option value></option>
                    <option value="1" @if( @$note->career_focus == 1) selected="selected" @endif>Very Poor</option>
                    <option value="2" @if( @$note->career_focus == 2) selected="selected" @endif>Poor</option>
                    <option value="3" @if( @$note->career_focus == 3) selected="selected" @endif>Fair</option>
                    <option value="4" @if( @$note->career_focus == 4) selected="selected" @endif>Good</option>
                    <option value="5" @if( @$note->career_focus == 5) selected="selected" @endif>Very Good</option>
                  </select>
                  
                </div>
                
            <div class="clearfix"></div>
            </div> -->
             
            <div class="form-group">
                <hr>
                

            </div>
            
            
            
             
            <div class="form-group">
                <label for="" style="font-size: 17px;">General Comments</label>
                @if( count($note) > 0 )
                  <blockquote>{{ @$note->general_comments }}</blockquote>
                @else
                  <textarea  class="form-control"  name="general_comments" id="general_comments"></textarea>
                @endif
                <!-- <input type="text" class="form-control"  name="general_comments" id="general_comments" > -->
            </div>
                           
            <div class="form-group">
                <label for="" style="font-size: 17px;">Recommendation</label>
                @if( count($note) > 0 )
                  <blockquote>{{ @$note->recommendation }}</blockquote>
                @else
                  <textarea  class="form-control"  name="recommendation" id="recommendation" required></textarea>
                @endif
                
            </div>
           
        </div>

  

    </div>

    <div class="row"><br>
        
        @if( count($note) > 0 )

        @else
          <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
              <button type="submit" class="btn btn-success btn-block">Save </button>
          </div>
        @endif

        

    </div>
</form>

<div class="clearfix"></div>

<script src="{{ asset('js/jquery.barrating.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/rating-themes/bars-movie.css') }}">

@if( count($note) > 0 )
  <script type="text/javascript">
   $(function() {
      $('body #rating').barrating({
        theme: 'bars-movie',
        readonly:true
      });
   });
</script>
@else
  <script type="text/javascript">
   $(function() {
      $('body #rating').barrating({
        theme: 'bars-movie'
      });
   });
</script>
@endif

<script type="text/javascript">
 $(document).ready(function(){
  
  $.fn.serializeObject = function()
  {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
          if (o[this.name] !== undefined) {
              if (!o[this.name].push) {
                  o[this.name] = [o[this.name]];
              }
              o[this.name].push(this.value || '');
          } else {
              o[this.name] = this.value || '';
          }
      });
      return o;
  };

  $('body #interview-note-form').on('submit',function(e){
       e.preventDefault();
      // var data = {
      //        job_id: '{{ $appl->job->id }}',
      //        cv_id :  "{{ $cv_id }}",
      //        location:  $('#interview-location').val(),
      //        date:  $('#interview-time').val(),
      //        message:  $('#interview-message').val()
      //      };
          $field = $(this);
          $radios = JSON.stringify($('body  #interview-note-form select').serializeObject());
          $texts = {
              general_comments : $('#general_comments').val(),
              recommendation : $('#recommendation').val(),
              job_application_id: {{ $app_id }},
              interviewer_id: {{ Auth::user()->id }}
          }
      $.post("{{ route('save-interview-note') }}", { radios : $radios, texts : $texts } ,function(data){

          $( '#viewModal' ).modal('toggle');
          $.growl.notice({ message: "You have interviewed " + $field.closest('.modal-body').find('.media-heading a').text() });
              sh.reloadStatus();
          });
        // console.log( JSON.stringify($(this).serializeObject()) );
    });
 });
 </script>
       


  