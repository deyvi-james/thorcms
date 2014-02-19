<?php echo '<?php'; $model = ucfirst($singular); ?>

namespace {{trim($namespace, '\\')}};

use View,
    Input,
    Redirect,
    Validator;
/*
|--------------------------------------------------------------------------
| {{ucfirst($plural)}} controller
|--------------------------------------------------------------------------
|
| This is a default ThorCMS controller template for resource management.
| Feel free to change to your needs.
|
*/
class {{ucfirst($plural)}}Controller extends \Mjolnic\Thor\BaseController {

    /**
     * Repository
     *
     * @var {{$model}}
     */
    protected ${{$singular}};

    public function __construct({{$model}} ${{$singular}}) {
        $this->{{$singular}} = ${{$singular}};
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        ${{$plural}} = $this->{{$singular}}->all();

        return View::make(\Mjolnic\Thor\Thor::getViewName('{{$plural}}_index'), compact('{{$plural}}'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make(\Mjolnic\Thor\Thor::getViewName('{{$plural}}_create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $input = Input::all();
        $validation = Validator::make($input, {{$model}}::$rules);

        if ($validation->passes()) {
            $this->{{$singular}}->create($input);

            return Redirect::route('{{Config::get('thor::admin_route_prefix')}}.{{$plural}}.index');
        }

        return Redirect::route('{{Config::get('thor::admin_route_prefix')}}.{{$plural}}.create')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  {{$model}}  ${{$singular}}
     * @return Response
     */
    public function show({{$model}} ${{$singular}}) {

        return View::make(\Mjolnic\Thor\Thor::getViewName('{{$plural}}_show'), compact('{{$singular}}'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  {{$model}}  ${{$singular}}
     * @return Response
     */
    public function edit({{$model}} ${{$singular}}) {

        if (is_null(${{$singular}})) {
            return Redirect::route('{{Config::get('thor::admin_route_prefix')}}.{{$plural}}.index');
        }

        return View::make(\Mjolnic\Thor\Thor::getViewName('{{$plural}}_edit'), compact('{{$singular}}'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  {{$model}}  ${{$singular}}
     * @return Response
     */
    public function update({{$model}} ${{$singular}}) {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, ${{$singular}}->getRulesExcludingThis('code'));

        if ($validation->passes()) {
            ${{$singular}}->update($input);

            return Redirect::route('{{Config::get('thor::admin_route_prefix')}}.{{$plural}}.show', ${{$singular}}->id);
        }
        
        return Redirect::route('{{Config::get('thor::admin_route_prefix')}}.{{$plural}}.edit', ${{$singular}}->id)
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  {{$model}}  ${{$singular}}
     * @return Response
     */
    public function destroy({{$model}} ${{$singular}}) {
        ${{$singular}}->delete();

        return Redirect::route('{{Config::get('thor::admin_route_prefix')}}.{{$plural}}.index');
    }

}
