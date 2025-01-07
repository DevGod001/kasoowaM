<?php
// Replace 'YOUR_API_TOKEN' with the API token you received from BotFather
$API_TOKEN = '7732772150:AAEQ4NrIkqO5Z5W3tHViH_yzNbiPYcv0hWw';
$API_URL = "https://api.telegram.org/bot$API_TOKEN/";

function sendMessage($chat_id, $message) {
    global $API_URL;

    $data = [
        'chat_id' => $chat_id,
        'text' => $message
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $API_URL . "sendMessage");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_exec($ch);
    curl_close($ch);
}

// Get updates from Telegram
$content = file_get_contents("php://input");
$update = json_decode($content, true);

// Check for new messages
if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $text = $update["message"]["text"];

    // Respond to the /start command
    if ($text === "/start") {
        $message="Welcome to our community! 🎉

We are excited to have you join us. To get started, simply click the link below to join our exclusive group and earn 100 NGN as a welcome bonus!

👉 Join our Group and Earn 100 NGN
https://t.me/homeoflegitupdate15
https://t.me/Crystalmediagamesite

After joining the group click /joined to get your free 100NGN
If you have any questions or need assistance, feel free to reach out. We're here to help!

Looking forward to seeing you in the group! 😊";
        sendMessage($chat_id, $message);
    } else {
        sendMessage($chat_id, "You said: $text");
    }
}
?>