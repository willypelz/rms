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
															<a href="http://seamlesshiring.com" style="font-family:Arial,Helvetica,sans-serif;word-wrap:break-word;color:#136fd2" target="_blank"><img src="{{ asset('img/seamlesshiring-logo.png') }}" width="50%" height="" style="outline:none;text-decoration:none;display:block;min-height:31px;margin:0 auto;border:0;" class="CToWUd" alt="Seamlesshiring"></a>
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
																			<h3 style="font-size: 20px;margin:0 0 5%;padding:0;"><span  style="font-family: Roboto,'Open Sans','Helvetica Neue',Arial,Helvetica,sans-serif;word-wrap:break-word;text-decoration:none;display:block;text-align: center;width:100%;" target="_blank"> {{ $email_title}} </span></h3>
																			<hr style="border-width:0 0 1px">
																			<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">Dear {{ isset($user->name) ? $user->name : $user->first_name }},
																			<br><br>
																			<p> Amazing work creating a new subsidiary {{$subsidiary}} on your Hiring platform </b> </p>
																			<br>
																			We are delighted you would like to expand your access to more Talents. We are giving you a free 28-day access to {{$subsidiary}} after which a subscription will be required.
																			<br>
																			If you enjoyed the experience and wish to activate your subsidiary account, please email our Customer success team at support-team@seamlesshr.com or call 08090643874 and we will be sure to offer all the required assistance.
																			<br>
																			We are anxious to hear from you.
																			</p>

																			<hr style="border-width:0 0 1px">
																			<p style="color:#666">Best regards,
																				<br> SeamlessHiring Team</p>

																		</div>

																		<!-- <br>
																		<small style="color:#afafaf">If you did not attempt to sign up on {{ getEnvData('APP_URL') }}, kindly ignore this mail.</small> -->
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
											<p style="font-family:Arial,Helvetica,sans-serif;color: #6b6b6b;font-size:12px;line-height:1.42em;text-align:center;margin:16px 0 8%;padding:0;" align="center">This notification was sent to <a href="mailto:{{$user->email}},{{@get_current_company()->email}}" target="_blank">{{$user->email}} & {{@get_current_company()->email}}</a>
												<br> because you created a subsidiary on {{ getEnvData('APP_URL') }}
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