<body style="
    background: #dcdcdc;
    padding: 0;
    margin: 0;
">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;border-collapse:collapse;/* width:100% */">
		<tbody>
			<tr>
				<td style="font-family:Arial,Helvetica,sans-serif;padding: 0px 2% 12px;">
					<div style="color:#2d2d2d;display:block;max-width: 600px!important;margin:0 auto">
						<table cellpadding="0" cellspacing="0" style="font-family:Arial,Helvetica,sans-serif;border-collapse:collapse;width:100%!important;max-width: 600px!important;margin:0 auto">
							<tbody>
								<tr>
									<td style="font-family:Arial,Helvetica,sans-serif">



										<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;border-collapse:collapse;width:100%!important;text-align:center;background-color:#ffffff" bgcolor="#ffffff">
											<tbody>
												<tr>
													<td valign="top" style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;color:#2a3744;line-height:200%;padding: 30px 18px 0px;">
														<div style="color:#2d2d2d;display:block;width:100%;margin: 0 auto 5px;" align="center">
															{!! get_company_email_logo() !!}
														</div>




													</td>
												</tr>
											</tbody>
										</table>
										<table cellpadding="0" cellspacing="0" border="0" style="font-family:Arial,Helvetica,sans-serif;border-collapse:collapse;width:100%!important;background-color:#ffffff;margin:0 auto" bgcolor="#ffffff">
											<tbody>
												<tr>
													<td style="font-family:Arial,Helvetica,sans-serif;padding:0 6%">

														<div style="color:#2d2d2d;width:100%;float:left">




															<div style="color:#2d2d2d;width:100%;float:none;clear:both;">

																<div style="color:#5d5d5d;background-color: #fbfbfb;padding:5% 7% 7%;border: 1px dotted #cecece;border-radius: 4px;">
																	<div style="color:#2d2d2d;width:100%;margin:0 auto;">
																		<h3 style="font-size: 20px;margin:0 0 5%;padding:0;"><a href="" style="font-family: Roboto,'Open Sans','Helvetica Neue',Arial,Helvetica,sans-serif;word-wrap:break-word;color: #3a5979;text-decoration:none;display:block;text-align: center;width:100%;" target="_blank">Interview Invitation</a></h3>
																		<hr style="border-width:0 0 1px">
																		<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">Dear {{ $cv->first_name.' '.$cv->last_name }},
																		<br><br>
																		Trust this meets you well.
																		<br><br>We received your application for the job {{ $job->title }} at {{ $job->company->name }} company.
																		<br><br>Kindly acknowledge if you will be available for an interview on {{ date('D, j-n-Y, h:i A', strtotime($interview->date))  }}. The interview is scheduled to hold at {{ $interview->location }},
                                    and will last for {{ $interview->duration }} minutes
																		<br><br>Please ensure to come along with the necessary credentials.
																		@if( $interview->message != "" && !is_null( $interview->message ) )
																			<br><br>PLEASE NOTE:  {{ $interview->message }}
																		@endif
                                    <br><br>
                                    @if($interview->interview_file)
                                      You can download this file for further information
                                      <a href="{{asset('uploads/'.$interview->interview_file)}}" download>Download</a>
                                    @endif
																		</p>

																		<hr style="border-width:0 0 1px">
																		<p style="color:#666">Best,
																			<br> {{ get_current_company()->name }} Team</p>

																	</div>

																	<br>
																	<small style="color:#afafaf">If you did not attempt to sign up on www.seamlesshiring.com, kindly ignore this mail.</small>
																</div>
															</div>
															<div style="color:#2d2d2d;width:100%;float:left;margin-bottom:7%">



															</div>


														</div>
													</td>
												</tr>

											</tbody>
										</table>







										<div style="color:#777;width:94%;text-align:center;margin:7% auto 0;padding:0" align="center">
											<p style="font-family:Arial,Helvetica,sans-serif;color: #6b6b6b;font-size:12px;line-height:1.42em;text-align:center;margin:16px 0 8%;padding:0;" align="center">This notification was sent to <a href="mailto:{{ $cv->email }}" target="_blank">{{ $cv->email }}</a>
												<br> because you registered on seamlesshiring.com
												<br>
												<br> If you no longer wish to receive <i>any</i> notifications when an activity is carried out <a href="" style="font-family:Arial,Helvetica,sans-serif;word-wrap:break-word;color:#136fd2" target="_blank">unsubscribe</a>.
												<br>View SeamlessHiring's <a href="" target="_blank">Privacy Policy</a></p>

										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</body>
