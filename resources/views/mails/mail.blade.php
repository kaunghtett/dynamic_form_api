@component('mail::message')
# {{ $form['title'] }}
Form Submitted By {{$user['name']}}
@component('mail::button', ['url' => "https://github.com/kaunghtett"])
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent