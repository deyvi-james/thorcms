@extends(Config::get('thor::views.master_layout'))

@section('main')

<h1>Edit Page</h1>

<p>{{ link_to_route('admin.pages.index', 'Return to all pages') }}</p>

{{ Form::model($page, array('method' => 'PATCH', 'route' => array('admin.pages.update', $page->id), 'role'=>'form')) }}

@include('thor::admin.pages.tabs.nav')

<!-- Tab panes -->
<div class="tab-content">
@include('thor::admin.pages.tabs.general')
@include('thor::admin.pages.tabs.advanced')
</div>

<div class="form-group">
    {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
    {{ link_to_route('admin.pages.index', 'Cancel', $page->id, array('class' => 'btn btn-default')) }}
</div>

{{ Form::close() }}

@if ($errors->any())

{{ implode('', $errors->all('<p class="alert alert-danger">:message</p>')) }}

@endif

@stop
