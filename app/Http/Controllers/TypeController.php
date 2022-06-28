<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Services\TypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use function PHPSTORM_META\type;

class TypeController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Typeservice;

    public function __construct(TypeService $Typeservice)
    {
        $this->Typeservice = $Typeservice;
    }
    public function index()
    {
        $type = $this->Typeservice->get_all_type();
        return view('admin.type.all_type')->with(compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.type.create_type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->Typeservice->store($request);
        return redirect(route('all-type'))->with('message', 'Add type successfully');
    }


    public function edit($id)
    {
        $type = $this->Typeservice->get_type_byID($id);
        return view('admin.type.edit_type')->with(compact('type'));
    }


    public function update(Request $request, $id)
    {
        $this->Typeservice->update($request, $id);
        return redirect(route('all-type'))->with('message', 'Edit type successfully');
    }


    public function destroy($id)
    {
        $this->Typeservice->delete($id);
        return redirect(route('all-type'))->with('message', 'Delete type successfully');
    }
}
