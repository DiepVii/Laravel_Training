<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table = 'type';
    protected $primaryKey = 'type_id';
    protected $fillable = ['type_name', 'description'];

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
