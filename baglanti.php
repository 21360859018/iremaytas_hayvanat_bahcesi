<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "hayvanat_bahcesi";

// veritabanına bağlanırken aynı sırayla girdim ki sorun olmasın
$baglan = mysqli_connect($servername, $username, $password, $dbname);

// bağlantıyı kontrol ettim
if (!$baglan) {
    die("Bağlantı hatası: " . mysqli_connect_error()); // bağlantı hatası olunca mesaj veriyorum
}
?>
