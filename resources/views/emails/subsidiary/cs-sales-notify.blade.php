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
																			<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">Dear Sales and CS Team,
																			<br><br>
																			<p> {{ isset($user->name) ? $user->name : $user->first_name }} of {{ @get_current_company()->name }} has just created {{$subsidiary}} subsidiary on RMS on a 28 day trial period.</b> </p>
																			<br>
																			Please reach out to client on how subscription payment will be made for the new addition before the trial period expires. 
																			</p>

																			<hr style="border-width:0 0 1px">
																			<p style="color:#666">Best regards,
																				<br> SeamlessHiring Team</p>

																		</div>

																		<!-- <br> -->
																		<!-- <small style="color:#afafaf">If you did not attempt to sign up on {{ getEnvData('APP_URL') }}, kindly ignore this mail.</small> -->
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
											<p style="font-family:Arial,Helvetica,sans-serif;color: #6b6b6b;font-size:12px;line-height:1.42em;text-align:center;margin:16px 0 8%;padding:0;" align="center">This notification was sent to <a href="mailto:sales@seamlesshr.com,cs@seamlesshr.com" target="_blank">sales@seamlesshr.com,cs@seamlesshr.com</a>
												<br> because a subsidiary was created on {{ getEnvData('APP_URL') }}
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