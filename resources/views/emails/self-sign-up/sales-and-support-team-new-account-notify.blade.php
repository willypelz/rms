@include('emails.layout.header')
	<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">Dear {{ isset($user_name) ? $user_name : 'Admin' }},
	<br><br>
	<p> A new client - {{$notifiable->client->name}} has just created a SeamlessHiring Account</b> </p>
	<br>
	Find below some details that can help in your follow up with them.
	<br>
	<b>URL:</b><a href="{{$notifiable->client->url.'/login'}}"></a> <br>
	<b>Email:</b>{{$notifiable->email}} <br>
	</p>
@include('emails.layout.footer')

																			