<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Equipment;
use App\Models\Type;
use App\Models\User;
use App\Services\BorrowService;
use App\Services\EquipmentService;
use App\Services\UserService;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    protected $BorrowService;
    protected $EquipmentService;
    protected $UserService;

    public function __construct(BorrowService $BorrowService, EquipmentService $EquipmentService, UserService $UserService)
    {
        $this->BorrowService = $BorrowService;
        $this->EquipmentService = $EquipmentService;
        $this->UserService = $UserService;
    }
    public function all_borrow()
    {
        $employee = $this->UserService->get_employee();
        $borrow = $this->BorrowService->get_all_Borrow();
        return view('admin.borrow.all_borrow_equipment')->with(compact('borrow', 'employee'));
    }

    public function borrow_by_user(Request $request)
    {
        if ($request->filter_user == 'all') {
            return redirect(route('all-borrow'));
        }

        $employee = $this->UserService->get_employee();
        $borrow = $this->BorrowService->get_Borrow_byUser($request->filter_user);
        return view('admin.borrow.all_borrow_equipment')->with(compact('borrow', 'employee'));
    }

    public function accept_borrow($id)
    {
        $this->BorrowService->accept_borrow($id);
        return redirect(route('all-borrow'))->with('message', 'Accept Succesfully');
    }

    public function reject_borrow($id)
    {
        $this->BorrowService->reject_borrow($id);
        return redirect(route('all-borrow'))->with('message', 'Reject Succesfully');
    }

    public function give_back_equipment($id)
    {
        $this->BorrowService->give_back_equipment($id);
        return redirect(route('all-borrow'))->with('message', 'Confirm Succesfully');
    }
}
