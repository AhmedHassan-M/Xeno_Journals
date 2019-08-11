<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Notification;

class NotificationsController extends Controller
{
    public function allNotifications() {
        $user = User::find(Auth::user()->id);
        $notifications = $user->notification()->latest()->get();
        return view('admin.all_notifications')->withNotifications($notifications);
    }
}
