<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\PushDemo;
use App\Notifications\PushNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class PushNotificationController extends Controller
{
    public function saveSubscription(Request $request)
    {
        $user = User::where('id', auth()->id())->first();
        $user->updatePushSubscription(
            $request->endpoint,
            $request->keys['p256dh'],
            $request->keys['auth']
        );

        return response()->json(['success' => true]);
    }
    public function send(Request $request)
    {
        try {
            //code...
            $user = User::where('id', auth()->id())->first();
            // $user->notify(new PushNotification());
           $data =  FacadesNotification::send($user, new PushDemo);

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
