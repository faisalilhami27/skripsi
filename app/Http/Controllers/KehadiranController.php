<?php

namespace App\Http\Controllers;

use App\Models\KaryawanModel;
use App\Models\KehadiranModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class KehadiranController extends Controller
{
  public function index()
  {
    $title = 'Halaman Generate Kehadiran';
    $deskripsi = 'Halaman generate kehadiran berfungsi untuk mengenerate kehadiran semua karyawan';
    return view('kehadiran.index', compact('title', 'deskripsi'));
  }

  public function datatable()
  {
    $karyawan = KehadiranModel::with('karyawan')
      ->whereDate('tanggal', date('Y-m-d'))
      ->where('id_karyawan', '!=', 1)
      ->get();
    return DataTables::of($karyawan)->addIndexColumn()->make(true);
  }

  public function store()
  {
    $karyawan = KaryawanModel::where('status', 1)
      ->where('id', '!=', 1)
      ->get();
    $checkKehadiranKaryawan = KehadiranModel::where('tanggal', Carbon::now()->format('Y-m-d'))->count();

    if ($checkKehadiranKaryawan != 0) {
      return response()->json(['status' => 500, 'msg' => 'Maaf, data kehadiran hari ini sudah digenerate']);
    }

    foreach ($karyawan as $k) {
      $data = [
        'id_karyawan' => $k->id,
        'tanggal' => Carbon::now()->format('Y-m-d'),
        'waktu' => date('H:i:s'),
        'status' => 0,
        'created_by' => Session::get('id_users')
      ];

      $insert = KehadiranModel::create($data);
    }

    if ($insert) {
      return response()->json(['status' => 200, 'msg' => 'Data berhasil digenerate']);
    } else {
      return response()->json(['status' => 500, 'msg' => 'Data gagal digenerate']);
    }
  }

  public function changeStatusKehadiran(Request $request)
  {
    $status = $request->status;
    $id = $request->id;

    $data = [
      'status' => $status,
    ];

    $update = KehadiranModel::where('id', $id)->update($data);

    if ($update) {
      return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
    } else {
      return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
    }
  }

  public function riwayatKehadiran()
  {
    $title = 'Halaman Riwayat Kehadiran';
    $deskripsi = 'Halaman riwayat kehadiran berfungsi untuk melihat riwayat kehadiran semua karyawan';
    return view('kehadiran.riwayat', compact('title', 'deskripsi'));
  }

  public function datatable1()
  {
    $karyawan = KaryawanModel::where('id', '!=', 1)->get();
    return DataTables::of($karyawan)->addIndexColumn()->make(true);
  }

  public function getKaryawan(Request $request)
  {
    $id = $request->id;
    $month = date('m');
    $karyawan = KaryawanModel::where('id', $id)->first();

    $totalHadir = KehadiranModel::where('id_karyawan', $id)
      ->where('status', 2)
      ->whereMonth('tanggal', $month)
      ->count();

    $totalIzin = KehadiranModel::where('id_karyawan', $id)
      ->where('status', 3)
      ->whereMonth('tanggal', $month)
      ->count();

    $totalSakit = KehadiranModel::where('id_karyawan', $id)
      ->where('status', 4)
      ->whereMonth('tanggal', $month)
      ->count();

    $totalAlfa = KehadiranModel::where('id_karyawan', $id)
      ->where('status', 1)
      ->whereMonth('tanggal', $month)
      ->count();

    $data = [
      'id' => $karyawan->id,
      'nama' => $karyawan->nama,
      'hadir' => $totalHadir,
      'izin' => $totalIzin,
      'sakit' => $totalSakit,
      'alfa' => $totalAlfa,
    ];

    if ($karyawan) {
      return response()->json(['status' => 200, 'list' => $data]);
    } else {
      return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
    }
  }

  public function getTanggalKehadiranKaryawan($id)
  {
    $karyawan = KehadiranModel::where('id_karyawan', $id)->get();
    return DataTables::of($karyawan)
      ->addIndexColumn()
      ->addColumn('tanggal', function ($query) {
        return $query->tanggal . " - " . $query->waktu;
      })
      ->addColumn('status', function ($query) {
        if ($query->status == 0) {
          return '<span class="label label-primary">Pending</span>';
        } else if ($query->status == 1) {
          return '<span class="label label-danger">Tanpa Keterangan</span>';
        } else if ($query->status == 2) {
          return '<span class="label label-success">Hadir</span>';
        } else if ($query->status == 3) {
          return '<span class="label label-info">Izin</span>';
        } else if ($query->status == 4) {
          return '<span class="label label-warning">Sakit</span>';
        }
      })->rawColumns(['tanggal', 'status'])->make(true);
  }

  public function rekapitulasiKehadiran()
  {
    $title = 'Halaman Rekapitulasi Kehadiran';
    $deskripsi = 'Halaman rekapitulasi kehadiran berfungsi untuk mengetahui jumlah kehadiran semua karyawan';
    return view('kehadiran.rekap', compact('title', 'deskripsi'));
  }

  public function datatable3()
  {
    $karyawan = KaryawanModel::where('id', '!=', 1)->get();
    $month = date('m');

    return DataTables::of($karyawan)
      ->addIndexColumn()
      ->addColumn('nama', function ($query) {
        return $query->nama;
      })
      ->addColumn('hadir', function ($query) use ($month) {
        $totalHadir = KehadiranModel::where('id_karyawan', $query->id)
          ->where('status', 2)
          ->whereMonth('tanggal', $month)
          ->count();
        return '<span class="label label-primary">' . $totalHadir . '</span>';
      })
      ->addColumn('alfa', function ($query) use ($month) {
        $totalAlfa = KehadiranModel::where('id_karyawan', $query->id)
          ->where('status', 1)
          ->whereMonth('tanggal', $month)
          ->count();
        return '<span class="label label-danger">' . $totalAlfa . '</span>';
      })
      ->addColumn('izin', function ($query) use ($month) {
        $totalIzin = KehadiranModel::where('id_karyawan', $query->id)
          ->where('status', 3)
          ->whereMonth('tanggal', $month)
          ->count();
        return '<span class="label label-info">' . $totalIzin . '</span>';
      })
      ->addColumn('sakit', function ($query) use ($month) {
        $totalSakit = KehadiranModel::where('id_karyawan', $query->id)
          ->where('status', 4)
          ->whereMonth('tanggal', $month)
          ->count();
        return '<span class="label label-warning">' . $totalSakit . '</span>';
      })
      ->rawColumns(['nama', 'hadir', 'izin', 'alfa', 'sakit'])
      ->make(true);
  }

  public function cetakDataKehadiran()
  {
    $monthName = date('n');
    $name = "Rekapitulasi Kehadiran Karyawan bulan " . monthConverter($monthName) . ".pdf";
    $karyawan = KaryawanModel::where('id', '!=', 1)->get();
    $pdf = App::make('dompdf.wrapper');
    $pdf->setPaper('A4', 'landscape');
    $pdf->loadView("cetak/cetak_kehadiran", compact('karyawan'));
    return $pdf->stream($name);
  }
}
