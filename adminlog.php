<?php 
    include("config/load.php");
    $msg = "";

    if(isset($_POST["balik"])){
        header("location:index.php");
    }
    if(isset($_POST["btnLogin"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        if($username=="" || $password==""){
            $msg = "Ada field kosong";
        }
        else{
            $q = "SELECT * FROM karyawan WHERE username_karyawan = :username";
            $st = $db->prepare($q);
            $result = $st->execute([
                "username"=> $username
            ]);
            $data = $st->fetchAll();
            if (empty($data)) {
                $msg = "Username belum terdaftar";
            }else{
                foreach ($data as $d => $value) {
                    $id = $value["ID_Karyawan"];
                    $nama = $value["Nama_Karyawan"];
                    if($password == $value["Password_Karyawan"]){
                        $_SESSION["id"] = $id;
                        $_SESSION["nama"] = $nama;
                        $_SESSION["jabatan"] = $value["Jabatan"];
                        if ($value["Jabatan"] == 0) {
                            header("Location: admin.php");
                        }else if ($value["Jabatan"] == 1){
                            header("Location: listtipe.php");
                        }else if ($value["Jabatan"] == 2) {
                            header("Location: report.php");
                        }
                    }
                    else{
                        $msg = "Password Salah";
                    }
                }
            }
        }
    }
    //Admin login page
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>AdminLogin</title>
  </head>
  <body style="background-color: #0089DD;">
  <form method="POST">
      <button style="margin-left: 1%;margin-top: 1%;" name="balik" type="submit" class="btn btn-danger">Kembali ke Home</button>
  </form>
  <form method="post">
    <center><div style="margin-top: 130px;width: 500px;height: 370px;background-color: white;border-radius: 3px">
        <br><h1 style="text-align: center;">ADMINISTRATOR</h1><br>
        <div style="text-align: left;margin-left: 20px;">Username</div>
        <input style="width: 93%;" type="text" name="username">
        <br><br>
        <div style="text-align: left;margin-left: 20px;">Password</div>
        <input style="width: 93%;" type="password" name="password">
        <br><br><br>
        <div style="color: red;"><?= $msg?></div>
        <button style="width: 93%;" name="btnLogin" type="submit" class="btn btn-primary">Login</button>

    </div></center>
  </form>
  <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>