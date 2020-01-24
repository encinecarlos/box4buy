<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 5/21/19
 * Time: 4:25 PM
 */

namespace App\Lib;

use App\User;
use App\Notifications\AnnouncementNotification;
use Illuminate\Support\Facades\Notification;

class NotificationSystem
{
    /**
     * Envia notificações aos clientes do sistema
     * @param $user_id
     * @param $message
     * @param $type
     * @param $icon
     * @param $extra
     */
    public static function notifyUser($user_id, $message, $type, $icon, $extra)
    {
        $user_notify = User::find($user_id);
        Notification::send($user_notify, new AnnouncementNotification(
            $message,
            $type,
            $icon,
            $extra));
    }

    /**
     * Metodo para enviar notiicações aos admins do sistema
     * @param $message
     * @param $type
     * @param null $icon
     * @param null $extra
     */
    public static function notifyAdmin($message, $type, $icon = null, $extra = null)
    {
        $user_notify = User::where('type_user', '1')->get();
        Notification::send($user_notify, new AnnouncementNotification(
            $message,
            $type,
            $icon,
            $extra));
    }


}
