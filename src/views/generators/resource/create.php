@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>Create <?php echo ucfirst($singular); ?></h1>
{{ Form::open(array('method' => 'POST', 'route' => array('<?php echo admin_route($plural.'.store'); ?>'), 'role'=>'form')) }}

<!-- Form fields here -->

<div class="form-group">
    {{ Form::submit('Create', array('class' => 'btn btn-info')) }}
    {{ link_to_route('<?php echo admin_route($plural.'.index'); ?>', 'Cancel', null, array('class' => 'btn btn-default')) }}
</div>

{{ Form::close() }}

@if ($errors->any())

{{ implode('', $errors->all('<p class="alert alert-danger">:message</p>')) }}

@endif

@stop


