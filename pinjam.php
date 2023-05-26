<?php
    include("config/load.php");
    $stmt = $db->query("SELECT t.id_tipe,t.jenis,t.gambar,t.keterangan,t.harga 
    FROM tipe t, barang b 
    where b.id_barang=$_SESSION[pinjam]
    and b.fk_id_tipe = t.id_tipe");
    $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $db->query("SELECT ID_subscription, nama_subscription FROM subscription");
    $temp2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["dipilih"]=$temp;

    if (isset($_POST["balik"])) {
        header("Location: user.php");
    }
    if (isset($_POST["btn_Logout"])) {
        unset($_SESSION["login"]);
        header("Location: index.php");
    }
    // order page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Lato">
    <style>
        input[type="date"]{
            padding: 15px;
            font-family: 'Lato',serif;
            border-radius: 25px;
            border: 2px solid black;
        }
    </style>
</head>
<body>

    <div>        
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
    <div class="container">
        <form  method="post">
            <button type="submit" class="btn btn-warning" name="balik">
                < Kembali
            </button>
        </form>
        <br>
        <div class="row" style="display:flex; margin: auto; width: 90%;" >
            
            <?php
                    foreach($temp as $key => $value){
                        ?>
                            <div class="card border border-5 rounded" style="width: 30%; margin-left: 10%;">
                                <h3 class="fs-1 fw-bold" style="font-family: Lato;">
                                    <?= $value["jenis"] ?>
                                </h3>
                                <img width="300px" height="300px" src="assets/produk/<?=$value["gambar"]?>">
                                <div class="card-text" style="margin-top: 20px;">
                                    <?php
                                    $ket = explode(',',$value["keterangan"]);
                                    foreach ($ket as $key => $value) {
                                        $a=explode(":",$value)
                                        ?>
                                        
                                        <p class="fs-4" style="font-weight:lighter;"><span style="font-weight: bold;"><?= $a[0] ?> :</span>
                                            <?= $a[1] ?></p>
                                        <?php
                                    }
                                    
                                    ?>
                                </div>  
                            </div>
                        <?php
                    }
                    ?>
            <?php
                foreach($temp as $key => $value){
                    $harga=$value["harga"];
                    $_SESSION["harga"]=$harga;
                    ?>                            
                        <div class="card border border-5" style="height: fit-content;margin-left: 5px; width: fit-content ;padding: 20px;">
                            <form method="GET" action="control/transaksi.php">
                                <p style="font-size: 25px;"> <span style="font-weight: bold; font-size: 30px;">Harga(Per Hari) : </span>Rp <?= number_format($value["harga"],0, ',', '.')  ?>,00</p>
                                <p style="font-size: 20px;"> <b>Pilih Paket :</b> </p>
                                <!-- <select name="jhari" id="jhari" style="width: 150px;"> -->
                                    <!-- <option value="0">Silahkan memilih</option> -->
                                    <?php
                                        foreach ($temp2 as $keys => $value1) {
                                            ?>
                                        <div class="form-check form-check-inline">
                                        <!-- <option value=""><?=$value1["nama_subscription"]?></option> -->
                                        
                                        <input class="form-check-input jhari<?=$value1["ID_subscription"]?>" type="radio" name="jhari"  value="<?=$value1["ID_subscription"]?>" >
                                        <label class="form-check-label" for="exampleRadios1">
                                        <?=$value1["nama_subscription"]?>
                                        </label>
                                        </div>
                                        
                                        <?php
                                }
                                ?>
                                <!-- </select>  -->
                                <br><br>
                                <p style="font-size: 20px;"><b>Tentukan Tanggal Pengambilan :</b></p>
                                <input type="date" name="start_date">
                                <p style="margin-top: 10px;"> <span style="font-weight: bold; font-size: 25px;">Total : </span><span id="total">0</span></p>
                                <button type="submit" style="width: 100%;" class="btn btn-primary">Confirm</button>
                            </form>
                        </div>
                    <?php
                }
                ?>
        </div>
    <script>
        $(document).ready(function(){
            $(".jhari3").click(function(){
                var harga=parseInt("<?php echo $harga; ?>");
                $("#total").text(3 * harga);
            });
            $(".jhari7").click(function(){
                var harga=parseInt("<?php echo $harga; ?>");
                $("#total").text(7 * harga);
            });
            $(".jhari14").click(function(){
                var harga=parseInt("<?php echo $harga; ?>");
                $("#total").text(14 * harga);
            });
        }); 
        </script>
</body>
</html>