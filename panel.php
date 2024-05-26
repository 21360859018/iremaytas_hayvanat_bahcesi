<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even) {background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: maroon; /* Başlıkların arka plan rengini bordo yaptım */
  color: white;
}

.button-container {
  margin: 20px;
  text-align: center;
}

.btn {
  background-color: maroon; /* Butonların arka plan rengini bordo yaptım */
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  border-radius: 3px;
  text-decoration: none;
}

.btn:hover {
  opacity: 0.9;
}
</style>
</head>
<body>

<h1>Hayvanlar Tablosu</h1>

<div class="button-container">
  <!-- giriş sayfasına yönlendirdim. -->
  <a href="index.php" class="btn">Giriş Sayfasına Dön</a>
</div>

<table id="customers">
  <!-- burada panel tablosunun başlıklarını ayarladım. -->
  <tr>
    <th>Hayvanın Cinsi</th>
    <th>Sağlık Durumu</th>
    <th>Beslenme Alışkanlıkları</th>
    <th>Yaşam Alanları</th>
    <th>Diğer Bilgiler</th>
    <th>Düzenle</th>
    <th>Sil</th>
  </tr>
  
  <?php
  include("baglanti.php"); // baglanti.php'yi dahil ettim 

  if(isset($_GET['id'])) {
      $id = $_GET['id'];
      // silme işlemi
      $sil = "DELETE FROM hayvanlar WHERE id = $id";       
      if($baglan->query($sil) === TRUE) {
          echo "<script>alert('Kayıt başarıyla silindi.'); window.location.href='panel.php';</script>";
      } else {
          echo "Hata: " . $baglan->error;
      }
  }

  $sec = "SELECT * FROM hayvanlar";
  $sonuc = $baglan->query($sec);

  // eğer sonucun sutun sayısı 0 dan büyükse yani veri girilmişse onları çekiyorum 
  if($sonuc->num_rows > 0) {      
      while($cek = $sonuc->fetch_assoc()) {
          echo "
          <tr>
              <td>".$cek['cins']."</td>
              <td>".$cek['saglik']."</td>
              <td>".$cek['beslenme']."</td>
              <td>".$cek['alan']."</td>
              <td>".$cek['diger']."</td>
              <td><a href='duzenle.php?id=".$cek['id']."'>Düzenle</a></td>
              <td><a href='panel.php?id=".$cek['id']."' onclick=\"return confirm('Bu kaydı silmek istediğinizden emin misiniz?');\">Sil</a></td>
          </tr>";
      }
  } else { 
      // eğer veri girilmemişse veri bulunamadı mesajı gönderiyorum.
      echo "<tr><td colspan='7'>Veritabanında kayıtlı hiçbir veri bulunamamıştır.</td></tr>"; 
  }
  ?>
</table>

</body>
</html>
