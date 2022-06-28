<?php

namespace App\Repository;

use App\Models\Borrow;

class BorrowRepository
{

    protected $Borrow;

    public function __construct(Borrow $Borrow)
    {
        $this->Borrow = $Borrow;
    }
    public function get_all_Borrow()
    {
        return  Borrow::orderby('borrow_id', 'desc')->paginate(5);
    }

    public function get_Borrow_byID($id)
    {
        return Borrow::findorFail($id);
    }

    public function get_Borrow_byUser($id)
    {
        return Borrow::where('user_id', $id)->orderby('borrow_id', 'desc')->paginate(10);
    }

    public function create($attributes)
    {
        return Borrow::create($attributes);
    }

    public function update($attributes, $id)
    {
        return Borrow::findorFail($id)->update($attributes);
    }
    public function delete($id)
    {
        return Borrow::findorFail($id)->delete();
    }
}
