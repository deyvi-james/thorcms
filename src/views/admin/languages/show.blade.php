@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>Show Language</h1>

<p>{{ link_to_route('admin.languages.index', 'Return to all languages') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Code</th>
				<th>Is_active</th>
				<th>Sorting</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $language->name }}}</td>
					<td>{{{ $language->code }}}</td>
					<td>{{{ $language->is_active }}}</td>
					<td>{{{ $language->sorting }}}</td>
                    <td>{{ link_to_route('admin.languages.edit', 'Edit', array($language->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.languages.destroy', $language->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
