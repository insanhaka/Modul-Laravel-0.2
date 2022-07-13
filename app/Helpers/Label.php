<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Label
{
    public function label1()
    {
        $current_uri = url()->current();
        $prefix = \Request::route()->getPrefix().'/';
        $menu = Str::between($current_uri, $prefix, '/');
        $fix_menu = Str::before($menu, '/');
        $upper_menu = Str::upper($fix_menu);
        $label1 = Str::replace('-', ' ', $upper_menu);

        return $label1;
    }

    public function label2()
    {
        $last_uri = Str::title(request()->segment(count(request()->segments())));
        $label2 = Str::replace('-', ' ', $last_uri);

        return $label2;
    }
}
