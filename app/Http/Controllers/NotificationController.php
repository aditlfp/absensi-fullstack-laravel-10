<?php

use App\Notifications\UseAbsenNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    public function sendNotificationToUser(User $user)
    {
        // Cek apakah pengguna telah menerima notifikasi pada hari ini
        if (!$user->hasReceivedNotificationToday()) {
            // Kirim notifikasi ke antrian
            Notification::send($user, new MyNotification());
            $user->markNotificationAsSent(); // Tandai bahwa notifikasi telah dikirim
        }
    }
}


