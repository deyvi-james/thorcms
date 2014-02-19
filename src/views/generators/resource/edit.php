@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>Edit <?php echo ucfirst($singular); ?></h1>

<p>{{ link_to_route('<?php echo admin_route($plural.'.index'); ?>', 'Return to all <?php echo $plural; ?>') }}</p>

{{ Form::model($<?php echo $singular; ?>, array('method' => 'PATCH', 'route' => array('<?php echo admin_route($plural.'.update'); ?>', $<?php echo $singular; ?>->id), 'role'=>'form')) }}

<!-- Form fields here -->

<div class="form-group">
    {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
    {{ link_to_route('<?php echo admin_route($plural.'.index'); ?>', 'Cancel', $<?php echo $singular; ?>->id, array('class' => 'btn btn-default')) }}
</div>

{{ Form::close() }}

@if ($errors->any())

{{ implode('', $errors->all('<p class="alert alert-danger">:message</p>')) }}

@endif

@stop
