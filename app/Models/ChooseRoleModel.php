<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChooseRoleModel extends Model
{
    use SoftDeletes;
    protected $table = "trs_user_karyawan";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['id_user_level', 'id_karyawan'];

    public function role()
    {
        return $this->hasMany(UserLevelModel::class, 'id', 'id_user_level');
    }
}
