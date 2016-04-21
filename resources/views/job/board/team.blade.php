@extends('layout.template-user')

@section('content')

                    @include('job.board.jobBoard-header')
            
   
            <div class="row">

                <div class="col-sm-12">
                    <div class="page no-bod-rad">
                        <div class="row">


                            @include('job.board.job-board-tabs')
                      
                      <div class="tab-content">


                        <div class="row">  
                          <p>Manage your team members for this job here.</p>                         
                        <!-- applicant -->
                        <div class="col-xs-7">
                            <h5 class="no-margin"> <!-- <i class="fa fa-lg fa-users"></i> --> Team members</h5><hr>

                            <ul class="list-group">
                                @foreach($users->users as $user)
                                <li class="list-group-item">
                                    <div class="col-xs-2"><img width="100%" alt="" src="img/avatar.jpg" class="img-circle"></div>
                                    <div class="col-xs-6">
                                        <h5> {{ $user->name }}</h5>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                    <div class="col-xs-4 small"><br>
                                        <span class="pull-right"><a onclick="EditAction({{ $user->id }}); return false" class="" href=""><i class="fa fa-pencil"></i> &nbsp; Edit</a> &nbsp; · &nbsp;
                                            <a class="text-muted" href=""><i class="fa fa-close"></i> Remove</a></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                @endforeach
                              
                            </ul>

                        </div>

                        <script>
                          function EditAction(id){
                            console.log(id)

                            $('#Section2').html('Please wait..... loading');

                            var url = "{{ route('ajax-edit-team') }}"
                            console.log(url)
                             $.ajax
                              ({
                                  type: "POST",
                                  url: url,
                                  data: ({ rnd : Math.random() * 100000, user_id:id }),
                                  success: function(response){
                                       console.log(response)

                                       $('#Section2').html(response);
                                  }
                              });
                          }

                        </script>

                        <div class="col-xs-5" id="Section2">
                            <h5 class="no-margin">Add New Team member <span class="pull-right"><i class="fa fa-lg fa-user-plus"></i></span></h5><hr>

                            <a aria-controls="AddTeamMember" aria-expanded="false" class="btn btn-warning" data-toggle="collapse" data-target="#AddTeamMember" href="#AddTeamMember"><i class="fa fa-user-plus"></i> Add New Member</a>

                            <div id="AddTeamMember" class="collapse">
                               <div class="alert alert-success"><i class="fa fa-check fa-lg"></i>
                                    &nbsp; Your mail has been sent. Refresh page to send more.</div>
                                   <form action="">

                                   <div class="form-group">
                                       <label for="">From: </label>
                                       <input type="text" disabled="" value="dejilana@insidify.com" class="form-control">
                                       
                                       <label for="">To: </label>
                                       <small>Separate your addresses by a comma</small>
                                       <input type="text" placeholder="email addresses here" class="form-control">
                                   </div>

                                   <label for="editor1">Body of Mail</label>
                                       <textarea rows="10" cols="30" id="editor1" name="" style="visibility: hidden; display: none;">                                       &lt;p&gt;Hello there, I have a job you might be interested in&lt;/p&gt;
                                       &lt;hr style="width: 45%"&gt;
                                           &lt;strong class=""&gt;Human Resource Administrator&lt;br&gt;
                                               &lt;small&gt;at Kingston Industries&lt;/small&gt;
                                           &lt;/strong&gt;
                                           &lt;p&gt;
                                               &lt;a href="job-page.php"&gt;Visit this link to see Job details.&lt;/a&gt;
                                           &lt;/p&gt;
                                           &lt;p&gt;Thank you.&lt;/p&gt;
                                       </textarea><div lang="en" aria-labelledby="cke_editor1_arialbl" role="application" dir="ltr" class="cke_1 cke cke_reset cke_chrome cke_editor_editor1 cke_ltr cke_browser_gecko" id="cke_editor1"><span class="cke_voice_label" id="cke_editor1_arialbl">Rich Text Editor, editor1</span><div role="presentation" class="cke_inner cke_reset"><span style="height: auto; -moz-user-select: none;" role="presentation" class="cke_top cke_reset_all" id="cke_1_top"><span class="cke_voice_label" id="cke_5">Editor toolbars</span><span onmousedown="return false;" aria-labelledby="cke_5" role="group" class="cke_toolbox" id="cke_1_toolbox"><span role="toolbar" aria-labelledby="cke_6_label" class="cke_toolbar" id="cke_6"><span class="cke_voice_label" id="cke_6_label">Basic Styles</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(2,this);return false;" onfocus="return CKEDITOR.tools.callFunction(1,event);" onkeydown="return CKEDITOR.tools.callFunction(0,event);" onblur="this.style.cssText = this.style.cssText;" onkeypress="return false;" aria-haspopup="false" aria-labelledby="cke_7_label" role="button" hidefocus="true" tabindex="-1" title="Bold" class="cke_button cke_button__bold cke_button_off" id="cke_7"><span style="background-image:url('http://cdn.ckeditor.com/4.5.7/basic/plugins/icons.png?t=G14E');background-position:0 -24px;background-size:auto;" class="cke_button_icon cke_button__bold_icon">&nbsp;</span><span aria-hidden="false" class="cke_button_label cke_button__bold_label" id="cke_7_label">Bold</span></a><a onclick="CKEDITOR.tools.callFunction(5,this);return false;" onfocus="return CKEDITOR.tools.callFunction(4,event);" onkeydown="return CKEDITOR.tools.callFunction(3,event);" onblur="this.style.cssText = this.style.cssText;" onkeypress="return false;" aria-haspopup="false" aria-labelledby="cke_8_label" role="button" hidefocus="true" tabindex="-1" title="Italic" class="cke_button cke_button__italic cke_button_off" id="cke_8"><span style="background-image:url('http://cdn.ckeditor.com/4.5.7/basic/plugins/icons.png?t=G14E');background-position:0 -48px;background-size:auto;" class="cke_button_icon cke_button__italic_icon">&nbsp;</span><span aria-hidden="false" class="cke_button_label cke_button__italic_label" id="cke_8_label">Italic</span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_9_label" class="cke_toolbar" id="cke_9"><span class="cke_voice_label" id="cke_9_label">Paragraph</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(8,this);return false;" onfocus="return CKEDITOR.tools.callFunction(7,event);" onkeydown="return CKEDITOR.tools.callFunction(6,event);" onblur="this.style.cssText = this.style.cssText;" onkeypress="return false;" aria-haspopup="false" aria-labelledby="cke_10_label" role="button" hidefocus="true" tabindex="-1" title="Insert/Remove Numbered List" class="cke_button cke_button__numberedlist cke_button_off" id="cke_10"><span style="background-image:url('http://cdn.ckeditor.com/4.5.7/basic/plugins/icons.png?t=G14E');background-position:0 -576px;background-size:auto;" class="cke_button_icon cke_button__numberedlist_icon">&nbsp;</span><span aria-hidden="false" class="cke_button_label cke_button__numberedlist_label" id="cke_10_label">Insert/Remove Numbered List</span></a><a onclick="CKEDITOR.tools.callFunction(11,this);return false;" onfocus="return CKEDITOR.tools.callFunction(10,event);" onkeydown="return CKEDITOR.tools.callFunction(9,event);" onblur="this.style.cssText = this.style.cssText;" onkeypress="return false;" aria-haspopup="false" aria-labelledby="cke_11_label" role="button" hidefocus="true" tabindex="-1" title="Insert/Remove Bulleted List" class="cke_button cke_button__bulletedlist cke_button_off" id="cke_11"><span style="background-image:url('http://cdn.ckeditor.com/4.5.7/basic/plugins/icons.png?t=G14E');background-position:0 -528px;background-size:auto;" class="cke_button_icon cke_button__bulletedlist_icon">&nbsp;</span><span aria-hidden="false" class="cke_button_label cke_button__bulletedlist_label" id="cke_11_label">Insert/Remove Bulleted List</span></a><span role="separator" class="cke_toolbar_separator"></span><a onclick="CKEDITOR.tools.callFunction(14,this);return false;" onfocus="return CKEDITOR.tools.callFunction(13,event);" onkeydown="return CKEDITOR.tools.callFunction(12,event);" onblur="this.style.cssText = this.style.cssText;" onkeypress="return false;" aria-disabled="true" aria-haspopup="false" aria-labelledby="cke_12_label" role="button" hidefocus="true" tabindex="-1" title="Decrease Indent" class="cke_button cke_button__outdent cke_button_disabled " id="cke_12"><span style="background-image:url('http://cdn.ckeditor.com/4.5.7/basic/plugins/icons.png?t=G14E');background-position:0 -384px;background-size:auto;" class="cke_button_icon cke_button__outdent_icon">&nbsp;</span><span aria-hidden="false" class="cke_button_label cke_button__outdent_label" id="cke_12_label">Decrease Indent</span></a><a onclick="CKEDITOR.tools.callFunction(17,this);return false;" onfocus="return CKEDITOR.tools.callFunction(16,event);" onkeydown="return CKEDITOR.tools.callFunction(15,event);" onblur="this.style.cssText = this.style.cssText;" onkeypress="return false;" aria-haspopup="false" aria-labelledby="cke_13_label" role="button" hidefocus="true" tabindex="-1" title="Increase Indent" class="cke_button cke_button__indent cke_button_off" id="cke_13"><span style="background-image:url('http://cdn.ckeditor.com/4.5.7/basic/plugins/icons.png?t=G14E');background-position:0 -336px;background-size:auto;" class="cke_button_icon cke_button__indent_icon">&nbsp;</span><span aria-hidden="false" class="cke_button_label cke_button__indent_label" id="cke_13_label">Increase Indent</span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_14_label" class="cke_toolbar" id="cke_14"><span class="cke_voice_label" id="cke_14_label">Links</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(20,this);return false;" onfocus="return CKEDITOR.tools.callFunction(19,event);" onkeydown="return CKEDITOR.tools.callFunction(18,event);" onblur="this.style.cssText = this.style.cssText;" onkeypress="return false;" aria-haspopup="false" aria-labelledby="cke_15_label" role="button" hidefocus="true" tabindex="-1" title="Link" class="cke_button cke_button__link cke_button_off" id="cke_15"><span style="background-image:url('http://cdn.ckeditor.com/4.5.7/basic/plugins/icons.png?t=G14E');background-position:0 -456px;background-size:auto;" class="cke_button_icon cke_button__link_icon">&nbsp;</span><span aria-hidden="false" class="cke_button_label cke_button__link_label" id="cke_15_label">Link</span></a><a onclick="CKEDITOR.tools.callFunction(23,this);return false;" onfocus="return CKEDITOR.tools.callFunction(22,event);" onkeydown="return CKEDITOR.tools.callFunction(21,event);" onblur="this.style.cssText = this.style.cssText;" onkeypress="return false;" aria-disabled="true" aria-haspopup="false" aria-labelledby="cke_16_label" role="button" hidefocus="true" tabindex="-1" title="Unlink" class="cke_button cke_button__unlink cke_button_disabled " id="cke_16"><span style="background-image:url('http://cdn.ckeditor.com/4.5.7/basic/plugins/icons.png?t=G14E');background-position:0 -480px;background-size:auto;" class="cke_button_icon cke_button__unlink_icon">&nbsp;</span><span aria-hidden="false" class="cke_button_label cke_button__unlink_label" id="cke_16_label">Unlink</span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_17_label" class="cke_toolbar" id="cke_17"><span class="cke_voice_label" id="cke_17_label">about</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(26,this);return false;" onfocus="return CKEDITOR.tools.callFunction(25,event);" onkeydown="return CKEDITOR.tools.callFunction(24,event);" onblur="this.style.cssText = this.style.cssText;" onkeypress="return false;" aria-haspopup="false" aria-labelledby="cke_18_label" role="button" hidefocus="true" tabindex="-1" title="About CKEditor" class="cke_button cke_button__about cke_button_off" id="cke_18"><span style="background-image:url('http://cdn.ckeditor.com/4.5.7/basic/plugins/icons.png?t=G14E');background-position:0 0px;background-size:auto;" class="cke_button_icon cke_button__about_icon">&nbsp;</span><span aria-hidden="false" class="cke_button_label cke_button__about_label" id="cke_18_label">About CKEditor</span></a></span><span class="cke_toolbar_end"></span></span></span></span><div role="presentation" class="cke_contents cke_reset" id="cke_1_contents" style="height: 200px;"><iframe frameborder="0" src="" style="width: 100%; height: 100%;" class="cke_wysiwyg_frame cke_reset" title="Rich Text Editor, editor1" tabindex="0" allowtransparency="true"></iframe></div></div></div>
                                       <script>
                                           // Replace the &lt;textarea id="editor1"&gt; with a CKEditor
                                           // instance, using default configuration.
                                           CKEDITOR.replace( 'editor1' );
                                       </script>
                                   </form>
                                   <br>
                                   <p>
                                       <a class="btn btn-line btn-sm" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button"><i class="fa fa-times"></i> &nbsp; Cancel</a>

                                       <a class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button">Send Mail &nbsp; <i class="fa fa-send"></i></a>
                                   </p>
                               </div>
                        </div>
                                
                        </div>

                    </div>
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>

<div class="separator separator-small"><br></div>
@endsection