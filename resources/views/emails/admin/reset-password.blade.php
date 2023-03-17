<x-mail::message>
# Admin Reset Password

We are received a request to reset the password for {{ env('APP_NAME', 'Laravel POS') }} account associated
with {{ $mailData['email'] }}.
You can reset your passowrd by clicking the link below:

<x-mail::button url="{{ $mailData['link'] }}">
Reset Password
</x-mail::button>

Thanks,<br>
{{ env('APP_NAME', 'Laravel POS') }}
</x-mail::message>
