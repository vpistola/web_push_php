<?php
// (A) LOAD WEB PUSH LIBRARY
require "vendor/autoload.php";
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

// (B) GET SUBSCRIPTION
$t = '{
  "endpoint":"https://fcm.googleapis.com/fcm/send/fTMfTn0dm1M:APA91bG_kT11-7emF_TEUOW_X7FgT3rznFjh6w9w8MHAukV1BmhBdlPCN6jmbWWa7N8Od4ZO-t1BbM58ZUB1bxAQXqTgNfMl7zpu1Fli5vDnsImrwhtlTTNj1lod3RY0iP80msGHsrs8",
  "expirationTime":null,
  "keys":{
      "p256dh":"BK5HpNCj2sARqzcvBjseYJT1Qlcha-ddJCVxxqsZyMaAwMJbh8iMGgcZAXgZKS-lXnHaQpt3S7ssOA4Lzk_tjSA",
      "auth":"rNKQKCVZrXLT5mnbx5MGcA"
  }
}';
//$sub = Subscription::create(json_decode($_POST["sub"], true));
$sub = Subscription::create(json_decode($t, true));

// (C) NEW WEB PUSH OBJECT - CHANGE TO YOUR OWN!
$push = new WebPush(["VAPID" => [
  "subject" => "evangelos.pistolas@athenarc.gr",
  "publicKey" => "BLEeHv9QLshSrT5Et6K_8P0WqBxsvZN-YRycg3Zm4PQ3LwZXnqtFTTTlL94_-mwYvrbV69hC9wDBvf8eTk8zgg0",
  "privateKey" => "Z15xXoPJvPDdfEVltIyQTqjG5jsKWZ4zq34RnPd0jO0"
]]);

// (D) SEND TEST PUSH NOTIFICATION
$result = $push->sendOneNotification($sub, json_encode([
  "title" => "Welcome!",
  "body" => "Yes, it works!",
  "icon" => "i-loud.png",
  "image" => "i-cover.png"
]));
$endpoint = $result->getRequest()->getUri()->__toString(); 

// (E) HANDLE RESULT - OPTIONAL
if ($result->isSuccess()) {
  // echo "Successfully sent {$endpoint}.";
} else {
  // echo "Send failed {$endpoint}: {$result->getReason()}";
  // $result->getRequest();
  // $result->getResponse();
  // $result->isSubscriptionExpired();
}