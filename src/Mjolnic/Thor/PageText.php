<?php

namespace Mjolnic\Thor;

class PageText extends Model {

    public function page() {
        // foreach (PageText::with('page')->get() as $page) // usar eager loading!
        return $this->belongsTo('Page');
    }

}