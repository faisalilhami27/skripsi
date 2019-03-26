<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = "mst_user_karyawan";
    protected $guard = 'api_karyawan';
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["id_karyawan", "username", "password", "images", "status", "api_token"];

    protected $hidden = [
        'password' , 'api_token'
    ];

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
