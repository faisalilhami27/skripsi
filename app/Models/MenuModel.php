<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuModel extends Model
{
    use SoftDeletes;
    protected $table = "menu";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["title", "icon", "url", "is_main_menu", "is_aktif", "order_num"];
}
