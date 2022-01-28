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


										<div style="color:#777;width:94%;text-align:center;margin:7% auto 0;padding:0" align="center">
											<p style="font-family:Arial,Helvetica,sans-serif;color: #6b6b6b;font-size:12px;line-height:1.42em;text-align:center;margin:16px 0 8%;padding:0;" align="center">This notification was sent to <a href="mailto:{{$user_email}},{{$email}}" target="_blank">{{$user_email}} & {{$email}}</a>
												<br> because you created an account on {{ getEnvData('APP_URL',null,$notifiable->client_id) }}
												<br>
												<br> If you no longer wish to receive <i>any</i> notifications when an activity is carried out <a href="" style="font-family:Arial,Helvetica,sans-serif;word-wrap:break-word;color:#136fd2" target="_blank">unsubscribe</a>.
												<br>View SeamlessHiring's <a href="" target="_blank">Privacy Policy</a>
											</p>

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