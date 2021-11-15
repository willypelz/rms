@include('emails.layout.header')
	<p style="font-family:Arial,Helvetica,sans-serif;color:#2d2d2d;font-size:15px;font-weight:400;margin:16px 0;padding:0;text-align: none;line-height:1.4em;">Dear {{ isset($user_name) ? $user_name : 'Admin' }},
	<br><br>
	<p> Thank you for registering for a SeamlessHiring Account</b> </p>
	<br>
	We can't wait for you to try the amazing features we have in store for you. Please find below your login details
	<br>
	<b>URL:</b><a href="{{getEnvData('APP_URL',null, $notifiable->client_id).'/login'}}"></a> <br>
	<b>Email:</b>{{$notifiable->email}} <br>
	<b>Password:</b> "Your preset password" <br>
	<a href="{{ route('login') }}" class="btn btn-block shr-auth-form-button">Go to login page</a>
	</p>
@include('emails.layout.footer')

																			