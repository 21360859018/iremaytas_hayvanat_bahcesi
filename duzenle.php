<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilgi Düzenleme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    // baglanti.php yi dahil ettim.
    include("baglanti.php");

   
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // id ile veri tabanından verileri çektim tabiki sonuç varsa sonuç yoksa mesaj gönderdim.
        $sec = "SELECT * FROM hayvanlar WHERE id = $id";
        $sonuc = $baglan->query($sec);
        if($sonuc->num_rows > 0) {
            $cek = $sonuc->fetch_assoc();
        } else {
                echo "<script>alert('Kayıt bulunamadı.'); window.location.href='panel.php';</script>";
        }
    }

    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $cins = $_POST['cins'];
        $saglik = $_POST['saglik'];
        $beslenme = $_POST['beslenme'];
        $alan = $_POST['alan'];
        $diger = $_POST['diger'];

        // veriyi güncelledim.
        $guncelle = "UPDATE hayvanlar SET cins='$cins', saglik='$saglik', beslenme='$beslenme', alan='$alan', diger='$diger' WHERE id=$id";
        if($baglan->query($guncelle) === TRUE) {
            // doğru şekide güncellenirse mesaj gönderdim.
            echo "<script>alert('Kayıt başarıyla güncellendi.'); window.location.href='panel.php';</script>";
        } else {
            echo "Hata: " . $baglan->error;
        }
    }
    ?>

    <!-- bilgileri düzenlemeye yarayan form -->
    <form method="POST" action="duzenle.php">
        <!-- id yi sakladım ki sorun olmasın. -->
        <input type="hidden" name="id" value="<?php echo $cek['id']; ?>">
        <label for="cins">Hayvanın Cinsi:</label>
        <!-- veriler burada güncelleniyorlar. -->
        <input type="text" id="cins" name="cins" value="<?php echo $cek['cins']; ?>" required>

        <label for="saglik">Sağlık Durumu:</label>
        <input type="text" id="saglik" name="saglik" value="<?php echo $cek['saglik']; ?>" required>

        <label for="beslenme">Beslenme Alışkanlıkları:</label>
        <input type="text" id="beslenme" name="beslenme" value="<?php echo $cek['beslenme']; ?>" required>

        <label for="alan">Yaşam Alanları:</label>
        <input type="text" id="alan" name="alan" value="<?php echo $cek['alan']; ?>" required>

        <label for="diger">Diğer Bilgiler:</label>
        <textarea id="diger" name="diger" rows="4" required><?php echo $cek['diger']; ?></textarea>

        <!-- güncelleme butonu  -->
        <input type="submit" name="update" value="Güncelle" style="background-color: maroon">
    </form>
</body>
</html>
