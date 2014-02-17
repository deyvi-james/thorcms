<?php

namespace Mjolnic\Thor;

abstract class Model extends \Eloquent {

    protected $guarded = array();
    public static $rules = array();

    public function getRulesExcludingThis($rule, $column = null) {
        $rules = static::$rules;
        if (empty($column)) {
            $column = $rule;
        }
        if (isset($rules[$rule]) and isset($this->attributes[$this->primaryKey])) {
            $rules[$rule].=',' . $column . ',' . $this->attributes[$this->primaryKey];
        }
        return $rules;
    }

}
