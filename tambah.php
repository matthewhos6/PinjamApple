<?php 
    include("config/load.php");
    if(isset($_SESSION["id"])){
        if ($_SESSION["jabatan"] == 0) {
            header("Location: admin.php");
        }
        if(isset($_POST["btnLog"])){
            unset($_SESSION["id"]);
            unset($_SESSION["nama"]);
            unset($_SESSION["jabatan"]);
            header("Location: adminlog.php");
        }
        if(isset($_POST["btnListTipe"])){
            header("Location: listtipe.php");
        }
        if(isset($_POST["btnTipe"])){
            $ext = pathinfo($_FILES["gmbr"]["name"],PATHINFO_EXTENSION);
            echo $ext;
            $f=$_FILES["gmbr"];
            $t=time();
            $res=move_uploaded_file($f["tmp_name"],__DIR__."/assets/produk/".$t.".".$ext);
            $jenis = $_POST["jenis"];
            $model = $_POST["model"];
            $keterangan = $_POST["keterangan"];
            $harga = $_POST["harga"];
            $stmt = $db->prepare("INSERT INTO tipe(jenis,model,keterangan,gambar,harga) VALUES(:jenis,:model,:keterangan,:t,:harga)");
            $sukses = $stmt->execute([
                ':model' => $jenis,
                ':jenis' => $model,
                ':keterangan' => $keterangan,
                ':t' =>$t.".".$ext,
                ':harga' =>$harga
            ]);
            header("Location: listtipe.php");
        }
        $ses = $_SESSION["nama"];
    }else{
        header("Location: adminlog.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>
    <center><h1>Welcome, <?= $ses ?></h1>
    <form method="post">
        <span><button name="btnLog" type="submit" class="btn btn-danger">Logout</button> <button name="btnListTipe" type="submit" class="btn btn-secondary">Back</button>
    </form>
    <hr></center>
    <div class="container" style="margin-left: 40%;">
        <div class="row">
            <div class="col-4">
            <h3>Tambah Tipe</h3>
            <form method="POST" enctype="multipart/form-data">
                Jenis : <select name="jenis" id="">
                            <option value='iPhone'>iPhone</option>
                            <option value='iWatch'>iWatch</option>
                            <option value='iPod'>iPod</option>
                            <option value='MacBook'>MacBook</option>
                            <option value='iPad'>iPad</option>
                        </select><br>
                Model : <input type="text" name="model" required minlength="3"><br>
                Harga : <input type="number" name="harga" min="100" required><br>
                Keterangan : <br><textarea name="keterangan" style="width: 250px;"></textarea><br>
                Gambar : <input type="file" name="gmbr" accept="image/png, image/gif, image/jpeg" />
                <br>
                <button name="btnTipe" type="submit" class="btn btn-success">Tambah Tipe</button><br><br>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>