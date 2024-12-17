@component('mail::message')
    Hello {{ $user->name}},
    <p> We Understand it Happens. </p>
    @component('mail::button', ['url' => url('reset/'.$user->remember_token)])
    Reset Your Password        
    @endcomponent
    <p>In Case you have any issues recovering password, please contact us</p>

    Thanks,<br>
    {{ config('app.name')}}
@endcomponent