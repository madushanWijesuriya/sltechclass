<?php


namespace App\Http\Service;


use App\Notifications\AnnouncementNotification;
use App\Notifications\DelayPaymentWarning;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    public static function getNotificationCount(){
        return Auth::user()->unreadNotifications()->count();
    }
    public static function getDelayNotification(){
        return Auth::user()->unreadNotifications()->where('type',DelayPaymentWarning::class)->count();
    }
    public static function getAnnouncementNotification(){
        return Auth::user()->unreadNotifications()->where('type',AnnouncementNotification::class)->count();
    }
}
