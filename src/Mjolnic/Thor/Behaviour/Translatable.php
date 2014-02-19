<?php

namespace Mjolnic\Thor\Behaviour;

trait Translatable {

    public function __get($key) {
        if (isset($this->texts()->$key)) {
            return $this->texts()->$key;
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
        return $this->texts($langId)->$name;
    }

    /**
     * 
     * @param int $langId Si es NULL, se devuelven en el idioma actual
     * @return \Mjolnic\Thor\Model
     */
    public function texts($langId = null) {
        if (!is_int($langId)) {
            $langId = lang_id();
        }
        //dd($this->textsAll());
        return $this->textsAll()->where('language_id', '=', $langId)->first();
    }

    /**
     * 
     * @return \Mjolnic\Thor\Model[]
     */
    public function textsAll() {
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
