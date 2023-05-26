<?php

session_start();
//User Page





?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>New Age - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
            <div class="container px-5">
                <a class="navbar-brand fw-bold" href="#page-top">PinjemApple</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                        <li class="nav-item"><a class="nav-link me-lg-3" href="#features">Tentang Kami</a></li>
                    </ul>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Pinjam Sekarang
                    </button>
                </div>
            </div>
        </nav>
        <!-- Mashead header-->
        <header class="masthead">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <!-- Mashead text and app badges-->
                        <div class="mb-5 mb-lg-0 text-center text-lg-start">
                            <h1 class="display-1 lh-1 mb-3">Semua Orang Bisa Menikmati</h1>
                            <p class="lead fw-normal text-muted mb-5">Bawa pulang iPhone keluaran terbaru hanya dengan seharga sepiring nasi goreng</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="masthead-device-mockup">
                            <div class="device-wrapper">
                                    <img src="assets/img/ip-13.png" alt="" width="500px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Quote/testimonial aside-->
        <aside class="text-center bg-gradient-primary-to-secondary">
            <div class="container px-5" >
                <div class="row gx-5 justify-content-center">
                    <div class="col-xl-13" >
                        <!-- <div class="h2 fs-1 text-white mb-4">"Dengan adanya PinjemApple, Nikmati gadget canggih dengan harga bersahabat!"</div>
                        <img src="assets/img/tnw-plogo.png" alt="..." style="height: 3rem" /> -->
                        <div class="row">
                            <div class="card border border-5" style="width: 18rem; height: 25rem; margin-right:5px;">
                                <img src="assets/img/home_iphone.png" class="card-img-top" width="350px" height="350px">
                                <div class="card-body">
                                    <h3 class="card-title">Iphone Series</h3>
                                </div>
                            </div><br>
                            <div class="card border border-5" style="width: 18rem;  height: 25rem; margin-right:5px;">
                                <img src="assets/img/home_ipad.png" class="card-img-top" width="350px" height="350px">
                                <div class="card-body">
                                    <h3 class="card-title">Ipad Series</h3>
                                </div>
                            </div> <br>
                            <div class="card border border-5" style="width: 18rem;  height: 25rem; margin-right:5px;">
                                <img src="assets/img/home_macbook.png" class="card-img-top" width="100px" style="margin-top: 100px;">
                                
                                <div class="card-body " style="margin-top: 55px;">
                                    <h3 class="card-title">Macbook Series</h3>
                                </div>
                            </div> <br>
                            <div class="card border border-5" style="width: 18rem;  height: 25rem;">
                                <img src="assets/img/home_watch.png" class="card-img-top"  >
                                <div class="card-body">
                                    <h3 class="card-title">Watch Series</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- App features section-->
        <section id="features">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
                        <div class="container-fluid px-5">
                            <div class="row gx-5">
                                <div class="col-md-6 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-phone icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">iPhone Terbaru</h3>
                                        <p class="text-muted mb-0">PinjamApple selalu memperbarui device kami agar tidak ketinggalan jaman!</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-camera icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Device Lain</h3>
                                        <p class="text-muted mb-0">PinjamApple juga menyediakan device lain seperti Camera, dll</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-5 mb-md-0">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-gift icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Banyak Bonus</h3>
                                        <p class="text-muted mb-0">Dapatkan berbagai bonus dan hadiah bagi pelanggan setia kami!</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Terasuransi</h3>
                                        <p class="text-muted mb-0">Semua device kami sudah diproteksi dengan asuransi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-14 order-lg-0" >
                            <img src="assets/img/mockup.png" alt="" width="100%" height="100%">
                    </div>
                </div>
            </div>

        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills justify-content-center">
                        <li class="nav-item">
                          <a class="nav-link active" id="btnPageLogin" type="button">Login</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="btnPageRegister" type="button">Register</a>
                        </li>
                    </ul>
                    <br>
                    <div>
                        <div id="PageLogin" >
                            <form action="Control/control.php" method="post" id="formLogin">
                                Username
                                <input type="text" class="form-control" placeholder="Username / Email" id="inpLoginid"><br>
                                Password
                                <input type="password" class="form-control" placeholder="Password" id="inpLoginPass"><br>
                                <div style="text-align: center;">
                                    <button type="submit" class="btn btn-warning" style="width: 70%;" name="btnLogin">Login</button>
                                </div>
                                <br>
                                <p style="color: red;" id="msgL"></p>
                            </form>
                        </div>
                        <div id="PageRegister">
                            <form action="Control/control.php" method="post" id="formReg">
                                Email
                                <input type="email" class="form-control" placeholder="Ex : j@gmail.com" id="inpRegEmail" name="inpRegEmail" required><br>
                                Username
                                <input type="text" class="form-control" placeholder="Ex : Username" id="inpRegUsername" name="inpRegUsername" required><br>
                                Nama
                                <input type="text" class="form-control" placeholder="Ex : Andrew" id="inpRegNama" name="inpRegNama" required><br>
                                NIK
                                <input type="text" class="form-control" placeholder="NIK" id="inpRegNIK" name="inpRegNIK" required><br>
                                Nomor Telepon 
                                <input type="text" class="form-control" placeholder="Ex :" id="inpRegTelepon" name="inpRegTelepon" required><br>
                                Password
                                <input type="password" class="form-control" placeholder="Password" id="inpRegPass" name="inpRegPass" required ><br>
                                Confirm
                                <input type="password" class="form-control" placeholder="Confirm Password" id="inpRegConfirm" name="inpRegConfirm" required><br>
                                <div style="text-align: center;">
                                    <button type="submit" class="btn btn-warning" style="width: 70%;" name="btnRegister">Register</button>
                                </div>
                            </form>
                            <br>
                            <p style="color: red;" id="msgR"></p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
  
        </section>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script>
            $(function(){
                $("#PageRegister").hide();
                $("#btnPageLogin").on('click',function(){
                    $("#btnPageLogin").attr('class','nav-link active');
                    $("#btnPageRegister").attr('class','nav-link');
                    $("#PageLogin").show();
                    $("#PageRegister").hide();
                });
                $("#btnPageRegister").on('click',function(){
                    $("#btnPageRegister").attr('class','nav-link active');
                    $("#btnPageLogin").attr('class','nav-link');
                    $("#PageRegister").show();
                    $("#PageLogin").hide();
                });

                $("#formReg").on('submit',function(e){
                    e.preventDefault();
                    var username = $("#inpRegUsername").val();
                    var nama = $("#inpRegNama").val();
                    var Email = $("#inpRegEmail").val();
                    var Telepon = $("#inpRegTelepon").val();
                    var pass = $("#inpRegPass").val();
                    var confirm = $("#inpRegConfirm").val();
                    var nik = $("#inpRegNIK").val();

                    $("#msgR").load("Control/control.php",{
                        username : username,
                        nama : nama,
                        Email : Email,
                        Telepon : Telepon,
                        pass : pass,
                        confirm : confirm,
                        nik : nik,
                        action : "reg"
                    });
                });
                $("#formLogin").on('submit',function(e){
                    e.preventDefault();
                    let id = $("#inpLoginid").val();
                    let pass = $("#inpLoginPass").val();

                    $("#msgL").load("Control/control.php",{
                        id : id,
                        pass : pass,
                        action : "log"
                    });
                });
                
            });
        </script>

    </body>
</html>
