<?php
require 'vendor/autoload.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// Your VAPID keys (replace with your actual keys)
$publicKey = 'BGqfstkQ7AQgKLH_ZiIRvY9nzWX_WJEnmReafH79S_NW7uD10EPtkvwXhKQh12hY0otRxYnZDesw1czoj83ibxM';
$privateKey = 'O9cX75D43rOcdKhetWu4Zftpmr59vMzwYOGdsWFum7w';

// Create a subscription object (replace with the actual subscription data from the user)
$subscription = Subscription::create([
    'endpoint' => 'https://fcm.googleapis.com/fcm/send/abcd1234', // Replace with endpoint
    'keys' => [
        'p256dh' => 'BNcF23lD...', // Replace with p256dh key
        'auth' => 'dHqF_vB1...',   // Replace with auth key
    ],
]);

// Create the WebPush instance
$webPush = new WebPush([
    'VAPID' => [
        'subject' => 'mailto:youremail@example.com', // Replace with your email
        'publicKey' => $publicKey,
        'privateKey' => $privateKey,
    ],
]);

// Payload to send
$payload = json_encode([
    'title' => 'Test Notification',
    'body' => 'This is a test push notification!',
]);

// Send the notification
$result = $webPush->sendNotification($subscription, $payload);

if ($result->isSuccess()) {
    echo "Push notification sent successfully!";
} else {
    echo "Failed to send notification: " . $result->getReason();
}
?>
