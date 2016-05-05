
  {!! @$applicant_badge !!}              

@if( count($notes) > 0 )
  <div class="row">
        <div class="col-sm-12 ">  
          
          <div class="alert alert-warning text-center">
              You have already Interviewed this applicant
          </div>
        </div>
  </div>
@else

<form role="form" class="form-signin" method="POST" id="interview-note-form" action="" style="height: 300px;overflow: scroll;">
    {!! csrf_field() !!}
    
    <div class="row">
        <div class="col-sm-12">            
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">General Appearance</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_apperarance" id="general_apperarance" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_apperarance" id="general_apperarance" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_apperarance" id="general_apperarance" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_apperarance" id="general_apperarance" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_apperarance" id="general_apperarance" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Educational Background</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="educational_background" id="educational_background" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Prior Work Experience</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="prior_work_experience" id="prior_work_experience" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>


             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Professional Qualifications</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="professional_qualifications" id="professional_qualifications" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Verbal Communication</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_communication" id="verbal_communication" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Candidate Enthusiasm</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="candidate_enthusiasm" id="candidate_enthusiasm" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Relevant Experience</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="relevant_experience" id="relevant_experience" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Career Progression</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_progression" id="career_progression" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_progression" id="career_progression" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_progression" id="career_progression" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_progression" id="career_progression" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_progression" id="career_progression" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Initiative</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="initiative" id="initiative" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="initiative" id="initiative" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="initiative" id="initiative" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="initiative" id="initiative" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="initiative" id="initiative" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Time Management</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="time_management" id="time_management" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Customer Service Orientation</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="customer_service_orientation" id="customer_service_orientation" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Technology Enablement</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="technology_enablement" id="technology_enablement" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Brand Projection</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="brand_projection" id="brand_projection" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Intellectual Capacity</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="intellectual_capacity" id="intellectual_capacity" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="intellectual_capacity" id="intellectual_capacity" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="intellectual_capacity" id="intellectual_capacity" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="intellectual_capacity" id="intellectual_capacity" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="intellectual_capacity" id="intellectual_capacity" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Reasoning</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="reasoning" id="reasoning" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">General Knowledge</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_knowledge" id="general_knowledge" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Knowledge of Industry</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="knowledge_of_industry" id="knowledge_of_industry" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Quantitative Capacity</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="quantitative_capacity" id="quantitative_capacity" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="quantitative_capacity" id="quantitative_capacity" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="quantitative_capacity" id="quantitative_capacity" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="quantitative_capacity" id="quantitative_capacity" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="quantitative_capacity" id="quantitative_capacity" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Attitude to Issues</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="attitude_to_issues" id="attitude_to_issues" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Predesposition to Training</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="predesposition_to_training" id="predesposition_to_training" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Learning Skills</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="learning_skills" id="learning_skills" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Verbal Skills</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_skills" id="verbal_skills" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_skills" id="verbal_skills" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_skills" id="verbal_skills" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_skills" id="verbal_skills" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="verbal_skills" id="verbal_skills" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
            
             
            <div class="form-group">
                <div class="col-sm-7">
                  <label for="" style="font-size: 17px;">Career Focus</label>
                </div>
                
                <div class="col-sm-5">
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="1" > 1 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="2" > 2 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="3" > 3 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="4" > 4 </label>
                  <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="career_focus" id="career_focus" value="5" > 5 </label>
                </div>
                
            <div class="clearfix"></div>
            </div>
             
            <div class="form-group">
                <hr>
                

            </div>
            
            
            
             
            <div class="form-group">
                <label for="" style="font-size: 17px;">General Comments</label>
                <textarea  class="form-control"  name="general_comments" id="general_comments"></textarea>
                <!-- <input type="text" class="form-control"  name="general_comments" id="general_comments" > -->
            </div>
                           
            <div class="form-group">
                <label for="" style="font-size: 17px;">Recommendation</label>
                <textarea  class="form-control"  name="recommendation" id="recommendation"></textarea>
            </div>
           
        </div>

  

    </div>

    <div class="row"><br>

        <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
            <button type="submit" class="btn btn-success btn-block">Save </button>
        </div>

        

    </div>
</form>

<div class="clearfix"></div>



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
          $radios = JSON.stringify($('body  #interview-note-form input[type=radio]:checked').serializeObject());
          $texts = {
              general_comments : $('#general_comments').val(),
              recommendation : $('#recommendation').val(),
              job_application_id: {{ $app_id }},
              interviewer_id: {{ Auth::user()->id }}
          }
      $.post("{{ route('save-interview-note') }}", { radios : $radios, texts : $texts } ,function(data){

          $( '#viewModal' ).modal('toggle');
          $.growl.notice({ message: "You have interviewed " + $field.closest('.modal-body').find('.media-heading a').text() });
              
          });
        // console.log( JSON.stringify($(this).serializeObject()) );
    });
 });
 </script>
@endif       


  