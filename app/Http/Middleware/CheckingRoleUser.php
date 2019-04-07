<?php

namespace App\Http\Middleware;

use App\Models\MenuModel;
use App\Models\RoleLevelModel;
use App\Models\UserModel;
use Closure;
use Illuminate\Support\Facades\Request;

class CheckingRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $idUser = $request->session()->get('id_users');
        $user = UserModel::find($idUser);

        if (!$idUser) {
            return redirect('auth');
        } else if (is_null($user)) {
            return redirect('auth');
        } else {
            $modul = Request::segment(1);
            if ($modul == "") {
                $modul = "dashboard";
            }
            $idUserLevel = $request->session()->get('id_user_level');
            $menu = MenuModel::where('url', $modul)->first();
            $idMenu = $menu['id'];
            $hakAkses = RoleLevelModel::where('id_menu', $idMenu)
                ->where('id_user_level', $idUserLevel)
                ->get();
            if ($hakAkses->count() < 1) {
                return redirect('blokir');
            }
        }
        return $next($request);
    }
}
