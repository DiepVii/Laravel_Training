<?php

namespace App\Services;

use App\Repository\BorrowRepository;
use App\Repository\EquipmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BorrowService
{
    protected $BorrowRepository;
    protected $EquipmentRepository;

    public function __construct(BorrowRepository $BorrowRepository, EquipmentRepository $EquipmentRepository)
    {
        $this->BorrowRepository = $BorrowRepository;
        $this->EquipmentRepository = $EquipmentRepository;
    }

    public function get_all_Borrow()
    {
        $Borrow = $this->BorrowRepository->get_all_Borrow();
        return $Borrow;
    }
    public function get_Borrow_byID($id)
    {
        $Borrow = $this->BorrowRepository->get_Borrow_byID($id);
        return $Borrow;
    }
    public function get_Borrow_byUser($id)
    {
        $Borrow = $this->BorrowRepository->get_Borrow_byUser($id);
        return $Borrow;
    }
    public function employee_Borrow($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $borrow_date = now();
        $attribute = [
            'user_id' => Auth::user()->id,
            'equipment_id' => $id,
            'borrow_date' => $borrow_date,
            'status' => 0
        ];
        $borrow = $this->BorrowRepository->create($attribute);
        return $borrow;
    }

    public function cancel_borrow($id)
    {
        $borrow = $this->BorrowRepository->get_Borrow_byID($id);
        $equipment_id = $borrow->equipment_id;
        $attribute = ['status' => 0];
        $equipment = $this->EquipmentRepository->update($attribute, $equipment_id);
        $borrow = $this->BorrowRepository->delete($id);
        if ($borrow && $equipment) {
            return true;
        }
    }
    public function accept_borrow($id)
    {
        $borrow = $this->BorrowRepository->get_Borrow_byID($id);
        $attribute = [
            'status' => 1
        ];
        $equipment_id = $borrow->equipment_id;
        $borrow = $this->BorrowRepository->update($attribute, $id);
        $equipment = $this->EquipmentRepository->update($attribute, $equipment_id);
        if ($borrow && $equipment) {
            return true;
        }
    }

    public function reject_borrow($id)
    {
        $borrow = $this->BorrowRepository->get_Borrow_byID($id);
        $attribute = [
            'status' => 2
        ];
        $equipment_id = $borrow->equipment_id;
        $borrow = $this->BorrowRepository->update($attribute, $id);
        $attribute = [
            'status' => 0
        ];
        $equipment = $this->EquipmentRepository->update($attribute, $equipment_id);
        if ($borrow && $equipment) {
            return true;
        }
    }

    public function give_back_equipment($id)
    {
        $borrow = $this->BorrowRepository->get_Borrow_byID($id);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $pay_date = now();
        $attribute = [
            'status' => 3,
            'pay_date' => $pay_date
        ];

        $equipment_id = $borrow->equipment_id;

        $borrow = $this->BorrowRepository->update($attribute, $id);
        $attribute = [
            'status' => 0
        ];
        $equipment = $this->EquipmentRepository->update($attribute, $equipment_id);
        if ($borrow && $equipment) {
            return true;
        }
    }
}
