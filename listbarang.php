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
            unset($_SESSION["search"]);
            header("Location: adminlog.php");
        }
        if(isset($_POST["btnSearch"])){
            if ($_POST["cari"] != "") {
                $search = $_POST["cari"];
                $_SESSION["search"] = $search;  
                header("Location: listbarang.php");
            }else{
                unset($_SESSION["search"]);
            }
        }
        if(isset($_POST["btnMaster"])){
            unset($_SESSION["search"]);
            $stmt = $db->query("SELECT b.id_barang,t.jenis,b.kode_produksi, b.status FROM tipe t, barang b WHERE t.id_tipe = b.fk_id_tipe");
            $temp2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION["listbarang"]=$temp2;
            header("Location: tambahBarang.php");
        }
        if(isset($_POST["btnListBarang"])){
            unset($_SESSION["search"]);
            header("Location: listbarang.php");
        }
        if(isset($_POST["btnListTipe"])){
            unset($_SESSION["search"]);
            header("Location: listtipe.php");
        }
        if(isset($_POST["btnchart"])){
            unset($_SESSION["search"]);
            header("Location: chart.php");
        }
        if(isset($_POST["btnDeleteBarang"])){
            $id = $_POST["btnDeleteBarang"];
            $stmt = $db->prepare("DELETE FROM `barang` WHERE ID_Barang = :id");
            $sukses = $stmt->execute([
                ':id' => $id
            ]);
            header("Location: listbarang.php");
        }
        if(isset($_POST["statussatu"])){
            $id = $_POST["statussatu"];
            $stmt = $db->prepare("update barang set status=1 WHERE ID_Barang = :id");
            $sukses = $stmt->execute([
                ':id' => $id
            ]);
            header("Location: listbarang.php");
        }
        if(isset($_POST["statusnol"])){
            $id = $_POST["statusnol"];
            $stmt = $db->prepare("update barang set status=0 WHERE ID_Barang = :id");
            $sukses = $stmt->execute([
                ':id' => $id
            ]);
            header("Location: listbarang.php");
        }
        $ses = $_SESSION["nama"];
    }else{
        header("Location: adminlog.php");
    }
    if (isset($_SESSION["search"])) {
        $a = $_SESSION["search"];
        $stmt = $db->query("SELECT b.id_barang,t.jenis,b.kode_produksi, b.status FROM tipe t, barang b WHERE t.id_tipe = b.fk_id_tipe and t.jenis LIKE '%$a%'");
        $temp2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $stmt = $db->query("SELECT b.id_barang,t.jenis,b.kode_produksi, b.status FROM tipe t, barang b WHERE t.id_tipe = b.fk_id_tipe");
        $temp2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <button name="btnLog" type="submit" class="btn btn-danger">Logout</button> 
    <button name="btnListTipe" type="submit" class="btn btn-secondary">Master Tipe</button> 
    <button name="btnListBarang" type="submit" class="btn btn-primary">Master Barang</button> 
    <button name="btnchart" type="submit" class="btn btn-secondary">Chart Barang</button> 
    <hr></center>
    <br>
    <div class="container">
        Barang :
        <input id="cari" type="text" name="cari" size="50px"> <button name="btnSearch" type="submit" class="btn btn-info">Search</button> <br>
        <button name="btnMaster" type="submit" class="btn btn-success">Tambah Barang</button> <br><br> </form>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Barang</th>
                            <th>Kode Produksi (IMEI)</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <form method="POST">
                    <tbody>
                        <?php
                            if($temp2 != null){
                                foreach($temp2 as $key => $value){
                                    if ($value["status"]==1) {
                                        ?>
                                    <tr>
                                        <td><?= $value["id_barang"] ?></td>
                                        <td><?= $value["jenis"] ?></td>
                                        <td><?= $value["kode_produksi"] ?></td>
                                        <td><button name="btnDeleteBarang" value="<?= $value["id_barang"] ?>" type="submit" class="btn btn-danger">Delete</button></td>
                                        <td>Barang tersedia <button name="statusnol" value="<?= $value["id_barang"] ?>" type="submit" class="btn btn-secondary">Tangguhkan barang?</button></td>
                                    </tr>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <tr>
                                            <td><?= $value["id_barang"] ?></td>
                                            <td><?= $value["jenis"] ?></td>
                                            <td><?= $value["kode_produksi"] ?></td>
                                            <td><button name="btnDeleteBarang" value="<?= $value["id_barang"] ?>" type="submit" class="btn btn-danger">Delete</button></td>
                                            <td>Barang tidak tersedia <button name="statussatu" value="<?= $value["id_barang"] ?>" type="submit" class="btn btn-primary">Barang tersedia?</button></td>
                                            </tr>
                                            <?php
                                    }
                                }
                            }
                        ?>
                    </tbody>
                    </form>
                </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        <?php 
            if (isset($_SESSION["search"])) {
                $a = $_SESSION["search"];
                echo "document.getElementById('cari').value = '$a';";
            }
        ?>
    </script>
</body>
</html>