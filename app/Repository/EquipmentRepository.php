<?php

namespace App\Repository;

use App\Models\Equipment;
use App\Models\Type;
use Illuminate\Http\Request;

class EquipmentRepository
{

    protected $Equipment;

    public function __construct(Equipment $Equipment)
    {
        $this->Equipment = $Equipment;
    }
    public function get_all_Equipment()
    {
        return Equipment::orderby('equipment_id', 'desc')->paginate(4);
    }

    public function get_Equipment_Enable()
    {
        return Equipment::where('status', 0)->paginate(4);
    }

    public function get_Equipment_byID($id)
    {
        return Equipment::findorFail($id);
    }

    public function get_Equipment_byType($id)
    {
        return Equipment::where([
            ['type_id', '=', $id],
            ['status', '=', 0]
        ])->paginate(4);
    }
    public function create($attributes)
    {
        return Equipment::create($attributes);
    }

    public function update($attributes, $id)
    {
        return Equipment::findorFail($id)->update($attributes);
    }
    public function delete($id)
    {
        return Equipment::findorFail($id)->delete();
    }
    public function equipment_search(Request $request)
    {
        return Equipment::where('name', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%')->get();
    }
}
