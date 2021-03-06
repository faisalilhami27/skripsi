<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KaryawanModel extends Model
{
  use SoftDeletes;
  protected $table = "karyawan";
  protected $primaryKey = "id";
  protected $dates = ['deleted_at', 'updated_at', 'created_at'];
  protected $fillable = ['nama', 'email', 'no_hp', 'status'];

  public function kehadiran()
  {
    return $this->hasMany(KehadiranModel::class, 'id_karyawan', 'id');
  }
}
