@component('mail::message')
    <div class="mail">
        <h2>Hello developer {{$user->name}},</h2>
{{--{{ auth()->user()->name  }}--}}

<p>Welcome to our application</p>

<br>
<img src="{{asset('/storage/images/1600498271_pexels-pixabay-33545.jpg')}}"
    style="align-items: center; margin-top: 20px">
@component('mail::button', ['url' => ''])
Click here to view the documentation
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
{{--<h5 style="color: orangered">Social App Api Team</h5>--}}
<p style="text-align: center; font-style: italic">Please do not reply to this email</p>
    </div>
@endcomponent
<style>
  .content-cell{
      background-color: #020521;
      color: #ffffff;
  }

  .button-primary{
      color: white;
  }

</style>
