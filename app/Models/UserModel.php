<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    use SoftDeletes;
    protected $table = "mst_user_karyawan";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["nama", "email", "password", "images", "id_user_level", "status"];

    public function userLevel()
    {
        return $this->hasOne(UserLevelModel::class, 'id');
    }

    public function pemesanan()
    {
        return $this->belongsTo(PemesananModel::class, 'id');
    }
}
