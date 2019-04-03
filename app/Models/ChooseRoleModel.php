<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class   ChooseRoleModel extends Model
{
    protected $table = "role_user_karyawan";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['id_user_level', 'id_karyawan'];

    public function roleMany()
{
    return $this->hasMany(UserLevelModel::class, 'id', 'id_user_level');
}

    public function role()
    {
        return $this->hasOne(UserLevelModel::class, 'id', 'id_user_level');
    }

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'id_karyawan');
    }
}
