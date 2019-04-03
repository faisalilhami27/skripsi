<?php
/**
 * Created by PhpStorm.
 * User: Muhamad Faisal I A
 * Date: 2/21/2019
 * Time: 14:13
 */

use App\Models\KonfigurasiModel;
use App\Models\MenuModel;
use App\Models\PemesananModel;
use App\Models\RoleLevelModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

if (!function_exists('sidebar')) {
    function sidebar()
    {
        $setting = DB::table('setting')->where('id', 1)->first();
        if ($setting->value == "ya") {
            $sqlMenu = MenuModel::whereIn('id', function ($query) {
                $idUserLevel = Session::get('id_user_level');
                $query->select('id_menu')
                    ->from('trs_role_level')
                    ->where('id_user_level', $idUserLevel);
            })
                ->where('is_main_menu', 0)
                ->where('is_aktif', 'y')
                ->get();
        } else {
            $sqlMenu = MenuModel::where('is_aktif', 'y')
                ->where('is_main_menu', 0)
                ->get();
        }

        $mainMenu = $sqlMenu;
        $page = Request::segment(1);
        foreach ($mainMenu as $menu) {
            $subMenu = MenuModel::where('is_aktif', 'y')
                ->where('is_main_menu', $menu->id)
                ->get();
            if ($subMenu->count() > 0) {
                echo "<li class='sidenav-item has-subnav'>
						<a href='' aria-haspopup='true'>
							<span class='sidenav-icon " . $menu->icon . "'></span>
							<span class='sidenav-label'>" . strtoupper($menu->title) . "</span>
						</a>
							<ul class='sidenav level-2 collapse'>";
                foreach ($subMenu as $sub) {
                    if ($page == $sub->url) {
                        echo "<li class='active'>" . "<a href='" . URL($sub->url) . "'  style='cursor: pointer'>" . '<span class="' . $sub->icon . '"></span>' . strtoupper($sub->title) . "</a></li>";
                    } else {
                        echo "<li>" . "<a href='" . URL($sub->url) . "'  style='cursor: pointer'>" . '<span class="' . $sub->icon . '"></span>' . strtoupper($sub->title) . "</a></li>";
                    }
                }
                echo " </ul>
						</li>";
            } else {
                if ($page == $menu->url) {
                    Session::put('id_menu', $menu->id);
                    Session::get('id_menu');
                    echo "<li class='sidenav-item active'>";
                    echo "
						<a href='" . URL($menu->url) . "'>
							<span class='sidenav-icon " . $menu->icon . "'><i class=''></i></span>
                    		<span class='sidenav-label'>" . strtoupper($menu->title) . "</span>
						</a>";
                    echo "</li>";
                } else {
                    echo "<li class='sidenav-item'>";
                    echo "
						<a href='" . URL($menu->url) . "'>
							<span class='sidenav-icon " . $menu->icon . "'></span>
                    		<span class='sidenav-label'>" . strtoupper($menu->title) . "</span>
						</a>";
                    echo "</li>";
                }
            }
        }
    }
}

if (!function_exists('beriAkses')) {
    function beriAkses($idUserLevel, $idMenu)
    {
        $query = RoleLevelModel::where('id_user_level', $idUserLevel)
            ->where('id_menu', $idMenu)
            ->get();
        $akses = $query->count();
        if ($akses > 0) {
            return "checked='checked'";
        }
    }
}

if (!function_exists('create')) {
    function create($idUserLevel, $idMenu)
    {
        $query = RoleLevelModel::select("create")
            ->where('id_user_level', $idUserLevel)
            ->where('id_menu', $idMenu)
            ->where('create', 1)
            ->get();
        $create = $query->count();
        if ($create > 0) {
            return "checked='checked'";
        }
    }
}

if (!function_exists('read')) {
    function read($idUserLevel, $idMenu)
    {
        $query = RoleLevelModel::select("read")
            ->where('id_user_level', $idUserLevel)
            ->where('id_menu', $idMenu)
            ->where('read', 1)
            ->get();
        $create = $query->count();
        if ($create > 0) {
            return "checked='checked'";
        }
    }
}

if (!function_exists('update')) {
    function update($idUserLevel, $idMenu)
    {
        $query = RoleLevelModel::select("update")
            ->where('id_user_level', $idUserLevel)
            ->where('id_menu', $idMenu)
            ->where('update', 1)
            ->get();
        $create = $query->count();
        if ($create > 0) {
            return "checked='checked'";
        }
    }
}

if (!function_exists('delete')) {
    function delete($idUserLevel, $idMenu)
    {
        $query = RoleLevelModel::select("delete")
            ->where('id_user_level', $idUserLevel)
            ->where('id_menu', $idMenu)
            ->where('delete', 1)
            ->get();
        $create = $query->count();
        if ($create > 0) {
            return "checked='checked'";
        }
    }
}

if (!function_exists('checkAccess')) {
    function checkAccess($idUserLevel, $idMenu)
    {
        $query = RoleLevelModel::select("delete", "create", "update", "read")
            ->where('id_user_level', $idUserLevel)
            ->where('id_menu', $idMenu)
            ->first();

        $data = [
            'create' => $query->create,
            'read' => $query->read,
            'update' => $query->update,
            'delete' => $query->delete
        ];

        return $data;
    }
}

if (!function_exists('getIdMenu')) {
    function getIdMenu()
    {
        $setting = DB::table('setting')->where('id', 1)->first();
        if ($setting->value == "ya") {
            $sqlMenu = MenuModel::whereIn('id', function ($query) {
                $idUserLevel = Session::get('id_user_level');
                $query->select('id_menu')
                    ->from('trs_role_level')
                    ->where('id_user_level', $idUserLevel);
            })
                ->where('is_main_menu', 0)
                ->where('is_aktif', 'y')
                ->get();
        } else {
            $sqlMenu = MenuModel::where('is_aktif', 'y')
                ->where('is_main_menu', 0)
                ->get();
        }

        $mainMenu = $sqlMenu;
        $page = Request::segment(1);
        foreach ($mainMenu as $menu) {
            if ($menu->is_main_menu != 0) {
                $subMenu = MenuModel::where('is_aktif', 'y')
                    ->where('is_main_menu', $menu->id)
                    ->get();
                if ($subMenu->count() > 0) {
                    foreach ($subMenu as $sub) {
                        if ($page == $sub->url) {
                            Session::put('id_menu', $sub->id);
                        }
                    }
                }
            } else {
                if ($page == $menu->url) {
                    Session::put('id_menu', $menu->id);
                }
            }
        }
        return Session::get('id_menu');
    }
}

if (!function_exists('setKode')) {
    function setKode()
    {
        $query = PemesananModel::select(DB::raw('RIGHT(kode_pemesanan, 4) as kode'))
            ->where('tgl_pemesanan', date('Y-m-d'))
            ->orderBy('kode_pemesanan', 'DESC')
            ->limit(1);
        if ($query->count() > 0) {
            foreach ($query->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return $kd;
    }
}

if (!function_exists('versionApp')) {
    function versionApp()
    {
        $query = KonfigurasiModel::all();
        return $query[8]->nilai_konfig;
    }
}

if (!function_exists('getIdUserLevel')) {
    function getIdUserLevel($id)
    {
        return $id;
    }
}

if (!function_exists('checkProfile')) {
    function checkProfile()
    {
        $query = Session::get('login');
        return $query;
    }
}

if (!function_exists('encryptString')) {
    function encryptString($string)
    {
        $output = false;

        $encrypt_method = config('constants.ENCRYPT_METHOD');
        $secret_key = config('constants.SECRET_KEY');
        $secret_iv = config('constants.SECRET_IV');

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);

        return $output;
    }
}

if (!function_exists('decryptString')) {
    function decryptString($string)
    {
        $output = false;

        $encrypt_method = config('constants.ENCRYPT_METHOD');
        $secret_key = config('constants.SECRET_KEY');
        $secret_iv = config('constants.SECRET_IV');

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

        return $output;
    }
}
