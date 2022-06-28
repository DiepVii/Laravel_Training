<?php

namespace App\Repository;

use App\Models\Type;

class TypeRepository
{

    protected $Type;

    public function __construct(Type $Type)
    {
        $this->Type = $Type;
    }
    public function get_all_type()
    {
        return Type::all();
    }

    public function get_type_byID($id)
    {
        return Type::findorFail($id);
    }

    public function create($attributes)
    {
        return Type::create($attributes);
    }

    public function update($attributes, $id)
    {
        return Type::findorFail($id)->update($attributes);
    }
    public function delete($id)
    {
        return Type::findorFail($id)->delete();
    }
}
