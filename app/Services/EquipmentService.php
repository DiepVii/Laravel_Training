<?php

namespace App\Services;

use App\Repository\EquipmentRepository;
use App\Repository\TypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

class EquipmentService
{
    protected $EquipmentRepository;
    protected $TypeRepository;
    public function __construct(EquipmentRepository $EquipmentRepository, TypeRepository $TypeRepository)
    {
        $this->EquipmentRepository = $EquipmentRepository;
        $this->TypeRepository = $TypeRepository;
    }

    public function random()
    {
        $rand = '';
        for ($x = 0; $x < 5; $x++) {
            $rand .= rand(0, 9999);
        }
        return $rand;
    }
    public function get_all_Equipment()
    {
        $Equipment = $this->EquipmentRepository->get_all_Equipment();
        return $Equipment;
    }
    public function get_Equipment_byID($id)
    {
        $Equipment = $this->EquipmentRepository->get_Equipment_byID($id);
        return $Equipment;
    }
    public function get_Equipment_byType($id)
    {
        $Equipment = $this->EquipmentRepository->get_Equipment_byType($id);
        return $Equipment;
    }
    public function get_Equipment_Enable()
    {
        return $Equipment = $this->EquipmentRepository->get_Equipment_Enable();
    }

    public function store(Request $request)
    {
        $messages = [
            'equipment_name.unique' => 'Equipment name already exists, please enter another name',
            'equipment_name.regex' => 'You cannot enter special characters'
        ];
        $validate = $request->validate([
            'equipment_name' => 'required|unique:equipment,name|min:2|max:50|regex:/^[0-9a-zA-Z\-\s]+$/',
            'equipment_desc' => 'required',
            'equipment_image' => 'required|mimes:webp,jpeg,jpg,png,gif|max:10000'
        ], $messages);

        $data = $request->all();
        $type = $this->TypeRepository->get_type_byID($request->type_id);
        $type_name = $type->type_name;

        $file = $request->file('equipment_image');
        $file_name = $this->random() . $file->getClientOriginalName();
        $request->equipment_image->move(public_path('/backend/images/' . $type_name . '/'), $file_name);
        $file_path = ('/backend/images/' . $type_name . '/') . $file_name;

        $attribute = [
            'name' => $request->equipment_name,
            'status' => 0,
            'description' => $request->equipment_desc,
            'image' => $file_path,
            'type_id' => $request->type_id
        ];

        $Equipment = $this->EquipmentRepository->create($attribute);
        return $Equipment;
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'equipment_name.unique' => 'Equipment name already exists, please enter another name',
            'equipment_name.regex' => 'You cannot enter special characters'
        ];
        $validate = $request->validate([
            'equipment_name' => 'required|min:2|max:50|regex:/^[0-9a-zA-Z\-\s]+$/',
            'equipment_desc' => 'required',
            'equipment_image' => 'mimes:webp,jpeg,jpg,png,gif|max:10000'
        ], $messages);

        $data = $request->all();
        $equipment = $this->EquipmentRepository->get_Equipment_byID($id);
        $type = $this->TypeRepository->get_type_byID($request->type_id);
        $type_name = $type->type_name;

        if (isset($data['equipment_image'])) {

            $file = $request->file('equipment_image');
            $file_name = $this->random() . $file->getClientOriginalName();
            $request->equipment_image->move(public_path('/backend/images/' . $type_name . '/'), $file_name);
            $file_path = ('/backend/images/' . $type_name . '/') . $file_name;
            unlink(public_path($equipment->image));

            $attribute = [
                'name' => $request->equipment_name,
                // 'status' => 0,
                'description' => $request->equipment_desc,
                'image' => $file_path,
                'type_id' => $request->type_id
            ];
        } else {
            if ($equipment->type_id != $type->type_id) {

                $dir = $equipment->image;
                $file_name = Str::afterLast($dir, '/');
                $new_dir = public_path('/backend/images/' . $type_name . '/' . $file_name);
                $file_path = '/backend/images/' . $type_name . '/' . $file_name;
                rename(public_path($dir), $new_dir);

                $attribute = [
                    'name' => $request->equipment_name,
                    'image' => $file_path,
                    'description' => $request->equipment_desc,
                    'type_id' => $request->type_id
                ];
            } else {
                $attribute = [
                    'name' => $request->equipment_name,
                    // 'status' => 0,
                    'description' => $request->equipment_desc,
                    'type_id' => $request->type_id
                ];
            }
        }
        $Equipment = $this->EquipmentRepository->update($attribute, $id);
        return $Equipment;
    }

    public function delete($id)
    {
        $equipment = $this->EquipmentRepository->get_Equipment_byID($id);
        unlink(public_path($equipment->image));
        $Equipment = $this->EquipmentRepository->delete($id);
        return $Equipment;
    }

    public function equipment_search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $equipment = $this->EquipmentRepository->equipment_search($request);
            $i = 0;
            if (count($equipment) > 0) {
                foreach ($equipment as $equipment_value) {
                    $i++;
                    $output .= ' <tr>
                    <td scope="row">' . $i . '</td>
                    <td>' . $equipment_value->name . '</td>

                    <td width="400" class="description">' . $equipment_value->description . '</td>
                    <td><img width="150" src="' . asset($equipment_value->image) . '" alt=""></td>


                    <td>';
                    if ($equipment_value->status == 0)
                        $output .= ' <span class="btn btn-success">Enable</span>';
                    elseif ($equipment_value->status == 1)
                        $output .= ' <span class="btn btn-secondary">Disable</span>';
                    elseif ($equipment_value->status == 2)
                        $output .= ' <span class="btn btn-warning">Wait</span>';
                    else
                        $output .= ' <span class="btn btn-danger">Damaged</span>';

                    $output .= '
                    </td>
                    <td>' . $equipment_value->type->type_name . '</td>
                    <td>
                    <a style="font-size: 30px;"
                        href="' . route('edit-equipment', ['id' => $equipment_value->equipment_id]) . '"><i
                            class="fas fa-edit"></i></a>
                    <a onclick="return confirm(\'Are you sure to delete this equipment\');"
                        style="color:red; font-size: 30px;"
                        href="' . route('delete-equipment', ['id' => $equipment_value->equipment_id]) . '"><i
                            class="fas fa-trash"></i></a>
                </td>

                </tr>';
                }
            } else {
                $output .= '<tr class="text-center">
                    <td colspan="7" class="text-danger">No data</td>
                    
                </tr>';
            }
            return ($output);
        }
    }

    public function update_equipment_Borrow($id)
    {
        $attribute = ['status' => 2];
        $equipment = $this->EquipmentRepository->update($attribute, $id);
        return $equipment;
    }
}
