<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole');
    }

    public function index()
    {
        $title = 'Halaman Data Customer';
        $deskripsi = 'Halaman data customer digunakan untuk mengelola data customer';
        return view('customer.customerView', compact('title', 'deskripsi'));
    }

    public function datatable()
    {
        $data = CustomerModel::all();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $getData = CustomerModel::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50|regex:/^[a-zA-Z ]*$',
            'status' => 'required'
        ]);

        $email = $request->email;
        $status = $request->status;
        $id = $request->id;

        $update = CustomerModel::find($id)->update([
            'email' => $email,
            'status' => $status
        ]);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = CustomerModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal dihapus']);
        }
    }
}
