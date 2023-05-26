<?php
    include("../config/load.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    
    function kirimemail($emailtujuan,$namapenerima){
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'pinjamApple@outlook.co.id';                     //SMTP username
            $mail->Password   = 'Abcdefg1#';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
            //Recipients
            $mail->setFrom('pinjamApple@outlook.co.id', 'Letter from PinjemApple');
            $mail->addAddress($emailtujuan, $namapenerima);     
    
            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $isi = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Document</title>
                <style>
                    button{
                        width: 30%;
                        height: 80px;
                        font-size: xx-large ;
                        text-transform: uppercase;
                    }
                </style>
            </head>
            <body>
                <div class='container' style='width: 50%; margin: auto; text-align: center; background-color: whitesmoke;'>
                    <h1 style='font-size: 50px;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif'>Dear,".$namapenerima." </h1>
                    <h4 style='font-size: 20px;  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:lighter ;'>
                        Terima Kasih telah bergabung bersama kami , Sekarang hanya tinggal 1 langkah lagi untuk menyelesaikan proses Registrasi anda <br>
                        Silahkan klik button dibawah ini untuk verifikasi email anda
                    </h4>
                    <a href='http://localhost/PinjamApple/Control/verify_email.php?email=".$emailtujuan."'>
                        <button> click here</button>
                    </a>  
                </div>
            </body>
            </html>
            ";
            $mail->Body= $isi;
            $mail->send();
            echo 'Silahkan cek email anda untuk keperluan verifikasi';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    if ($_POST["action"] == "reg") {

        $username = $_POST["username"];
        $nama = $_POST["nama"];
        $Email = $_POST["Email"];
        $Telepon = $_POST["Telepon"];
        $pass = $_POST["pass"];
        $confirm = $_POST["confirm"];
        $nik = $_POST["nik"];
    
        if(strlen($username) < 3){
            echo "Username harus terdiri dari 3 character atau lebih";
        }else if(strlen($Telepon) < 10){
            echo "nomor telepon harus terdiri dari 10 angka atau lebih";
        }else if(strlen($nik) != 16){
            echo "NIK Tidak valid";
        }else if ($pass != $confirm) {
            echo "password dan confirm tidak sama";
        }
        else{
            $q = "SELECT * FROM users WHERE username_user = :username or Email_user = :email";
            $st = $db->prepare($q);
            $result = $st->execute([
                "username"=> $username,
                "email" => $Email
            ]);
            $data = $st->fetchAll();
            if (empty($data)) {                
                $s = str_split($username,2);
                $id = $s[0] . $nik;

                $q = "INSERT INTO users()
                    VALUES(
                    :id,    
                    :nama, 
                    :nik,
                    :telepon,
                    :username,
                    :password,
                    :email,
                    0,
                    0
                    )";
                unset($_POST["btnRegister"]);
                $st = $db->prepare($q);
                
                $result = $st->execute([
                    "id" => $id,
                    "nama" => $nama,
                    "telepon" => $Telepon,
                    "username" => $username,
                    "password" => password_hash($pass,PASSWORD_DEFAULT),
                    "email" => $Email,
                    "nik" => $nik
                ]);

                kirimemail($Email,$nama);
                echo"<script>
                $('#formReg').trigger('reset');
               </script>
               ";
                

            }else{
                echo "Username/Email sudah terdaftar";
            }
        }
    }else if ($_POST["action"] == "log"){
        $id = $_POST["id"];
        $pass = $_POST["pass"];

        $q = "SELECT * FROM users WHERE username_user = :username or Email_user = :email";
        $st = $db->prepare($q);
        $result = $st->execute([
            "username"=> $id,
            "email"=> $id
        ]);
        $data = $st->fetchAll();
        if($id == "" || $pass == ""){
            echo "Semua field harus terisi";
        }else if ($id == "admin" && $pass == "admin") {
            echo "<script>
            location.href = 'admin.php';
            </script>";
        }else if (empty($data)) {
            echo "Username belom terdaftar";
        }else{
            foreach ($data as $d => $value) {
                if(password_verify($pass,$value["Password_User"])){
                    if ($value["is_verified"] == 1) {
                        echo "<script>
                        location.href = 'user.php';
                        </script>";
                        $_SESSION["login"] = true;
                        $_SESSION["id_user"] = $value["ID_User"];
                    }else{
                        echo "Email belum ter-verifikasi";
                    }
                }
                else{
                    echo "Password Salah";
                }
            }
        }
    }

?>
