@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>Show <?php echo ucfirst($singular); ?></h1>

<p>{{ link_to_route('<?php echo admin_route($plural.'.index'); ?>', 'Return to all <?php echo $plural; ?>') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{{ $<?php echo $singular; ?>->id }}}</td>
            <td>{{ link_to_route('<?php echo admin_route($plural.'.edit'); ?>', 'Edit', array($<?php echo $singular; ?>->id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('<?php echo admin_route($plural.'.destroy'); ?>', $<?php echo $singular; ?>->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
</table>

@stop
