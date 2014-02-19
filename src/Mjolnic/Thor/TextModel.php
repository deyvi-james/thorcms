<?php

namespace Mjolnic\Thor;

class TextModel extends Model {
    
    public function language() {
        return $this->belongsTo('Language');
    }

}