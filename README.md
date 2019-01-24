# Royal-Likes
# This script not work any more, for documentation only!
Royal Likes app direct access!

App Name : Get Followers<br/>
Package Name : com.ty.royallikes<br/>
Download Link : https://apkpure.com/royal-likes-for-instagram/com.ty.royallikes (Thanks APKPURE :*)

<h2>Setup</h2>
Upload file ke hosting (local maupun cloud / server), lalu lakukan setting atau panggil class untuk memulai, contoh :
<div><pre>require('royalLikes.php');
$a = new RoyalLikes();</pre></div>
<h2>Example</h2>
<h3>Login</h3>
Panggil function ini jika anda baru pertama kali menggunakan apps ini! Penting lho!
<pre>$a->login($iguser, $igid);</pre>
<h3>Set Instagram ID</h3>
Jika anda merupakan user yang telah terdaftar, disarankan menggunakan ini daripada ->login();
<pre>$a->setIgis($instagram_id)</pre>
<h3>Get Task</h3>
<p>Mengambil daftar task tersedia, berikut contoh untuk followers :</p>
<pre>$a->getFollowersList(1);</pre>
<p>Berikut untuk like :</p>
<pre>$a->getFollowersList(0);</pre>
<p>Jika menggunakan followers, anda akan mendapatkan +4 poin tiap action, sedangkan jika like +1.</p>
<h3>Action</h3>
<pre>$a->followAction($orderid);</pre>
<h3>Latest Response</h3>
Contoh mengambil response terakhir :
<pre>echo $a->lastResponse;</pre>
<h3>Add Order</h3>
<p>Untuk pembelian / penukaran coin, followers :</p>
<pre>$a->setIgis($igid)->adddOrderFollowers(1, "kouhota", 1469);</pre>
<p>Contoh diatas, 1 sebagai package id (1-6), parameter kedua username anda, parameter ketiga (1469) ubah sebagai start followers.</p>
<p>Penukaran likes :</p>
<pre>$a->setIgis($igid)->addOrderLikes(1, "1255555555544", "kouhota", 1469);</pre>
<p>Penukaran Views :</p>
<pre>$a->setIgis($igid)->addOrderViews(1, "1345150546096603952", $igid, "pandarez24", 28); print_r($a->lastResponse);</pre>
<p>Contoh diatas, 1 sebagai package id (1-4), parameter kedua adalah media id, parameter ketiga adalah username akun anda, parameter keempat (1469) ubah sebagai start followers.</p>
<h3>Contoh Lengkap</h3>
<p>Untuk mendapatkan coin :</p>
<pre>require('royalLikes.php');
$a = new RoyalLikes();
$igid = "454877888";
$iguser = "kouhota";
$a->login($iguser, $igid);
$fl = $a->setIgis($igid)->getFollowersList(1);
for($i=0;$i&lt;count($fl);$i++){
        $hh = $fl[$i];
        $orderid = $hh['orderId'];
        $a->followAction($orderid); // Response at $a->lastResponse 
        var_dump($a->lastResponse); 
    }</pre>
<p>Untuk penukaran coin :</p>
<pre>require('royalLikes.php');
$a = new RoyalLikes();
$igid = "454877888";
$iguser = "kouhota";
$a->setIgis($igid)->adddOrderFollowers(1, $iguser, 1469); print_r($a->lastResponse);</pre>
<h2>Notice</h2>
<p>Code ini free/open source dan hanya untuk pembelajaran saja, dimohon untuk tidak menjualnya ataupun yang lainnya, saya tidak bertanggungjawab atas segala kerugian yang ditimbulkan.</p>
<h2>Legal</h2>
<p>This code is in no way affiliated with, authorized, maintained, sponsored or endorsed by Instagram or any of its affiliates or subsidiaries. Use at your own risk.</p>
