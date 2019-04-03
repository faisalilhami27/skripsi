<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleLevelModel extends Model
{
    protected $table = "role_level";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["id_user_level", "id_menu", "create", "read", "update", "delete"];
}
