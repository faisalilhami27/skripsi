<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLevelModel extends Model
{
    use SoftDeletes;
    protected $table = "user_level";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["nama_level"];

    public function role()
    {
        return $this->hasMany(ChooseRoleModel::class, 'id_karyawan', 'id');
    }

}
