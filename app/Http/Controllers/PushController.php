<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\PushDemo;
use App\Models\User;
use App\Models\PushSubscription;
use Auth;
use Notification;

class PushController extends Controller
{
    /**
     * Store the PushSubscription.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        /** @var User $user */

        $user = auth()->user();

        // PushSubscription::create([

        // ]);

        return $user->updatePushSubscription(
            $request->get('endpoint'),
            $request->keys['p256dh'],
            $request->keys['auth']
        );
    }

    /**
     * Send Push Notifications to all users.
     * 
     * @return \Illuminate\Http\Response
     */
    public function push(){
        Notification::send(User::all(),new PushDemo);
        return redirect()->back();
    }
}
