<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: purple; 
}
* {
  box-sizing: border-box;
}
.input-container {
  display: -ms-flexbox; 
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}
.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
  border: 1px solid #ccc; 
}
.input-field:focus {
  border: 2px solid maroon; 
}
.btn {
  background-color: maroon; 
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.btn:hover {
  opacity: 1;
}
</style>
</head>
<body>

<form action="index.php" method="POST" style="max-width:500px;margin:auto">
  <!-- burada ana sayfadaki formu oluşturdum. -->
  <h2>HAYVANAT BAHÇESİ</h2>
  
  <div class="input-container">
    <input class="input-field" type="text" placeholder="Hayvanın Cinsi" name="cins" required>
  </div>

  <div class="input-container">
    <input class="input-field" type="text" placeholder="Sağlık Durumu" name="saglik" required>
  </div>
  
  <div class="input-container">
    <input class="input-field" type="text" placeholder="Beslenme Alışkanlıkları" name="beslenme" required>
  </div>

  <div class="input-container">
    <input class="input-field" type="text" placeholder="Yaşam Alanları" name="alan" required>
  </div>

  <div class="input-container">
    <input class="input-field" type="text" placeholder="Diğer Bilgiler" name="diger" required>
  </div>
  
  <button type="submit" class="btn">Giriş Yap</button>
</form>

<!-- bu butona basınca panel sayfasına gidiyoruz. -->
<form action="panel.php" method="GET" style="max-width:500px;margin:auto;margin-top:20px;">
  <button type="submit" class="btn">Panele Git</button>
</form>

</body>
</html>

<?php
include("baglanti.php");   // baglanti sayfasını ekledim.

if(isset($_POST["cins"], $_POST["saglik"], $_POST["beslenme"], $_POST["alan"], $_POST["diger"])) {
    $cins = $_POST["cins"];
    $saglik = $_POST["saglik"];
    $beslenme = $_POST["beslenme"];
    $alan = $_POST["alan"];
    $diger = $_POST["diger"];

    $ekle = "INSERT INTO hayvanlar (cins, saglik, beslenme, alan, diger) VALUES ('$cins', '$saglik', '$beslenme', '$alan', '$diger')";

    if($baglan->query($ekle) === TRUE) {
        echo "<script>alert('Mesajınız başarı ile gönderilmiştir.'); window.location.href='index.php';</script>";
    } else {
        echo "Hata: " . $ekle . "<br>" . $baglan->error;
    }
}
?>
