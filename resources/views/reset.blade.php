<p>We heard that you lost your Live Chat password. Sorry about that!</p>
<p>But don’t worry! You can use the following link to reset your password:</p>
<p>{{URL::to('/')}}/change-pass?email={{ $email }}&token={{ $token }}</p>
{{-- If you don’t use this link within 3 hours, it will expire. To get a new password reset link, visit https://github.com/password_reset --}}
<p>Thanks,<br>
The Live Chat Team</p>
