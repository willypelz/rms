@include('emails.layout.header')
	<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">Dear {{ isset($user_name) ? $user_name : 'Admin' }},
	<br><br>
	<p> A new client has just created a SeamlessHiring Account</b> </p>
	<br>
	Find below some details that can help in your follow up with them.
	<br><p></p>
	<b>CLIENT:</b> {{$notifiable->client->name}}
	<p></p>
	<b>URL:</b><a href="{{$notifiable->client->url.'/login'}}">{{$notifiable->client->url}}</a> <br>
	<p></p>
	<b>Email:</b>{{$notifiable->email}} <br>
	</p>
	<hr style="border-width:0 0 1px">
	<p style="color:#666">Best regards,
		<br> SeamlessHiring Team</p>

</div>

</div>
</div>
<div style="color:#2d2d2d;width:100%;float:left;margin-bottom:7%">


</div>

</div>
</td>
</tr>

</tbody>
</table>

																			