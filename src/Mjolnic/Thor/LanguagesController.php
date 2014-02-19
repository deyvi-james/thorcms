<?php

namespace Mjolnic\Thor;

use View,
    Input,
    Redirect,
    Validator;

class LanguagesController extends BaseController {

    /**
     * Language Repository
     *
     * @var \Mjolnic\Thor\Language
     */
    protected $language;

    public function __construct(Language $language) {
        $this->language = $language;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $languages = $this->language->all();

        return View::make(Thor::getViewName('languages_index'), compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make(Thor::getViewName('languages_create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $input = Input::all();
        $validation = Validator::make($input, Language::$rules);

        if ($validation->passes()) {
            $this->language->create($input);

            return Redirect::route('admin.languages.index');
        }

        return Redirect::route('admin.languages.create')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Language  $language
     * @return Response
     */
    public function show(Language $language) {

        return View::make(Thor::getViewName('languages_show'), compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Language  $language
     * @return Response
     */
    public function edit(Language $language) {

        if (is_null($language)) {
            return Redirect::route('admin.languages.index');
        }

        return View::make(Thor::getViewName('languages_edit'), compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Language  $language
     * @return Response
     */
    public function update(Language $language) {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, $language->getRulesExcludingThis('code'));

        if ($validation->passes()) {
            $language->update($input);

            return Redirect::route('admin.languages.show', $language->id);
        }
        
        return Redirect::route('admin.languages.edit', $language->id)
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Language  $language
     * @return Response
     */
    public function destroy(Language $language) {
        if(Language::all()->count() < 2){
            return Redirect::route('admin.languages.index')
                            ->withInput()
                            ->with('message', 'You cannot delete the last language.');
        }
        $language->delete();

        return Redirect::route('admin.languages.index');
    }

}
