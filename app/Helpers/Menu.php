<?php

namespace App\Helpers;

class Menu
{
    public static function get()
    {
        return [
            [
                "title" => "MENU",
                "url"   => null,
            ],
            [
                "title" => "Dashboard",
                "url"   => "admin/",
                "icon"  => "bx bx-home"
            ],
            [
                "title" => "MASTER HOYA",
                "url"   => null,
            ],
            [
                "title" => "Hoya",
                "url"   => "admin/hoya",
                "icon"  => "bx bx-leaf"
            ],
            [
                "title" => "Asosiasi Serangga",
                "url"   => "admin/insect-association",
                "icon"  => "bx bx-bug"
            ],
            [
                "title" => "Hama",
                "url"   => "admin/pest",
                "icon"  => "bx bx-spray-can"
            ],
            [
                "title" => "MASTER DATA",
                "url"   => null,
            ],
            [
                "title" => "Enumeration",
                "url"   => "admin/enumeration",
                "icon"  => "bx bx-collection"
            ],
            [
                "title" => "Slider",
                "url"   => "admin/slider",
                "icon"  => "bx bx-image"
            ],
            [
                "title" => "Tim Ahli",
                "url"   => "admin/team",
                "icon"  => "bx bx-user"
            ]
        ];
    }
}