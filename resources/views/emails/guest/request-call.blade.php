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
																			<h3 style="font-size: 20px;margin:0 0 5%;padding:0;"><span  style="font-family: Roboto,'Open Sans','Helvetica Neue',Arial,Helvetica,sans-serif;word-wrap:break-word;text-decoration:none;display:block;text-align: center;width:100%;" target="_blank"> Product Inquiry Request </span></h3>
																			<hr style="border-width:0 0 1px">
																			<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">Dear {{ isset($user_name) ? $user_name : 'Admin' }},
																			<br><br>
<h4>Hello, {{ ucwords( $firstname. " " . $surname ) }} just requested for a call. Here are the details</h4>
<p> <strong>Company: </strong> {{ ucwords( $company_name ) }}</p>
<p> <strong>Package: </strong> {{ ucwords( $package ) }}</p>
<p> <strong>Phone: </strong> {{ $phone  }}</p>
<p> <strong>Email: </strong> {{ $email  }}</p>
<hr style="border-width:0 0 1px">
																			<p style="color:#666">Best regards,
																				<br> SeamlessHiring Team</p>

																		</div>

																		<!-- <br>
																		<small style="color:#afafaf">If you did not attempt to sign up on {{ env('APP_URL') }}, kindly ignore this mail.</small> -->
																	</div>
																</div>
																<div style="color:#2d2d2d;width:100%;float:left;margin-bottom:7%">


																</div>

														</div>
													</td>
												</tr>
												
											</tbody>
										</table>







								
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