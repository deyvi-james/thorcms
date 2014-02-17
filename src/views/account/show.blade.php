@extends(Config::get('thor::views.account_layout'))
@section('main')
<h2 class="form-signin-heading">{{auth_user()->email}}</h2>
<a href="{{URL::action('account.logout')}}">Logout</a>
<?php var_dump(auth_user()); ?>
@stop
