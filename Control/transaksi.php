<?php
    include("../config/load.php");

    if (isset($_GET["jhari"])) {
        $q = "INSERT INTO transaksi(FK_ID_SUBSCRIPTION,fk_id_user, fk_id_barang, status, total, tanggal_transaksi,start_date, end_date, bukti_bayar)
                    VALUES(
                    :fk_sub, 
                    :fk_user,
                    :fk_barang,
                    :status,
                    :total,
                    :tanggal_transaksi,
                    :start_date,
                    :end_date,
                    :bukti_bayar
                    )";
                $st = $db->prepare($q);
                $start=$_GET["start_date"];
                $ndate = strtotime($start);
                $ndate = strtotime("+".$_GET["jhari"]." day", $ndate);
                $result = $st->execute([
                    "fk_sub" => $_GET["jhari"],
                    "fk_user" =>$_SESSION["id_user"],
                    "fk_barang" => $_SESSION["pinjam"],
                    "status" => 0,
                    "total" => $_SESSION["harga"]*$_GET["jhari"],
                    "tanggal_transaksi" => date("Y/m/d"),
                    "start_date" => $start,
                    "end_date" => date('Y-m-d', $ndate),
                    "bukti_bayar" => NULL
                ]);
        // echo $_SESSION["harga"]*$_GET["jhari"] ."<br>";
        // echo $n."<br>";
        // echo $_SESSION["pinjam"];
        // echo var_dump($result);

        $stmt = $db->prepare("Update barang set status=0 where id_barang=:id_barang");
        $sukses = $stmt->execute([
            ':id_barang' => $_SESSION["pinjam"]
        ]);
        $stmt = $db->query("SELECT * from transaksi where fk_id_barang=$_SESSION[pinjam]");
        $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($temp as $key => $value) {
             $_SESSION["id_trans"]=$value["ID_Trans"];
        }
        header("location:../bayar.php");

    }
?>