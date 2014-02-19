@extends(Config::get('thor::views.master_layout'))

@section('main')
<div class="jumbotron al-c">
    <h1> <span class="thor-logo">{{Config::get('thor::brand_name')}}</span></h1>
    <p>
        Content Management System framework for Laravel 4
    </p>
</div>
@stop