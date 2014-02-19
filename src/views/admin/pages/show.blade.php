@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>Show Page</h1>

<p>{{ link_to_route('admin.pages.index', 'Return to all pages') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{{ $page->id }}}</td>
            <td>{{ link_to_route('admin.pages.edit', 'Edit', array($page->id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.pages.destroy', $page->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
</table>

@stop
