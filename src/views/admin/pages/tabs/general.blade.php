<div class="tab-pane active" id="t1">
    <pre>{{$page}}</pre>
    <?php
    // For current language
    $tr = isset($page) ? $page->translation() : new \Mjolnic\Thor\PageText();
    ?>
    <pre>{{$tr}}</pre>
    {{ Form::hidden('translation[id]', $tr->id) }}
    <div class="form-group">
        {{ Form::label(null, 'Title') }}
        {{ Form::text('translation[title]', $tr->title, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'Subtitle') }}
        {{ Form::text('translation[subtitle]', $tr->subtitle, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'Slug') }}
        {{ Form::text('translation[slug]', $tr->slug, array('class' => 'form-control')) }}
    </div>
    <div class="form-group"><?php //Form::select($name, $list, $selected, $options); ?>
        {{ Form::label(null, 'Publish status:') }}
        {{ Form::select('status', array('draft' => 'Draft', 'published' => 'Published'), $page->getAttribute('status'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'Translation status ('.Language::current()->name.'):') }}
        {{ Form::select('translation[status]', array('draft' => 'Draft', 'published' => 'Published'), $tr->getAttribute('status'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'Excerpt') }}
        {{ Form::textarea('translation[excerpt]', $tr->excerpt, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'Content') }}
        {{ Form::textarea('translation[content]', $tr->content, array('class' => 'form-control form-control-editor')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'SEO meta title') }}
        {{ Form::text('translation[meta_title]', $tr->meta_title, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'SEO meta description') }}
        {{ Form::textarea('translation[meta_description]', $tr->meta_description, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label(null, 'SEO meta keywords') }}
        {{ Form::textarea('translation[meta_keywords]', $tr->meta_keywords, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('sorting', 'Sorting order:') }}
        {{ Form::input('number', 'sorting', null, array('class' => 'form-control')) }}
    </div>
</div>