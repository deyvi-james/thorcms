@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>All Pages</h1>

<p>{{ link_to_route('admin.pages.create', 'Add new page') }}</p>

@if ($pages->count())
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($pages as $page)
        <tr>
            <td>{{{ $page->id }}}</td>
            <td>{{{ $page->text('title') }}}</td>
            <td>{{{ $page->text('slug') }}}</td>
            <td>{{ link_to_route('admin.pages.edit', 'Edit', array($page->id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.pages.destroy', $page->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
There are no pages@endif

@stop
