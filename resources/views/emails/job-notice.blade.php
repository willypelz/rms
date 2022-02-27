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
																		<hr style="border-width:0 0 1px">
																		<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">There is a new opening with us
																		<br><br>
																			
																			<strong>Job Title: </strong> {{ $data->title }} <br>
                                                                            <strong>Expiry Date: </strong>{{ $data->expiry_date }}<br>
                                                                            <strong>Position: </strong>{{ $data->position }} <br>
																			<strong>Description: </strong> {{ $data->summary }} <br>

																		</p>
																	</div>

																	<br>
                                                                    <p>If your are interested <a href="{{ $url }}" style="font-family:Arial,Helvetica,sans-serif;word-wrap:break-word;color:#136fd2" >Apply here</a></p>
																	<small style="color:#afafaf">If you are no longer a staff of {{ getEnvData('COMPANY_NAME') }}, kindly ignore this mail.</small>
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
											<p style="font-family:Arial,Helvetica,sans-serif;color: #6b6b6b;font-size:12px;line-height:1.42em;text-align:center;margin:16px 0 8%;padding:0;" align="center">This notification was sent to <a href="mailto:{{ $user->email }}" target="_blank">{{ $user->email }}</a>
												<br> because you registered on {{ getEnvData('APP_URL') }}
												<br>
												<br> If you no longer wish to receive <i>any</i> job notifications when an activity is carried out <a href="" style="font-family:Arial,Helvetica,sans-serif;word-wrap:break-word;color:#136fd2" target="_blank">unsubscribe</a>.
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
