<?php

namespace Mjolnic\Thor;

/**
 * @property int $id Primary key value
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
abstract class Model extends \Eloquent {

    protected $guarded = array();
    public static $rules = array();

    public function __get($key) {
        if ($key == 'id') {
            $key = $this->primaryKey;
        }
        return parent::__get($key);
    }
    
    public function __isset($key) {
        if ($key == 'id') {
            $key = $this->primaryKey;
        }
        return parent::__isset($key);
    }

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