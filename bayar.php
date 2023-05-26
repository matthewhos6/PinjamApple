<?php
include("config/load.php");
    if (isset($_POST["upload"])) {
        $ext = pathinfo($_FILES["gmbr"]["name"],PATHINFO_EXTENSION);
        // echo $ext;
        $f=$_FILES["gmbr"];
        $t="b".time();
        $res=move_uploaded_file($f["tmp_name"],__DIR__."/assets/bukti/".$t.".".$ext);
        
        $stmt = $db->prepare("Update transaksi set bukti_bayar=:judul where id_trans=$_SESSION[id_trans]");
        $sukses = $stmt->execute([
            ':judul' => $t.".".$ext
        ]);
        if ($sukses) {
            echo "<script>alert('Bukti bayar telah kami terima, Terima kasih')</script>";
        }else if (!$sukses) {
            echo "<script>alert('Bukti bayar salah')</script>";
        }
        header("location:user.php");
    }
    if (isset($_POST["balikuser"])) {
        $stmt = $db->prepare("delete from transaksi where id_trans=$_SESSION[id_trans]");
        $sukses = $stmt->execute([
        ]);
        $stmt = $db->prepare("update barang set status=1 where id_barang=$_SESSION[pinjam]");
        $sukses = $stmt->execute([
        ]);
        header("location:user.php");

    }
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div class="container" style=" margin-top: 5%;"> 
        <form method="POST" enctype="multipart/form-data">
            <button type="submit" name="balikuser" class="btn btn-danger" style="margin-top: 40px;">Batalkan peminjaman</button>
            <div class="card border border-5 rounded" style="width: 60%; margin: auto; align-items: center; margin-top: 10px; padding: 50px;">
                <h2>Jumlah yang harus dibayar: <span style="font-weight: bold;">Rp.<?= number_format($_SESSION["total"],2,',','.')?></span></h2>
                <h3 class="fs-1 fw-bold">Pembayaran bisa melalui:</h3>
                <div style="align-items: flex-start; margin-top: 10px;">
                    <img src="assets/img/BCA_logo.png" style="width: 100px;height: 75px;"> 0881337443 A/N Anno Eduardo Wuwung<br>
                    <img src="assets/img/logo_ovo.png" style="width: 100px;height: 35px;"> 089677170382 A/N Anno Eduardo Wuwung
                </div>
                <h5 style="margin-top: 50px;">Lalu bukti bayar bisa disubmit di bawah ini</h5>
                    <div class="mb-3" style="margin-top: 10px;">
                        <input class="form-control" type="file" id="formFile" name="gmbr" accept="image/png, image/gif, image/jpeg" >
                    </div>
                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
</body>
</html>