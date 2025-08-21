<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/private/firebase/velanto-stag-firebase-adminsdk-fbsvc-9924390229.json'));


        $this->messaging = $factory->createMessaging();
    }

    /**
     * Send a push notification to a specific FCM token
     */
     public function sendNotificationToToken(string $deviceToken, string $title, string $body, array $data = [])
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification)
            ->withData($data);

        return $this->messaging->send($message);
    }
public function sendNotificationToMany(array $deviceTokens, string $title, string $body, array $data = [])
{
    if (empty($deviceTokens)) {
        return false;
    }

    $notification = Notification::create($title, $body);

    $message = CloudMessage::new()
        ->withNotification($notification)
        ->withData($data);

    // Send to multiple tokens
    return $this->messaging->sendMulticast($message, $deviceTokens);
}
}
