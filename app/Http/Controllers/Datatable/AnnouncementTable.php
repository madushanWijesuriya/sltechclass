<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Support\Facades\Auth;

class AnnouncementTable
{
    public static function laratablesCustomAction($recode){
        if ($recode->read_at)
            $btn = 'Read';
        else
            $btn = '<a href="' . route('announcementStudent.read', $recode->id) . '" class="edit btn btn-danger btn-sm">Mark as Read</a>';

        return $btn;
    }

    public static function laratablesCustomTopic($recode){
        return $recode->data["topic"];
    }
    public static function laratablesCustomMessage($recode){
       return $recode->data["message"];
    }
    public static function laratablesQueryConditions($query)
    {
        return $query->find(Auth::id())->notifications()->select('*');
    }
}
