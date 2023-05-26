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
            header("Location: adminlog.php");
        }
        if(isset($_POST["btnListKaryawan"])){
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
                header("Location: listkaryawan.php");
            }
        }
        $ses = $_SESSION["nama"];
        $stmt = $db->query("SELECT * from karyawan");
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
    <button name="btnLog" type="submit" class="btn btn-danger">Logout</button> <button name="btnListKaryawan" type="submit" class="btn btn-secondary">Back</button>
    </form>
    </center>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-4" style="margin-left: 41%;">
                <form method="POST">
                <span><h2 id="titel">Add Karyawan </h2>
                Nama : <input type="text" name="nama" required minlength="3"><br>
                Nomor Telepon : <input type="number" name="noTelp" required minlength="10"><br>
                Username : <input type="text" name="username" required minlength="3"><br>
                Password : <input type="password" name="password" required minlength="5"><br>
                Jabatan : <select name="jabatan" id="">
                            <option value='0'>Transaksi</option>
                            <option value='1'>Gudang</option>
                            <option value='2'>Report</option>
                        </select><br>
                <br>
                <button name="btnTambah" type="submit" class="btn btn-success">Tambah Karyawan</button>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>