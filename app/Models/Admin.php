<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'phone','image'];

    public function gallery_images()
    {
        return $this->hasMany(Gallery_image::class);
    }
}
