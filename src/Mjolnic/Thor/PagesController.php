<?php
namespace Mjolnic\Thor;

use View,
    Input,
    Redirect,
    Validator;
/*
|--------------------------------------------------------------------------
| Pages controller
|--------------------------------------------------------------------------
|
| This is a default ThorCMS controller template for resource management.
| Feel free to change to your needs.
|
*/
class PagesController extends \Mjolnic\Thor\BaseController {

    /**
     * Repository
     *
     * @var Page     */
    protected $page;

    public function __construct(Page $page) {
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $pages = $this->page->all();

        return View::make(\Mjolnic\Thor\Thor::getViewName('pages_index'), compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make(\Mjolnic\Thor\Thor::getViewName('pages_create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $input = array_except(Input::all(), array('_method', 'translation'));
        $transl_input = array_except(Input::get('translation'), 'id');
        $validation = Validator::make($input, Page::$rules);
        $transl_validation = Validator::make($transl_input, PageText::$rules);

        if ($validation->passes()) {
            $this->page = $this->page->create($input);
            if ($transl_validation->passes()) {
                PageText::create(array_merge(array('language_id'=>  lang_id(), 'page_id'=>$this->page->id), $transl_input));
                return Redirect::route('admin.pages.index');
            }
        }

        return Redirect::route('admin.pages.create')
                        ->withInput()
                        ->withErrors($validation)
                        ->withErrors($transl_validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Page  $page     * @return Response
     */
    public function show(Page $page) {

        return View::make(\Mjolnic\Thor\Thor::getViewName('pages_show'), compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Page  $page     * @return Response
     */
    public function edit(Page $page) {

        if (is_null($page)) {
            return Redirect::route('admin.pages.index');
        }

        return View::make(\Mjolnic\Thor\Thor::getViewName('pages_edit'), compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Page  $page     * @return Response
     */
    public function update(Page $page) {
        $input = array_except(Input::all(), array('_method', 'translation'));
        $transl_input = array_except(Input::get('translation'), 'id');
        $validation = Validator::make($input, Page::$rules);
        $transl_validation = Validator::make($transl_input, PageText::$rules);

        if ($validation->passes()) {
            $page->update($input);
            if ($transl_validation->passes()) {
                // Save translation
                if(Input::get('translation.id')){
                    $transl = PageText::find(Input::get('translation.id'));
                    $transl->update($transl_input);
                }else{
                    PageText::create(array_merge(array('language_id'=>  lang_id(), 'page_id'=>$page->id), $transl_input));
                }
                return Redirect::route('admin.pages.edit', $page->id);
            }
        }
        
        return Redirect::route('admin.pages.edit', $page->id)
                        ->withInput()
                        ->withErrors($validation)
                        ->withErrors($transl_validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page  $page     * @return Response
     */
    public function destroy(Page $page) {
        $page->delete();

        return Redirect::route('admin.pages.index');
    }

}
