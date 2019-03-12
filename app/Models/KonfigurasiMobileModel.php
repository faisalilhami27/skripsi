<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KonfigurasiMobileModel extends Model
{
    use SoftDeletes;
    protected $table = "mst_konfigurasi_mobile";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['title', 'images', 'deskripsi'];
}
