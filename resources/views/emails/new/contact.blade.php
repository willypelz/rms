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
															{!! get_company_email_logo($company->logo) !!}
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
																		<h3 style="font-size: 20px;margin:0 0 5%;padding:0;"><a href="" style="font-family: Roboto,'Open Sans','Helvetica Neue',Arial,Helvetica,sans-serif;word-wrap:break-word;color: #3a5979;text-decoration:none;display:block;text-align: center;width:100%;" target="_blank">Talent Pool :: File(s) Upload Successful</a></h3>
																		<hr style="border-width:0 0 1px">
																		<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">Contact
																		<br><br>
																			<strong>Name: </strong> {{ @$data->name }} <br>
																			<strong>Email: </strong> {{ @$data->email }} <br>
																			<strong>Phone: </strong> {{ @$data->contact_phone }} <br>
																			<strong>Job Title: </strong> {{ @$data->job_title }} <br>
																			<strong>Enquiry Type: </strong> {{ @$data->enquiry_type }} <br>
																			<strong>Message: </strong> {{ @$data->msg }} <br>

																		</p>
																		<!-- <div style="color:#2d2d2d;" align="center">
																			<p> To view new upload, please</p> <a href="{{ $link }}" style="font-family:Arial;word-wrap:break-word;color:#ffffff;border-radius: 3px;display:inline-block;font-size:14px;font-weight:400;line-height: 42px;text-align:center;text-decoration:none;width:200px;background-color: #4BB779;text-transform:uppercase" target="_blank">Click here</a>
																		</div>
																		<p style="font-family:Arial,Helvetica,sans-serif; font-size:15px;line-height:1.3em;color:#afafaf">If clicking the link above does not work, kindly copy and paste it to your browser.</p>
																		<hr style="border-width:0 0 1px">
																		<p style="color:#666">Best Regards</p>
 -->
																	</div>

																	<br>
																	<small style="color:#afafaf">If you did not attempt to sign up on {{ getEnvData('APP_URL') }}, kindly ignore this mail.</small>
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
											<p style="font-family:Arial,Helvetica,sans-serif;color: #6b6b6b;font-size:12px;line-height:1.42em;text-align:center;margin:16px 0 8%;padding:0;" align="center">This notification was sent to <a href="mailto:{{ @$user->email }}" target="_blank">{{ @$user->email }}</a>
												<br> because you registered on {{ getEnvData('APP_URL') }}
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
