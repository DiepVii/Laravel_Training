<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Type;
use App\Services\EquipmentService;
use App\Services\TypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EquipmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Equipmentservice;
    protected $Typeservice;


    public function __construct(EquipmentService $Equipmentservice, TypeService $Typeservice)
    {
        $this->Equipmentservice = $Equipmentservice;
        $this->Typeservice = $Typeservice;
    }


    public function index()
    {
        $equipment = $this->Equipmentservice->get_all_Equipment();
        return view('admin.equipment.all_equipment')->with(compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = $this->Typeservice->get_all_type();
        return view('admin.equipment.create_equipment')->with(compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->Equipmentservice->store($request);
        return redirect(route('all-equipment'))->with('message', 'Add equipment successfully');
    }


    public function edit($id)
    {
        $type = $this->Typeservice->get_all_type();
        $equipment = $this->Equipmentservice->get_Equipment_byID($id);
        return view('admin.equipment.edit_equipment')->with(compact('equipment', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->Equipmentservice->update($request, $id);
        return redirect(route('all-equipment'))->with('message', 'Edit equipment successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipment = Equipment::findorFail($id);
        unlink(public_path($equipment->image));
        $equipment->delete();
        return redirect(route('all-equipment'))->with('message', 'Delete equipment successfully');
    }



    public function equipment_search(Request $request)
    {
        $output =  $this->Equipmentservice->equipment_search($request);
        return Response($output);
    }
}
