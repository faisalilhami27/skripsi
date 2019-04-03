<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KonfigurasiModel extends Model
{
    use SoftDeletes;
    protected $table = "konfigurasi_web";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['kode_konfig', 'nilai_konfig'];
}
