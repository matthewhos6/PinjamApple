<?php 
    include("config/load.php");
    if(isset($_SESSION["id"])){
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
            unset($_SESSION["search"]);
            header("Location: adminlog.php");
        }
        if(isset($_POST["btnSearch"])){
            if ($_POST["cari"] != "") {
                $search = $_POST["cari"];
                $_SESSION["search"] = $search;  
                header("Location: listkaryawan.php");
            }else{
                unset($_SESSION["search"]);
            }
        }
        if(isset($_POST["btnReport"])){
            unset($_SESSION["search"]);
            header("Location:report.php");
        }
        if(isset($_POST["btnMaster"])){
            unset($_SESSION["search"]);
            header("Location:karyawan.php");
        }
        if(isset($_POST["btnListKaryawan"])){
            unset($_SESSION["search"]);
            header("Location:listkaryawan.php");
        }
        if(isset($_POST["btnTambah"])){
            $nama = $_POST["nama"];
            $nomor = $_POST["noTelp"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $jabatan = $_POST["jabatan"];
            $stmt = $db->query("SELECT * from karyawan where Username_Karyawan = '$username'");
            $temp3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($temp3 != null) {
                echo '<script>alert("username sudah terdaftar!");</script>';
            }else{
                $stmt = $db->query("SELECT * from karyawan where Username_Karyawan = '$username'");
                $temp2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $no = 1;
                foreach($temp as $key => $value){
                    $no += 1;
                }
                $s = str_split($username,2);
                $id = $s[0] . $no;
                $stmt = $db->prepare("INSERT INTO `karyawan`(`ID_Karyawan`, `Nama_Karyawan`, `NomorTelepon_Karyawan`, `Username_Karyawan`, `Password_Karyawan`, `Jabatan`) VALUES (:id,:nama,:no,:username,:password,:jabatan)");
                $sukses = $stmt->execute([
                    ':id' => $id,
                    ':nama' => $nama,
                    ':no' => $nomor,
                    ':username' => $username,
                    ':password' => $password,
                    ':jabatan' => $jabatan
                ]);
                header("Location: karyawan.php");
            }
        }
        $ses = $_SESSION["nama"];
        if (isset($_SESSION["search"])) {
            $a = $_SESSION["search"];
            $stmt = $db->query("SELECT * from karyawan where Nama_Karyawan LIKE '%$a%'");
            $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $stmt = $db->query("SELECT * from karyawan");
            $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
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
    <button name="btnLog" type="submit" class="btn btn-danger">Logout</button> <button name="btnReport" type="submit" class="btn btn-secondary">Report Page</button> <button name="btnListKaryawan" type="submit" class="btn btn-primary">Master Karyawan</button>
    </center>
    <hr>
    <div class="container">
    Nama :
        <input id="cari" type="text" name="cari" size="50px"> <button name="btnSearch" type="submit" class="btn btn-info">Search</button> <br>
        <button name="btnMaster" type="submit" class="btn btn-success">Tambah Karyawan</button> <br><br> </form>
        <div class="row">
            <div>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Jabatan</th>
                        </tr>
                    </thead>
                    <form method="POST">
                    <tbody>
                        <?php
                            if($temp != null){
                                foreach($temp as $key => $value){
                                    ?>
                                    <tr>
                                        <td><?= $value["ID_Karyawan"] ?></td>
                                        <td><?= $value["Nama_Karyawan"] ?></td>
                                        <td><?= $value["NomorTelepon_Karyawan"] ?></td>
                                        <td><?= $value["Username_Karyawan"] ?></td>
                                        <td><?php for ($i=0; $i < strlen($value["Password_Karyawan"]); $i++) { 
                                            echo "*";
                                        }
                                        ?></td>
                                        <td><?php if ($value["Jabatan"] == 0) {
                                            echo "Transaksi";
                                        }else if ($value["Jabatan"] == 1) {
                                            echo "Gudang";
                                        }else if ($value["Jabatan"] == 2) {
                                            echo "Report";
                                        }
                                        ?></td>
                                    </tr>
                                <?php
                                }
                            }
                        ?>
                    </tbody>
                    </form>
                </table>
            </div>
        </div>
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