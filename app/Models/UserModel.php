<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    use SoftDeletes;
    protected $table = "trs_karyawan";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["id_karyawan", "username", "password", "images", "status"];

    public function pemesanan()
    {
        return $this->belongsTo(PemesananModel::class, 'id');
    }

    public function karyawan()
    {
        return $this->hasOne(KaryawanModel::class, 'id', 'id_karyawan');
    }

    public function karyawanRole()
    {
        return $this->hasMany(ChooseRoleModel::class, 'id_karyawan');
    }
}
