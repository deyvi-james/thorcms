<?php

namespace Mjolnic\Thor;

class PageText extends TextModel {

    public function page() {
        // foreach (PageText::with('page')->get() as $page) // usar eager loading!
        return $this->belongsTo('Page');
    }

}