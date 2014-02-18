<?php

return array(
    // LAYOUTS
    'master_layout' => 'thor::layouts.master',
    'account_layout' => 'thor::layouts.account',
    // ACCOUNT VIEWS
    'account_show' => 'thor::account.show',
    'account_login_form' => 'thor::account.login',
    'account_signup_form' => 'thor::account.signup',
    'account_forgot_password_form' => 'thor::account.forgot_password',
    'account_reset_password_form' => 'thor::account.reset_password',
    // MAIL VIEWS
    'account_email_reset_password' => 'thor::account.emails.passwordreset', // with $user and $token.
    'account_email_account_confirmation' => 'thor::account.emails.confirm', // with $user
    // ADMIN PARTIAL VIEWS
    'admin_navbar' => 'thor::partials.navbar',
    'admin_sidebar' => 'thor::partials.sidebar',
    // ADMIN VIEWS
    'admin_home' => 'thor::admin.home',
    'languages_index' => 'thor::admin.languages.index',
    'languages_create' => 'thor::admin.languages.create',
    'languages_show' => 'thor::admin.languages.show',
    'languages_edit' => 'thor::admin.languages.edit',
);
