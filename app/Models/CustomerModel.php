<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerModel extends Authenticatable
{
    use SoftDeletes;
    protected $table = "user_customer";
    protected $guard = 'api_customer';
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['nama', 'email', "username", 'password', 'no_hp', 'images', 'status' , "api_token", 'player_id'];

    protected $hidden = [
        'password' , 'api_token'
    ];


    public function pemesanan()
    {
        return $this->hasOne(PemesananModel::class, 'id_customer', 'id');
    }
}
