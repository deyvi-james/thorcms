<div class="tab-pane" id="t2">
    <div class="form-group">
        <div class="checkbox">
            <label>Can be edited {{ Form::checkbox('is_editable') }}</label>
        </div>
        <div class="checkbox">
            <label>Can be deleted {{ Form::checkbox('is_deletable') }}</label>
        </div>
        <div class="checkbox">
            <label>This is an only HTTPS page {{ Form::checkbox('is_httpsonly') }}</label>
        </div>
        <div class="checkbox">
            <label>This page can be indexed {{ Form::checkbox('is_indexable') }}</label>
        </div>
        <div class="checkbox">
            <label>This page links can be followed {{ Form::checkbox('is_followable') }}</label>
        </div>
        <div class="checkbox">
            <label>Include this page in sitemap.xml {{ Form::checkbox('is_mapable') }}</label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label(null, 'Taxonomy') }}
        {{ Form::text('taxonomy', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'Controller') }}
        {{ Form::text('controller', null, array('class' => 'form-control', 'placeholder'=>'Class name')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'Action') }}
        {{ Form::text('action', null, array('class' => 'form-control', 'placeholder'=>'Method name')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'View') }}
        {{ Form::text('view', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'Admin view') }}
        {{ Form::text('admin_view', null, array('class' => 'form-control')) }}
    </div>
</div>