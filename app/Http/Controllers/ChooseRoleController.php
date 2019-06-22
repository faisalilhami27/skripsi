<?php

namespace App\Http\Controllers;

use App\Models\ChooseRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChooseRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->session()->get('login')) {
                return redirect('auth');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $idKaryawan = Session::get('id_users');
        $chooseRole = ChooseRoleModel::with('roleMany')
            ->where('id_karyawan', $idKaryawan)
            ->get();
        $title = "Choose Role Level";
        return view('role.roleView', compact('chooseRole', 'title'));
    }

    public function linkDashboard(Request $request)
    {
        $idUserLevel = $request->id;
        $level = ChooseRoleModel::where('id_user_level', $idUserLevel)
          ->where('id_karyawan', Session::get('id_users'))
          ->first();
        Session::put('id_user_level', $idUserLevel);
        Session::put('id_role', $level->id);
        $id = Session::get('id_user_level');
        $idRole = Session::get('id_role');
        return response()->json(['status' => 200, 'level' => $id, 'id_role' => $idRole]);
    }
}
