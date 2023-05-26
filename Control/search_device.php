<?php
    include("../config/load.php");
    $nama = $_GET["keyword"];
            $q = "SELECT id_tipe,jenis,harga,gambar,keterangan
        FROM tipe  
        WHERE jenis LIKE :nama";
        $st = $db->prepare($q);
        $result = $st->execute([
            "nama"=>"%".$nama."%"
        ]);
        $data = $st->fetchAll();
        foreach ($data as $d => $value) {
            $ket = explode(',',$value["keterangan"]);
            echo"
            <div class='card border border-5' style='width: 18rem; margin-left: 20px; margin-top: 50px;'>
                <img width='200px' height='200px' src='assets/produk/".$value["gambar"]."' class='card-img-top'>
                <div class='card-body'>
                    <h4 class='card-title fw-bold'>".$value["jenis"]."</h4>
                    <div class='card-text' style='height: 230px;'>
                        <p>".$ket[0]."</p>
                        <p>".$ket[1]."</p>
                        <p>".$ket[2]."</p>
                        <p>".$ket[3]."</p>
                        <h5 class='fw-bold'>Harga :".number_format($value["harga"],0, ',', '.')."</h5>
                    </div><br>
                    <button type='submit' name='btnDetail' class='btn btn-primary'>Pinjam Sekarang</button>
                </div>
            </div>
            ";
        }
?>