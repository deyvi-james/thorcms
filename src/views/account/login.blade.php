@extends(Config::get('thor::views.account_layout'))
@section('main')
<form class="form-signin" role="form" method="POST" action="{{{ URL::route('account.login') }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    
    <h2 class="form-signin-heading">Please sign in</h2>
    <input type="text" name="email" class="form-control" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" required autofocus>
    <input  type="password" name="password" class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" required value="{{{ Input::old('email') }}}">
    <div class='help-block'>
        <a href="{{{ URL::route('account.forgot') }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
    </div>
    <label for="remember" class="checkbox">{{{ Lang::get('confide::confide.login.remember') }}}
        <input type="hidden" name="remember" value="0">
        <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
    </label>

    @if ( Session::get('error') )
    <div class="alert alert-error">{{{ Session::get('error') }}}</div>
    @endif

    @if ( Session::get('notice') )
    <div class="alert">{{{ Session::get('notice') }}}</div>
    @endif
    <button type="submit" class="btn btn-lg btn-primary btn-block">{{{ Lang::get('confide::confide.login.submit') }}}</button>

</form>
@stop
