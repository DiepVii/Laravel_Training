<?php

namespace App\Services;

use App\Repository\TypeRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TypeService
{
    protected $TypeRepository;
    public function __construct(TypeRepository $TypeRepository)
    {
        $this->TypeRepository = $TypeRepository;
    }

    public function get_all_type()
    {
        $type = $this->TypeRepository->get_all_type();
        return $type;
    }
    public function get_type_byID($id)
    {
        $type = $this->TypeRepository->get_type_byID($id);
        return $type;
    }

    public function store(Request $request)
    {
        $messages = [
            'type_name.unique' => 'Type name already exists, please enter another name',
            'type_name.regex' => 'You cannot enter numbers or special characters'
        ];
        $validate = $request->validate([
            'type_name' => 'required|unique:type|min:2|max:50|regex:/^[a-zA-Z\-\s]+$/',
            'type_desc' => 'required',
        ], $messages);

        $attribute = [
            'type_name' => $request->type_name,
            'description' => $request->type_desc
        ];
        $type = $this->TypeRepository->create($attribute);
        return $type;
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'type_name.unique' => 'Type name already exists, please enter another name',
            'type_name.regex' => 'You cannot enter numbers or special characters'
        ];
        $validate = $request->validate([
            'type_name' => 'required|min:2|max:50|regex:/^[a-zA-Z\-\s]+$/',
            'type_desc' => 'required',
        ], $messages);

        $attribute = [
            'type_name' => $request->type_name,
            'description' => $request->type_desc
        ];
        $type = $this->TypeRepository->update($attribute, $id);
        return $type;
    }

    public function delete($id)
    {
        $type = $this->TypeRepository->delete($id);
        return $type;
    }
}
