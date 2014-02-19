<?php

namespace Mjolnic\Thor\Behaviour;

trait Translatable {

    public function __get($key) {
        if (isset($this->$key)) {
            return parent::__get($key);
        } elseif (isset($this->translation()->$key)) {
            return $this->translation()->$key;
        } else {
            return parent::__get($key);
        }
    }

    /**
     * 
     * @param string $name
     * @param int $langId Si es NULL, se devuelve en el idioma actual
     * @return mixed
     */
    public function text($name, $langId = null) {
        return $this->translation($langId)->$name;
    }

    /**
     * 
     * @param int $langId Si es NULL, se devuelven en el idioma actual
     * @return \Mjolnic\Thor\Model
     */
    public function translation($langId = null) {
        if (!is_int($langId)) {
            $langId = lang_id();
        }
        $transl = $this->translations()->where('language_id', '=', $langId)->first();
        $textClass = (get_class($this) . 'Text');
        return $transl ? $transl : new $textClass; // return existant or a new empty model
    }

    /**
     * 
     * @return \Mjolnic\Thor\Model[]
     */
    public function translations() {
        return $this->hasMany(get_class($this) . 'Text')->orderBy('language_id', 'asc');
    }

    /**
     * Devuelve un array asociado juntando los campos de la tabla principal con la tabla ML
     * @return array
     */
    public function toArrayWithTexts() {
        return array_merge($this->toArray(), $this->texts()->toArray());
    }

}
