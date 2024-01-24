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
                "title" => "Morfologi",
                "url"   => "admin/morfology",
                "icon"  => "bx bx-leaf"
            ],
            [
                "title" => "Hoya",
                "url"   => "admin/hoya",
                "icon"  => "bx bx-spa"
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
                "title" => "Slider",
                "url"   => "admin/slider",
                "icon"  => "bx bx-image"
            ],
            [
                "title" => "Kolaborator",
                "url"   => "admin/collaborator",
                "icon"  => "bx bxs-user-badge"
            ],
            [
                "title" => "MASTER USER",
                "url"   => null,
            ],
            [
                "title" => "User",
                "url"   => "admin/user",
                "icon"  => "bx bx-user"
            ],
        ];
    }
}