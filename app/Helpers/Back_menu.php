<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Role_has_menu;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
// use stdClass;
use Illuminate\Support\Arr;

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

    public function getURI()
    {
        $current_uri = url()->current();
        $prefix = \Request::route()->getPrefix().'/';
        $menu = Str::between($current_uri, $prefix, '/');
        $fix_menu = Str::before($menu, '/');
        // $upper_menu = Str::upper($fix_menu);
        // $label1 = Str::replace('-', ' ', $fix_menu);

        return $fix_menu;
    }

    public function getID()
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
