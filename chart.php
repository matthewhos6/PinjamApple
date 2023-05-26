<?php
    include("config/load.php");

    if(isset($_POST["btnchart"])){
        header("Location: chart.php");
    }
    if(isset($_POST["btnListBarang"])){
        header("Location: listbarang.php");
    }
    if(isset($_POST["btnListTipe"])){
        header("Location: listtipe.php");
    }
    $jumlah = 0;
    $ses = $_SESSION["nama"];
    $stmt = $db->query("SELECT t.model, (COUNT(b.id_barang)) as jml FROM tipe t,barang b WHERE b.fk_id_tipe = t.id_tipe GROUP BY t.model");
    $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($temp != null){
      foreach($temp as $key => $value){
        $jumlah +=1;}
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<center><h1>Welcome, <?= $ses ?></h1>
    <form method="post">
    <button name="btnLog" type="submit" class="btn btn-danger">Logout</button> 
    <button name="btnListTipe" type="submit" class="btn btn-secondary">Master Tipe</button> 
    <button name="btnListBarang" type="submit" class="btn btn-secondary">Master Barang</button> 
    <button name="btnchart" type="submit" class="btn btn-primary">Chart Barang</button> 
    <hr>

<div style="width: 500px; height: 500px;">
<h3>Jumlah Barang Berdasarkan Jenis</h3><canvas id="myChart"></canvas>
</div></center>
  
    
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  
  const data = {
  labels: [
  <?php 
  $as = 0;
    if($temp != null){
      foreach($temp as $key => $value){
        $as += 1;
        if ($as == $jumlah) {
          echo '"'.$value["model"].'"';
        }else{
          echo '"'.$value["model"].'",';
        }    
      }
    }
  ?>
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [
        <?php 
    $as = 0;
    if($temp != null){
      foreach($temp as $key => $value){
        $as += 1;
        if ($as == $jumlah) {
          echo '"'.$value["jml"].'"';    
        }else{
          echo '"'.$value["jml"].'",';    
        }      
      }
    }
  ?>
     ],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(0, 255, 86)',
      'rgb(231, 120, 76)'
    ],
    hoverOffset: 4
  }]
};

  const config = {
    type: 'doughnut',
    data: data,
    options: {}
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

</html>