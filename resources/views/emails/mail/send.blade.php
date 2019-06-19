@component('mail::message')

#Check My New Deal.
User {{ $deal->user->name }}
{{$deal->title}}

@component('mail::button', ['url' => $deal->link])
View Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
