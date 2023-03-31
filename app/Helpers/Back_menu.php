<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\Role_has_menu;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
// use stdClass;
use Illuminate\Support\Arr;
use Auth;

class Back_menu
{

    public static function getRole($user_id)
    {
        $user = User::find($user_id)->roles()->get();

        $y_role = array();
        foreach ($user as $role) {
            array_push($y_role, $role->id);
        }

        $get_menu_id = Role_has_menu::whereIn('role_id', $y_role)->get();

        if ($get_menu_id->isEmpty()) {
            return null;
        }

        $menu_id = array();
        foreach ($get_menu_id as $value) {
            array_push($menu_id, $value->menu_id);
        }

        $menus = Menu::find($menu_id);

        $parent = array();
        $child = array();
        foreach ($menus as $value) {
            if ($value->type == "parent" && $value->is_active == 1) {
                array_push($parent, $value);
            }
            if ($value->type == "child" && $value->is_active == 1) {
                array_push($child, $value);
            }
        }

        $parent_has_child = array();
        foreach ($child as $result) {
            array_push($parent_has_child, $result->parent_id);
        }

        return (["parent"=>$parent, "child"=>$child, "parenthaschild"=>$parent_has_child]);

        // foreach($menus as $data_menu)
        // {

        //     $menu_name = $data_menu->name;
        //     $menu_uri = '/admin/'.$data_menu->uri;
        //     $menu_icon = Storage::url('icon/'.$data_menu->icon);
        //     $menuID = Str::after($data_menu->uri, '/');

        //     $html_out = '<li class="menu-item mb-2" id="'.$menuID.'">
        //                     <a href="'.$menu_uri.'" class="menu-link">
        //                         <img src="'.$menu_icon.'" class="img-fluid" alt="Responsive image" width="15" style="margin-right: 18px">
        //                         <div data-i18n="Analytics">'.$menu_name.'</div>
        //                     </a>
        //                 </li>' ;

        //     echo $html_out;

        // }

    }

    public static function getURI()
    {
        $current_uri = url()->current();
        $prefix = \Request::route()->getPrefix().'/';
        $menu = Str::between($current_uri, $prefix, '/');
        $fix_menu = Str::before($menu, '/');
        // $upper_menu = Str::upper($fix_menu);
        // $label1 = Str::replace('-', ' ', $fix_menu);

        return $fix_menu;
    }

    public static function getID()
    {
        $current_uri = url()->current();
        $prefix = \Request::route()->getPrefix().'/';
        $menu = Str::between($current_uri, $prefix, '/');
        $fix_menu = Str::before($menu, '/');
        
        $get_menu = Menu::where('uri', $fix_menu)->first();
        if ($get_menu == null) {
            return null;
        }else {
            return $get_menu->parent_id;
        }
    }
}
