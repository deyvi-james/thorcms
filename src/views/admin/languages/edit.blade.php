@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>Edit Language</h1>
{{ Form::model($language, array('method' => 'PATCH', 'route' => array('admin.languages.update', $language->id), 'role'=>'form')) }}

<div class="form-group">
    {{ Form::label('name', 'Name:') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('code', 'Code:') }}
    {{ Form::text('code', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    <div class="checkbox">
        <label>Is active {{ Form::checkbox('is_active') }}</label>
    </div>
</div>

<div class="form-group">
    {{ Form::label('sorting', 'Sorting:') }}
    {{ Form::input('number', 'sorting', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
    {{ link_to_route('admin.languages.show', 'Cancel', $language->id, array('class' => 'btn btn-default')) }}
</div>

{{ Form::close() }}

@if ($errors->any())

{{ implode('', $errors->all('<p class="alert alert-danger">:message</p>')) }}

@endif

@stop
