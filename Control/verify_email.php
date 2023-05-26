<?php
include("../config/load.php");

$q = "UPDATE users SET is_verified = 1 WHERE email_user = :email";
$st = $db->prepare($q);
$result = $st->execute([
"email" => $_GET["email"],
]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            margin: auto;
            width: 50%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: larger;
            border: 2px black Solid;
            border-radius: 25px;
            text-align: center;
        }
    </style>
</head>
<body style="background-color: whitesmoke;">
<br>
    <div class="container">
        <h1 >Email anda sudah Terverifikasi</h1>
        <h3>Anda akan diarahkan ke homepage dalam 5 detik</h3>
    </div>
</body>
<script>
    setTimeout(redir,5000);
    function redir(){
        window.location.replace("/pinjamapple/index.php");
    }
</script>
</html>