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
        if(isset($_POST["btnListBarang"])){
            header("Location: listbarang.php");
        }
        
        if(isset($_POST["btnDeleteBarang"])){
            $id = $_POST["btnDeleteBarang"];
            $stmt = $db->prepare("DELETE FROM `barang` WHERE ID_Barang = :id");
            $sukses = $stmt->execute([
                ':id' => $id
            ]);
            header("Location: tambah.php");
        }
        if(isset($_POST["btnBarang"])){
            $tipe = $_POST["tipe_id"];
            $IMEI = $_POST["IMEI"];
            $ada=false;
            foreach ($_SESSION["listbarang"] as $key => $value) {
                if ($IMEI==$value["kode_produksi"]) {
                    $ada=true;
                }
            }
            if ($ada==false) {
                $stmt = $db->prepare("INSERT INTO barang(fk_id_tipe,kode_produksi,status) VALUES(:tipe,:IMEI,1)");
                $sukses = $stmt->execute([
                    ':tipe' => $tipe,
                    ':IMEI' => $IMEI
                ]);
                header("Location: listbarang.php");
            }else{
                echo "<script>alert('IMEI pernah terdaftar! Periksa kembali.')</script>";
            }
        }
        $ses = $_SESSION["nama"];
        $stmt = $db->query("SELECT id_tipe,jenis,model,keterangan,harga,gambar FROM tipe");
        $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <span><button name="btnLog" type="submit" class="btn btn-danger">Logout</button> <button name="btnListBarang" type="submit" class="btn btn-secondary">Back</button>
    </form>
    <hr></center>
    <div class="container" style="margin-left: 40%;">
        <div class="row">
            <div class="col-4">
            <h3>Tambah Barang</h3>
            <form method="POST">
                Tipe :  <select name="tipe_id" id="">
                        <?php
                            if($temp != null){
                                foreach($temp as $key => $value){
                                    ?>
                                    <option value='<?= $value["id_tipe"] ?>'>
                                        <?= $value["jenis"] ?>
                                    </option>
                                <?php
                                }
                            }
                        ?>
                    </select> <br>
                Kode Produksi (IMEI) : <input type="text" name="IMEI" required minlength="5"><br>
                <button name="btnBarang" type="submit" class="btn btn-success">Tambah Barang</button>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>