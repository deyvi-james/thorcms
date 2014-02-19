<?php

namespace Mjolnic\Thor;

/**
 * @property Page $father
 * @property Page[] $children
 * @property Page $linkedPage
 * @property Page[] $relatedPages
 * @property User $author
 */
class Page extends Model {

    use Behaviour\Translatable, Behaviour\Treeable;

    /**
     * Devuelve las páginas relacionadas a partir de la tabla intermedia page_pages
     * @return Page[]
     */
    public function relatedPages() {
        // page_pages.sorting será pivot_sorting en la sentencia orderBy
        return $this->belongsToMany('Page', 'page_pages', 'page_id', 'child_page_id')->withPivot(array('taxonomy', 'sorting'));
    }

    /**
     * Devuelve el usuario del CMS que creó la página
     * @return User
     */
    public function author() {
        return $this->belongsTo('User', 'user_id', 'id');
    }

}
