<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Role_has_menu;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Back_menu
{

    public static function getRole($role)
    {
        $get_menu_id = Role_has_menu::where('role_id', $role)->get();

        if ($get_menu_id->isEmpty()) {
            return '';
        }

        foreach ($get_menu_id as $value) {
            $menu_id[] = $value->menu_id;
        }

        $menus = Menu::find($menu_id);

        foreach($menus as $data_menu)
        {

            $menu_name = $data_menu->name;
            $menu_uri = '/admin/'.$data_menu->uri;
            $menu_icon = Storage::url('icon/'.$data_menu->icon);
            $menuID = Str::after($data_menu->uri, '/');

            $html_out = '<li class="nav-item">
                            <a class="nav-link" href="'.$menu_uri.'" id="'.$menuID.'">
                            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <img src="'.$menu_icon.'" class="img-fluid" alt="Responsive image" width="40">
                            </div>
                            <span class="nav-link-text ms-1">'.$menu_name.'</span>
                            </a>
                        </li>' ;

            echo $html_out;

        }

    }
}
