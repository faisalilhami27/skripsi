<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KonfirmasiPembayaranModel extends Model
{
    use SoftDeletes;
    protected $table = "mst_pembayaran";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['kode_pemesanan', 'id_status', 'bukti_pembayaran', 'id_karyawan'];

    public function pemesananTiket()
    {
        return $this->hasOne(PemesananModel::class, 'kode_pemesanan', 'kode_pemesanan');
    }

    public function statusPembayaran()
    {
        return $this->hasOne(StatusPembayaranModel::class, 'id', 'id_status');
    }
}
