<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemesananModel extends Model
{
    use SoftDeletes;
    protected $table = "pemesanan_tiket";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['kode_pemesanan', 'tgl_pemesanan', 'tgl_masuk', 'id_karyawan', 'jumlah_tiket', 'total_uang_masuk', 'uang_pembayaran', 'status_penggunaan', 'id_jenis', 'id_customer', 'qr_code'];

    public function karyawan()
    {
        return $this->hasOne(UserModel::class, 'id', 'id_karyawan');
    }

    public function jenisPemesanan()
    {
        return $this->belongsTo(JenisPemesananModel::class, 'id_jenis');
    }

    public function pembayaran()
    {
        return $this->belongsTo(KonfirmasiPembayaranModel::class, 'kode_pemesanan', 'kode_pemesanan');
    }

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class, 'id_customer');
    }
}
