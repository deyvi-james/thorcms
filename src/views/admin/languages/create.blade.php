@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>Create Language</h1>
{{ Form::open(array('method' => 'POST', 'route' => array('admin.languages.store'), 'role'=>'form')) }}

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
        {{ link_to_route('admin.languages.index', 'Cancel', null, array('class' => 'btn btn-default')) }}
    </div>

{{ Form::close() }}

@if ($errors->any())

{{ implode('', $errors->all('<p class="alert alert-danger">:message</p>')) }}

@endif

@stop


