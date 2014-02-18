<h1>{{ Lang::get('thor::confide.email.account_confirmation.subject') }}</h1>

<p>{{ Lang::get('thor::confide.email.account_confirmation.greetings', array( 'name' => $user->username)) }},</p>

<p>{{ Lang::get('thor::confide.email.account_confirmation.body') }}</p>
<a href='{{{ URL::route("account.confirm") . $user->confirmation_code }}}'>
    {{{ URL::to("user/confirm/{$user->confirmation_code}") }}}
</a>

<p>{{ Lang::get('thor::confide.email.account_confirmation.farewell') }}</p>
