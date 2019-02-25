<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerModel extends Model
{
    use SoftDeletes;
    protected $table = "mst_user_customer";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['nama', 'email', 'password', 'no_hp', 'images'];

    public function pemesanan()
    {
        return $this->hasMany(PemesananModel::class, 'id_customer', 'id');
    }
}
