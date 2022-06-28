<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\Equipment;
use App\Models\Type;
use App\Models\User;
use App\Repository\TypeRepository;
use App\Services\BorrowService;
use App\Services\EquipmentService;
use App\Services\TypeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\BinaryOp\Equal;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $BorrowService;
    protected $EquipmentService;
    protected $TypeService;

    public function __construct(BorrowService $BorrowService, EquipmentService $EquipmentService, TypeService $TypeService)
    {
        $this->BorrowService = $BorrowService;
        $this->EquipmentService = $EquipmentService;
        $this->TypeService = $TypeService;
    }
    public function index()
    {
        $equipment = $this->EquipmentService->get_Equipment_Enable();
        $type = $this->TypeService->get_all_type();
        return view('employee.home')->with(compact('type', 'equipment'));
    }

    public function detail($id)
    {
        $type = $this->TypeService->get_all_type();
        $equipment = $this->EquipmentService->get_Equipment_byID($id);
        return view('employee.equipment.detail_equipment')->with(compact('type', 'equipment'));
    }

    public function list_borrow($id)
    {
        $type = $this->TypeService->get_all_type();
        $borrow = $this->BorrowService->get_Borrow_byUser($id);
        return view('employee.equipment.list_borrow_equipment')->with(compact('borrow', 'type'));
    }


    public function borrow($id)
    {
        $this->BorrowService->employee_Borrow($id);
        $this->EquipmentService->update_equipment_Borrow($id);
        return redirect(route('list_borrow_equipment', ['id' => Auth::user()->id]))->with('message', 'Borrow Succesfully');
    }


    public function show($id)
    {
        $equipment = $this->EquipmentService->get_Equipment_byType($id);
        $type = $this->TypeService->get_all_type();
        $type_name = $this->TypeService->get_type_byID($id);

        return view('employee.equipment.show_equipment')->with(compact('type', 'equipment', 'type_name'));
    }

    public function cancel_borrow($id)
    {

        $this->BorrowService->cancel_borrow($id);
        return redirect(route('list_borrow_equipment', ['id' => Auth::user()->id]))->with('message', 'Cancel Succesfully');
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
