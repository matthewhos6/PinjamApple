<?php
    include("config/load.php");
    if (!isset($_SESSION["login"])) {
        header("Location : index.php");
    }
    if (isset($_POST["btn_Logout"])) {
        unset($_SESSION["login"]);
        header("Location: index.php");
    }
    if (isset($_POST["pinjam"])) {
        header("Location: pinjam.php");
        $_SESSION["pinjam"]=$_POST["pinjam"];
        // echo $_POST["pinjam"];
    }
    $stmt = $db->query("SELECT t.id_tipe,t.jenis,t.gambar,t.keterangan,t.harga,(select count(*) from barang b where t.id_tipe = b.fk_id_tipe and b.status=1)  as jml FROM tipe t");
    $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    </style>
</head>
<body>
    <div >
        
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm" id="mainNav">
            <div class="container px-5">
                <a class="navbar-brand fw-bold" href="#page-top">PinjemApple</a>
                <form  method="post">
                    <button type="submit" class="btn btn-danger" name="btn_Logout">
                        Log Out
                    </button>
                    
                </form>
            </div>
        </nav>
    </div><br>
    <div class="search_filter" style="margin: auto;width: 80%;">
            <form action="Control/control.php" method="post" id="formSearch">
                <div class="d-flex">
                    <div class="input-group" style="width: 30%; margin-right: 3px;">
                            <span class="input-group-text" id="basic-addon1">Cari produk</span>
                            <input type="text" class="form-control" placeholder="ex : iphone 13" id="inpSearch">
                    </div>
                    <button id="btnSearch" class="btn btn-primary btn-sm">Search</button>
                </div>
            </form>
    </div>
    <div style="display:flex ;width: 80%;margin: auto;align-items: center;" >
        <div class="row" id="content">
            
            <?php
                if($temp != null){
                    foreach($temp as $key => $value){
                        if ($value["jml"]>=1) {
            
                            ?>
                        <div class="card border border-5" style="width: 18rem; margin-left: 20px; margin-top: 50px;">
                            <img width="300px" height="300px" src="assets/produk/<?=$value["gambar"]?>" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title fw-bold"><?=$value["jenis"]?></h4>
                                <div class="card-text" style="height: 230px;">
                                    <?php
                                    $ket = explode(',',$value["keterangan"]);
                                    ?>
                                    <p><?= $ket[0] ?></p>
                                    <p><?= $ket[1] ?></p>
                                    <p><?= $ket[2] ?></p>
                                    <p><?= $ket[3] ?></p>
                                    <h5 class="fw-bold">Harga : <?= number_format($value["harga"],0, ',', '.')  ?></h5>
                                </div><br>
                                <?php
                                    $stmt = $db->query("select id_barang from barang where fk_id_tipe = $value[id_tipe] and status=1");
                                    $tempe = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($tempe as $keys => $values){
                                    ?>
                                <form method="POST">
                                    <button type="submit" name="pinjam" value="<?=$values["id_barang"]?>" class="btn btn-primary">Pinjam Sekarang</button>
                                </form>
                                <?php
                                break;
                            }
                                ?> 
                            </div>
                        </div>
                        <?php
                     } else{
                         ?>
                        <div class="card border border-5" style="width: 18rem; margin-left: 20px; margin-top: 50px;">
                            <img width="300px" height="300px" src="assets/produk/<?=$value["gambar"]?>" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title fw-bold"><?=$value["jenis"]?></h4>
                                <div class="card-text" style="height: 230px;">
                                    <?php
                                    $ket = explode(',',$value["keterangan"]);
                                    ?>
                                    <p><?= $ket[0] ?></p>
                                    <p><?= $ket[1] ?></p>
                                    <p><?= $ket[2] ?></p>
                                    <p><?= $ket[3] ?></p>
                                    <h5 class="fw-bold">Harga : <?= number_format($value["harga"],0, ',', '.')  ?></h5>
                                </div><br>
                                    <button class="btn btn-danger">Barang sedang tidak tersedia</button>
                            </div>
                        </div>

                     <?php
                    }
                    }
                }
                ?>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(function(){
        $("#formSearch").on('submit',function(e){
            e.preventDefault();
                var nama = $("#inpSearch").val();
                $.get('/PinjamApple/Control/search_device.php?keyword='+nama,function(data){
                    $("#content").html(data);
                });
            });
        });
    </script>
</body>
</html>