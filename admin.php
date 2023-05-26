<?php 
    include("config/load.php");
    if(isset($_SESSION["id"])){
        $temp = "";
        $id_karyawan = $_SESSION["id"];
        if ($_SESSION["jabatan"] == 1) {
            header("Location: tambah.php");
        }
        if(isset($_POST["btnLog"])){
            unset($_SESSION["id"]);
            unset($_SESSION["nama"]);
            unset($_SESSION["jabatan"]);
            unset($_SESSION["filter"]);
            header("Location: adminlog.php");
        }
        if(isset($_POST["btnFilter"])){
            if ($_POST["filter"] == "All") {
                $_SESSION["filter"] = "all";
            }else if ($_POST["filter"] == "Accepted") {
                $_SESSION["filter"] = "accepted";
            }else if ($_POST["filter"] == "Rejected") {
                $_SESSION["filter"] = "rejected";
            }else if ($_POST["filter"] == "Pending") {
                $_SESSION["filter"] = "pending";
            }
        }
        if (isset($_SESSION["filter"])) {
            if ($_SESSION["filter"] == "all") {
                $stmt = $db->query("SELECT t.model,tr.id_trans,tr.tanggal_transaksi,s.nama_subscription,u.nama_user,t.jenis,b.kode_produksi,tr.total,tr.status,k.nama_karyawan,tr.bukti_bayar
                FROM transaksi tr
                LEFT JOIN karyawan k ON tr.FK_ID_KARYAWAN = k.ID_Karyawan
                LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
                LEFT JOIN users u on tr.fk_id_user = u.id_user
                LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
                LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe");
                $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else if ($_SESSION["filter"] == "accepted") {
                $stmt = $db->query("SELECT t.model,tr.id_trans,tr.tanggal_transaksi,s.nama_subscription,u.nama_user,t.jenis,b.kode_produksi,tr.total,tr.status,k.nama_karyawan,tr.bukti_bayar
                FROM transaksi tr
                LEFT JOIN karyawan k ON tr.FK_ID_KARYAWAN = k.ID_Karyawan
                LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
                LEFT JOIN users u on tr.fk_id_user = u.id_user
                LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
                LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe 
                WHERE tr.status = 1");
                $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else if ($_SESSION["filter"] == "rejected") {
                $stmt = $db->query("SELECT t.model,tr.id_trans,tr.tanggal_transaksi,s.nama_subscription,u.nama_user,t.jenis,b.kode_produksi,tr.total,tr.status,k.nama_karyawan,tr.bukti_bayar
                FROM transaksi tr
                LEFT JOIN karyawan k ON tr.FK_ID_KARYAWAN = k.ID_Karyawan
                LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
                LEFT JOIN users u on tr.fk_id_user = u.id_user
                LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
                LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe 
                WHERE tr.status = -1");
                $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else if ($_SESSION["filter"] == "pending") {
                $stmt = $db->query("SELECT t.model,tr.id_trans,tr.tanggal_transaksi,s.nama_subscription,u.nama_user,t.jenis,b.kode_produksi,tr.total,tr.status,k.nama_karyawan,tr.bukti_bayar
                FROM transaksi tr
                LEFT JOIN karyawan k ON tr.FK_ID_KARYAWAN = k.ID_Karyawan
                LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
                LEFT JOIN users u on tr.fk_id_user = u.id_user
                LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
                LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe 
                WHERE tr.status = 0");
                $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }else{
            $_SESSION["filter"] = "all";
            $stmt = $db->query("SELECT t.model,tr.id_trans,tr.tanggal_transaksi,s.nama_subscription,u.nama_user,t.jenis,b.kode_produksi,tr.total,tr.status,k.nama_karyawan,tr.bukti_bayar
            FROM transaksi tr
            LEFT JOIN karyawan k ON tr.FK_ID_KARYAWAN = k.ID_Karyawan
            LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
            LEFT JOIN users u on tr.fk_id_user = u.id_user
            LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
            LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe");
            $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        if(isset($_POST["btnTambah"])){
            header("Location: tambah.php");
        }
        if(isset($_POST["btnRejectTrans"])){
            $id = $_POST["btnRejectTrans"];
            $stmt = $db->prepare("UPDATE `transaksi` SET `FK_ID_KARYAWAN` = :karyawan, `Status` = '-1' WHERE `transaksi`.`ID_Trans` = :id");
            $sukses = $stmt->execute([
                ':id' => $id,
                ':karyawan' => $id_karyawan
            ]);
            $stmt = $db->query("SELECT fk_id_barang from transaksi WHERE ID_Trans = $id");
            $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp as $key => $value) {
                $b=$value["fk_id_barang"];
            }
            $stmt = $db->prepare("UPDATE barang SET status = 1 WHERE id_barang = :id");
            $sukses = $stmt->execute([
                ':id' => $b
            ]);
            header("Location: admin.php");
        }
        if(isset($_POST["btnAcceptTrans"])){
            $id = $_POST["btnAcceptTrans"];
            $stmt = $db->prepare("UPDATE `transaksi` SET `FK_ID_KARYAWAN` = :karyawan, `Status` = '1' WHERE `transaksi`.`ID_Trans` = :id");
            $sukses = $stmt->execute([
                ':id' => $id,
                ':karyawan' => $id_karyawan
            ]);
            header("Location: admin.php");
        }
        $ses = $_SESSION["nama"];
    }else{
        header("Location: adminlog.php");
    }
    //verifikasi transaksi
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
    <center>
    <h1>Welcome, <?= $ses ?></h1>
    <form method="post">
        <span><button name="btnLog" type="submit" class="btn btn-danger">Logout</button> <button name="btnTambah" type="submit" hidden>Tambah Barang</button>
    </form>
    </center>
    <hr>
    <form method="POST">
    <span><h2>Transaksi</h2><input id="filter1" type="radio" id="filter" name="filter" value="All"> Show All<input id="filter2" type="radio" id="filter" name="filter" value="Accepted" style="margin-left: 20px"> Accepted<input id="filter3" type="radio" id="filter" name="filter" value="Rejected" style="margin-left: 20px"> Rejected </span><input id="filter4" type="radio" id="filter" name="filter" value="Pending" style="margin-left: 20px"> Pending </span>
    <br><button name="btnFilter" type="submit" class="btn btn-success">Apply</button></form> <br> <br>
    <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Subscription</th>
                            <th>Nama</th>
                            <th>jenis</th>
                            <th>Barang</th>
                            <th>Kode Produksi (IMEI)</th>
                            <th>Total</th>                  
                            <th>Bukti bayar</th>
                            <th>Action/Status</th>
                        </tr>
                    </thead>
                    <form method="POST">
                    <tbody>
                        <?php
                            if($temp != null){
                                foreach($temp as $key => $value){
                                    if ($value["bukti_bayar"]!=null) {
                                        ?>
                                    <tr>
                                        <td><?= $value["id_trans"] ?></td>
                                        <td><?= $value["tanggal_transaksi"] ?></td>
                                        <td><?= $value["nama_subscription"] ?></td>
                                        <td><?= $value["nama_user"] ?></td>
                                        <td><?= $value["model"] ?></td>
                                        <td><?= $value["jenis"] ?></td>
                                        <td><?= $value["kode_produksi"] ?></td>
                                        <td><?= number_format($value["total"],2,",",".") ?></td>
                                        <td><img src="assets/bukti/<?=$value["bukti_bayar"]?>" style="width: 200px;height: 200px;"></td>
                                        <td><?php if ($value["status"] != 0) {
                                            if ($value["status"] == 1) {
                                                echo "<p style='color: green;'>Accepted</p> By: " .$value["nama_karyawan"];
                                            }else if ($value["status"] == -1) {
                                                echo "<p style='color: red;'>Rejected</p> By: " .$value["nama_karyawan"];
                                            }
                                            
                                            
                                        }else{
                                            ?><button name="btnRejectTrans" value="<?= $value["id_trans"] ?>" type="submit" class="btn btn-danger">Reject</button><button name="btnAcceptTrans" value="<?= $value["id_trans"] ?>" type="submit" class="btn btn-success">Accept</button><?php
                                        }
                                        ?></td>
                                    </tr>
                                    <?php
                                    }
                                        
                                    else{
                                    ?>
                                        <tr>
                                        <td><?= $value["id_trans"] ?></td>
                                        <td><?= $value["tanggal_transaksi"] ?></td>
                                        <td><?= $value["nama_subscription"] ?></td>
                                        <td><?= $value["nama_user"] ?></td>
                                        <td><?= $value["model"] ?></td>
                                        <td><?= $value["jenis"] ?></td>
                                        <td><?= $value["kode_produksi"] ?></td>
                                        <td><?= number_format($value["total"],2,",",".") ?></td>
                                        <td>Customer belum mengirim bukti bayar</td>
                                        <td><?php if ($value["status"] != 0) {
                                            if ($value["status"] == 1) {
                                                echo "<p style='color: green;'>Accepted</p> By: " .$value["nama_karyawan"];
                                            }else if ($value["status"] == -1) {
                                                echo "<p style='color: red;'>Rejected</p> By: " .$value["nama_karyawan"];
                                            }
                                            
                                            
                                        }else{
                                            ?><button name="btnRejectTrans" value="<?= $value["id_trans"] ?>" type="submit" class="btn btn-danger">Reject</button><button name="btnAcceptTrans" value="<?= $value["id_trans"] ?>" type="submit" class="btn btn-success">Accept</button><?php
                                        }
                                        ?></td>
                                    </tr>
                                    <?php    
                                    }
                                }
                            }
                        ?>
                    </tbody>
                    </form>
                </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
<script>
    <?php 
        if ($_SESSION["filter"] == "all") {
            echo 'document.getElementById("filter1").checked = true;';
        }else if ($_SESSION["filter"] == "accepted") {
            echo 'document.getElementById("filter2").checked = true;';
        }else if ($_SESSION["filter"] == "rejected") {
            echo 'document.getElementById("filter3").checked = true;';
        }else if ($_SESSION["filter"] == "pending") {
            echo 'document.getElementById("filter4").checked = true;';
        }
    ?>
</script>
</html>