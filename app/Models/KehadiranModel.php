<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KehadiranModel extends Model
{
  use SoftDeletes;
  protected $table = "kehadiran_karyawan";
  protected $primaryKey = "id";
  protected $dates = ['deleted_at', 'updated_at', 'created_at'];
  protected $fillable = ['id_karyawan', 'tanggal', 'waktu', 'status'];

  public function karyawan()
  {
    return $this->belongsTo(KaryawanModel::class, 'id_karyawan', 'id');
  }
}
