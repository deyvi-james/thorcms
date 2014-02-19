<?php

namespace Mjolnic\Thor\Behaviour;

trait Treeable {

    /**
     * Devuelve el registro padre especificado mediante la columna parent_id
     * @return Model_Base
     */
    public function father() {
        return $this->belongsTo(get_class($this), 'parent_id', $this->primaryKey);
    }

    /**
     * Devuelve los registros que tienen como parent_id este mismo
     * @return Model_Base[]
     */
    public function children() {
        return $this->hasMany(get_class($this), 'parent_id', $this->primaryKey);
    }

    public function hasFather() {
        return ($this->parent_id > 0);
    }

    public function hasChildren() {
        return $this->has('children');
    }

}
