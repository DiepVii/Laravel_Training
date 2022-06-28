<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'borrow';
    protected $primaryKey = 'borrow_id';
    protected $fillable = ['user_id', 'equipment_id', 'status', 'borrow_date', 'pay_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id', 'equipment_id');
    }
}
