<h1>{{ Lang::get('thor::confide.email.password_reset.subject') }}</h1>

<p>{{ Lang::get('thor::confide.email.password_reset.greetings', array( 'name' => $user->username)) }},</p>

<p>{{ Lang::get('thor::confide.email.password_reset.body') }}</p>
<a href='{{{ URL::route('account.reset_password') .$token  }}}'>
    {{{ URL::route('account.reset_password') .$token }}}
</a>

<p>{{ Lang::get('thor::confide.email.password_reset.farewell') }}</p>
<?php
Confide::checkAction($action);
?>