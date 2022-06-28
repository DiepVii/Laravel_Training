<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipment';
    protected $primaryKey = 'equipment_id';
    protected $fillable = ['name', 'description', 'status', 'image', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'type_id');
    }

    public function borrow()
    {
        return $this->hasMany(Borrow::class);
    }
}
