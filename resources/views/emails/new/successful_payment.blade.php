<body style="
	background: #b6c3cc;
	padding: 0;
	margin: 0;
	">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;border-collapse:collapse;background-clor:#2889CE">
		<tbody style="background: #b6c3cc;">
			<tr style="background: #b6c3cc;">
				<td style="font-family:Arial,Helvetica,sans-serif;padding: 0px 2% 12px; background: #b6c3cc;">
					<div style="color:#2d2d2d;display:block;max-width: 600px!important;margin:0 auto">
						<table cellpadding="0" cellspacing="0" style="font-family:Arial,Helvetica,sans-serif;border-collapse:collapse;width:100%!important;max-width: 600px!important;margin:20px auto 0">
							<tbody>
								<tr>
									<td style="font-family:Arial,Helvetica,sans-serif">
										<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;border-collapse:collapse;width:100%!important;text-align:center;background-color:#ffffff" bgcolor="#ffffff">
											<tbody>
												<tr>
													<td valign="top" style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;color:#2a3744;line-height:200%;padding: 30px 18px 0px;">
														<div style="color:#2d2d2d;display:block;width:100%;margin: 0 auto 5px;" align="center">
															<a href="http://seamlesshiring.com" style="font-family:Arial,Helvetica,sans-serif;word-wrap:break-word;color:#136fd2" target="_blank"><img src="https://cdn.insidify.com/dist/img/logos/seamlesshiring.svg" height="40px" style="outline:none;text-decoration:none;display:block;min-height:31px;margin:0 auto;border:0;" class="CToWUd" alt="Insidify Discovery"></a>
															
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
															<div style="color:#2d2d2d;width:100%;float:none;clear:both;padding-top: 35px;">
																<div style="color:#5d5d5d;background-color: #fbfbfb;padding:5% 7% 7%;border: 1px dotted #cecece;border-radius: 4px;">
																	
																	
																	<!--																CONTENTS SECTION-->
																	<div style="color:#2d2d2d;width:100%;margin:0 auto;">
																		<a style="text-decoration:none"><h3 style="font-size: 20px; font-family: Roboto,'Open Sans','Helvetica Neue',Arial,Helvetica,sans-serif;word-wrap:break-word;color:#2889ce;text-decoration:none;display:block;text-align: center;text-transform:capitalize;width:100%;margin:0 0 5%;padding:0;">Successful Payment of ₦{{$amount}} (Invoice #{{ $invoice->id }})</h3></a>
																		<hr style="border-width:0 0 1px">
																		<!--																		Paste New template here-->
																		<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.3em;">Dear {{ $user->name }}, <br>
																		<br>You have just made a successful payment for the invoice #{{ $invoice->id }}.</p>
																		<p>Find the details below.</p>

																		<p style="font-weight: bold">
																			Status: Approved by Financial Institution. <br>
																			Amount Paid: ₦{{ number_format( $amount ) }}  <br>
																			Transaction Ref No: {{ encrypt( $invoice->id ) }} <br>
																			Date: {{ date('D. j M, Y', strtotime( $invoice->updated_at ) ) }} <br>
																		</p>
																		<p>If you have any issues with this transaction, do not hesitate to send us a mail at support@seamlesshiring.com stating the transaction reference number.
																			 Note: This email will serve as an official receipt for this payment. 
																			</p>

																		<div style="color:#2d2d2d;" align="center">
																			<a href="" style="font-family:Arial;word-wrap:break-word;color:#ffffff;border-radius: 3px;display:inline-block;font-size:14px;font-weight:400;line-height: 42px;text-align:center;text-decoration:none;width:auto;padding:0px 15px;background-color: #4bb779;text-transform:uppercase" target="_blank">proceed to your dashboard</a>
																		</div>

																		<p>	Best, <br>
																			The SeamlessHiring Team
																		</p>																		
																		
																		<hr style="border-width:0 0 1px">
																	</div>
																	<!--END OF CONTENTS SECTION -->
																	
																	<small style="color:#afafaf">You are receiving this mail because the recruiter for this job is registered on SeamlessHiring. If you did not attempt to apply on www.seamlesshiring.com, kindly ignore this mail.</small>
																</div>
															</div>
															<div style="color:#2d2d2d;width:100%;float:left;margin-bottom:7%">
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td style="background-color: #28323c; font-family:Arial,Helvetica,sans-serif;padding:0 7% 7%">
														<div style="color:#2d2d2d;width:100%;float:none;clear:both;text-align:center;padding:0 0 5%" align="center">
															<p style="font-family:Arial,Helvetica,sans-serif;color:#fff;font-size:12px;font-weight:700;text-transform:uppercase;margin:5% 0;padding:0;letter-spacing:2px">Follow Insidify</p>
															<table border="0" style="font-family:Arial,Helvetica,sans-serif;border-collapse:collapse;width:100%!important;max-width:290px;margin:0 auto;">
																<tbody>
																	<tr>
																		<td align="center">
																			<div style="color:#2d2d2d">
																				<a href="https://www.facebook.com/insidifycom" target="_blank">
																					<img src="https://cdn.insidify.com/dist/img/icons/fbook-email.png" width="38px" height="38px" alt="">
																				</a>
																			</div>
																		</td>
																		<td align="center">
																			<div style="color:#2d2d2d">
																				<a href="https://twitter.com/insidifyjobs" target="_blank">
																					<img src="https://cdn.insidify.com/dist/img/icons/tw-email.png" width="38px" height="38px" alt="">
																				</a>
																			</div>
																		</td>
																		<td align="center">
																			<div style="color:#2d2d2d">
																				<a href="https://www.linkedin.com/company/insidify-com" target="_blank">
																					<img src="https://cdn.insidify.com/dist/img/icons/in-email.png" width="38px" height="38px" alt="">
																				</a>
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
														<div style="color:#fff;width:100%;text-align:center;margin:0;padding:0" align="center">
															<p style="font-family:Arial,Helvetica,sans-serif;color: #ddd;font-size:12px;line-height:1.42em;text-align:center;margin:0 10px;padding:0;" align="center">

															<br> If you no longer wish to receive <i>any</i> notifications when an activity is carried out <a href="" style="font-family:Arial,Helvetica,sans-serif;word-wrap:break-word;color:#fff" target="_blank">unsubscribe</a>.
															<br>View Seamlesshiring's <a href="" target="_blank" style="color:#fff">Privacy Policy</a></p>
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