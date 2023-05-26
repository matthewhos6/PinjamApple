<?php 
    include("config/load.php");
    if(isset($_SESSION["id"])){
        $temp = "";
        $id_karyawan = $_SESSION["id"];
        if ($_SESSION["jabatan"] == 1) {
            header("Location: tambah.php");
        }else if ($_SESSION["jabatan"] == 0) {
            header("Location: admin.php");
        }
        if(isset($_POST["btnLog"])){
            unset($_SESSION["id"]);
            unset($_SESSION["nama"]);
            unset($_SESSION["jabatan"]);
            unset($_SESSION["filter"]);
            unset($_SESSION["dateAwal"]);
            unset($_SESSION["dateAkhir"]);
            header("Location: adminlog.php");
        }
        if(isset($_POST["btnReport"])){
            header("Location:report.php");
        }
        if(isset($_POST["btnKaryawan"])){
            header("Location:karyawan.php");
        }
        if(isset($_POST["btnListKaryawan"])){
            header("Location:listkaryawan.php");
        }
        if(isset($_POST["btnFilter"])){
            if ($_POST["filter"] == "1") {
                $_SESSION["filter"] = "1";
            }else if ($_POST["filter"] == "2") {
                $_SESSION["filter"] = "2";
            }else if ($_POST["filter"] == "3") {
                $_SESSION["filter"] = "3";
            }if ($_POST["dateAwal"] == null || $_POST["dateAkhir"] == null) {
                unset($_SESSION["dateAwal"]);
                unset($_SESSION["dateAkhir"]);
            }else if ($_POST["dateAwal"] != null && $_POST["dateAkhir"] != null) {
                if ($_POST["dateAwal"] > $_POST["dateAkhir"]) {
                    echo '<script>alert("Tanggal awal tidak boleh lebih kecil dari tanggal akhir!");</script>';
                }else{
                    $_SESSION["dateAwal"] = $_POST["dateAwal"];
                    $_SESSION["dateAkhir"] = $_POST["dateAkhir"];
                }
            }
        }
        if (isset($_SESSION["filter"])) {
            if ($_SESSION["filter"] == "1") {
                if (isset($_SESSION["dateAwal"])) {
                    $awal = $_SESSION['dateAwal'];
                    $akhir = $_SESSION['dateAkhir'];
                    $stmt = $db->query("SELECT t.model,tr.id_trans,tr.tanggal_transaksi,s.nama_subscription,u.nama_user,t.jenis,b.kode_produksi,tr.total,tr.status,k.nama_karyawan
                    FROM transaksi tr
                    LEFT JOIN karyawan k ON tr.FK_ID_KARYAWAN = k.ID_Karyawan
                    LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
                    LEFT JOIN users u on tr.fk_id_user = u.id_user
                    LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
                    LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe 
                    WHERE tr.status = 1 AND tr.Tanggal_transaksi >= '$awal' AND tr.Tanggal_transaksi <= '$akhir'");
                    $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }else{
                    $stmt = $db->query("SELECT t.model,tr.id_trans,tr.tanggal_transaksi,s.nama_subscription,u.nama_user,t.jenis,b.kode_produksi,tr.total,tr.status,k.nama_karyawan
                    FROM transaksi tr
                    LEFT JOIN karyawan k ON tr.FK_ID_KARYAWAN = k.ID_Karyawan
                    LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
                    LEFT JOIN users u on tr.fk_id_user = u.id_user
                    LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
                    LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe 
                    WHERE tr.status = 1");
                    $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if ($_SESSION["filter"] == "2") {
                    $stmt = $db->query("SELECT t.model,tr.start_date,tr.end_date,s.nama_subscription,u.nama_user,t.jenis,b.kode_produksi,tr.status,k.nama_karyawan
                    FROM transaksi tr
                    LEFT JOIN karyawan k ON tr.FK_ID_KARYAWAN = k.ID_Karyawan
                    LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
                    LEFT JOIN users u on tr.fk_id_user = u.id_user
                    LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
                    LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe 
                    WHERE tr.status = 1 AND tr.end_date > '".date("Y-m-d")."'");
                    $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else if ($_SESSION["filter"] == "3") {
                if (isset($_SESSION["dateAwal"])) {
                    $awal = $_SESSION['dateAwal'];
                    $akhir = $_SESSION['dateAkhir'];
                    $stmt = $db->query("SELECT t.model,sum(s.ID_Subscription),t.jenis,b.kode_produksi
                    FROM transaksi tr
                    LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
                    LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
                    LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe 
                    WHERE tr.status = 1 AND tr.Tanggal_transaksi >= '$awal' AND tr.Tanggal_transaksi <= '$akhir' GROUP BY b.kode_produksi");
                    $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }else{
                    $stmt = $db->query("SELECT t.model,sum(s.ID_Subscription),t.jenis,b.kode_produksi
                    FROM transaksi tr
                    LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
                    LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
                    LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe 
                    WHERE tr.status = 1 GROUP BY b.kode_produksi");
                    $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        }else{
            $_SESSION["filter"] = "1";
            $stmt = $db->query("SELECT t.model,tr.id_trans,tr.tanggal_transaksi,s.nama_subscription,u.nama_user,t.jenis,b.kode_produksi,tr.total,tr.status,k.nama_karyawan
            FROM transaksi tr
            LEFT JOIN karyawan k ON tr.FK_ID_KARYAWAN = k.ID_Karyawan
            LEFT JOIN subscription s on tr.fk_id_subscription = s.id_subscription
            LEFT JOIN users u on tr.fk_id_user = u.id_user
            LEFT JOIN barang b on tr.fk_id_barang = b.id_barang
            LEFT JOIN tipe t on b.fk_id_tipe = t.id_tipe 
            WHERE tr.status = 1");
            $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header("Location: report.php");
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
    <title>Report Page</title>
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
        <button name="btnLog" type="submit" class="btn btn-danger">Logout</button> <button name="btnReport" type="submit" class="btn btn-primary">Report Page</button> <button name="btnListKaryawan" type="submit" class="btn btn-secondary">Master Karyawan</button>
    </form>
    </center>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <form method="POST">
                <span><h2 id="titel">Report </h2><input id="filter1" type="radio" id="filter" name="filter" value="1"> Borrowed Items Report<input id="filter2" type="radio" id="filter" name="filter" value="2" style="margin-left: 20px"> Borrowed Items Currently<input id="filter3" type="radio" id="filter" name="filter" value="3" style="margin-left: 20px"> Most ordered Items </span>
                <br><span id="opt"> From : <input id="date" type="date" name="dateAwal" id="dateAwal" style="margin-right: 20px;"> To : <input id="date1" type="date" name="dateAkhir" id="dateAkhir">  <span style="color:red;margin-left:20px"> <button id="btnReset" onclick="resetDate()" class="btn btn-warning">Reset Date</button></span> </span>
                <br><button name="btnFilter" type="submit" class="btn btn-success">Apply</button></form> <br> <br>
            </div>
            <div class="col-5">
                <br>
                <h3><?php if ($temp != null) {
                    $total = 0;
                    if ($_SESSION["filter"] == "1") {
                        foreach($temp as $key => $value){
                            $total += $value["total"];
                        }
                        echo "Total Pendapatan : Rp ". number_format("$total",2,",",".");
                    }
                }?></h3>
            </div>
        </div>
        <div class="row">
    <table style="width:100%;">
                    <thead>
                        <tr>
                            <?php if ($_SESSION["filter"] == "1") {
                                echo '<th>ID</th>
                                <th>Tanggal</th>
                                <th>Subscription</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Barang</th>
                                <th>Kode Produksi (IMEI)</th>
                                <th>Total</th>                  
                                <th>Action/Status</th>';
                            }else if ($_SESSION["filter"] == "2") {
                                echo '<th>No.</th><th>Start Date</th><th>Jangka Waktu</th><th>End Date</th><th>Customer</th><th>Jenis</th><th>Barang</th><th>IMEI</th><th>Status</th>';
                            }else if ($_SESSION["filter"] == "3") {
                                echo '<th>Tipe</th><th>Barang</th><th>IMEI</th><th>Jumlah Hari Di Pinjam</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <form method="POST">
                    <tbody>
                        <?php
                            if($temp != null){
                                $nomor = 0;
                                foreach($temp as $key => $value){
                                    $nomor += 1;
                                    if ($_SESSION["filter"] == "1") {
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
                                    }else if ($_SESSION["filter"] == "2") {
                                    ?>
                                    <tr>
                                        <td><?= $nomor?></td>
                                        <td><?= $value["start_date"]?></td>
                                        <td><?= $value["nama_subscription"] ?></td>
                                        <td><?= $value["end_date"]?></td>
                                        <td><?= $value["nama_user"] ?></td>
                                        <td><?= $value["model"] ?></td>
                                        <td><?= $value["jenis"] ?></td>
                                        <td><?= $value["kode_produksi"] ?></td>
                                        <td><?php if ($value["end_date"] > date("Y-m-d")) {
                                            echo "'<p style='color:red;'>Masih Di Pinjam</p>'";
                                        }else{
                                            echo "'<p style='color:green;'>Sudah Di Kembalikan</p>'";
                                        }
                                        ?>
                                        </td>

                                    </tr>
                                <?php    
                                    }else if ($_SESSION["filter"] == "3") {
                                    ?>
                                    <tr>
                                        <td><?= $value["model"] ?></td>
                                        <td><?= $value["jenis"] ?></td>
                                        <td><?= $value["kode_produksi"] ?></td>
                                        <td><?= $value["sum(s.ID_Subscription)"] ?></td>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
<script>
    <?php 
        if ($_SESSION["filter"] == "1") {
            echo 'document.getElementById("filter1").checked = true; document.getElementById("titel").innerText = "Borrowed Items Report";';
            if (isset($_SESSION["dateAwal"])) {
                echo 'document.getElementById("titel").innerText += " ('.$_SESSION["dateAwal"].' / '.$_SESSION["dateAkhir"].')";';
                echo 'document.getElementById("date").value = "'.$_SESSION["dateAwal"].'";';
                echo 'document.getElementById("date1").value = "'.$_SESSION["dateAkhir"].'";';
            }
        }else if ($_SESSION["filter"] == "2") {
            echo 'document.getElementById("filter2").checked = true; document.getElementById("titel").innerText = "Borrowed Items";';
            echo 'document.getElementById("opt").hidden = true;';
        }else if ($_SESSION["filter"] == "3") {
            echo 'document.getElementById("filter3").checked = true; document.getElementById("titel").innerText = "Most ordered Items";';
            if (isset($_SESSION["dateAwal"])) {
                echo 'document.getElementById("titel").innerText += " ('.$_SESSION["dateAwal"].' / '.$_SESSION["dateAkhir"].')";';
                echo 'document.getElementById("date").value = "'.$_SESSION["dateAwal"].'";';
                echo 'document.getElementById("date1").value = "'.$_SESSION["dateAkhir"].'";';
            }
        }
    ?>
    function resetDate(){
        document.getElementById("date").value = null;
        document.getElementById("date1").value = null;
        <?php 
            unset($_SESSION["dateAwal"]);
            unset($_SESSION["dateAkhir"]);
        ?>
    }
</script>
</html>