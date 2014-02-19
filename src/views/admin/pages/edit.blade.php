@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>Edit Page</h1>
{{ Form::model($page, array('method' => 'PATCH', 'route' => array('admin.pages.update', $page->id), 'role'=>'form')) }}

<!-- Form fields here -->

<div class="form-group">
    {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
    {{ link_to_route('admin.pages.index', 'Cancel', $page->id, array('class' => 'btn btn-default')) }}
</div>

{{ Form::close() }}

@if ($errors->any())

{{ implode('', $errors->all('<p class="alert alert-danger">:message</p>')) }}

@endif

@stop
