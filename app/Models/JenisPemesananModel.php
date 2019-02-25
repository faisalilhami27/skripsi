<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPemesananModel extends Model
{
    protected $table = "mst_jenis_pemesanan";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["nama_jenis"];

    public function pemesanan()
    {
        return $this->hasOne(PemesananModel::class, 'id_jenis');
    }
}
