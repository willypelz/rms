@include('emails.layout.header')
	<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">Dear {{ isset($user_name) ? $user_name : 'Admin' }},
	<br><br>
	<p> You have just signed up for a SeamlessHiring Account</b> </p>
	<br>
	We can't wait for you to try the amazing features we have in store for you. Please find below your login details
	<br><p></p>
	{{-- <b>URL:</b><a href="{{getEnvData('APP_URL',null, $notifiable->client_id).'/login'}}">{{getEnvData('APP_URL',null, $notifiable->client_id)}}</a> <br> --}}
	<p></p>
	<b>Email:</b>{{$notifiable->email}} <br>
	<p></p>
	<b>Password:</b> "Your preset password" <br><p></p>
	
	<a href="{{getEnvData('APP_URL',null, $notifiable->client_id).'/login'}}" class="btn btn-primary">Go to login page</a>
	
	</p>
@include('emails.layout.footer')

																			