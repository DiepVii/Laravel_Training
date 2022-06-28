<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery_image extends Model
{
    protected $table = 'gallery_image';
    protected $primaryKey = 'id';
    protected $fillable = ['gallery_image', 'admin_id','gallery_name'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
