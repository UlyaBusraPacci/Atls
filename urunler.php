<?php 
   include("urunlerF.php");

   ob_start();
   session_start(); 

if($_SESSION["giris"]!=true){
   header("Location: panel.php");
}


?>
 
 <?php

@$cikis=$_GET["out"];

switch($cikis){
    case("outOfPage"):
        islemler2::outOfPage($db);
    break;

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE4ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="urunler.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>USER </title>
</head>

<body>




<?php
@$nee=$_GET["isi"];

switch ($nee){
    case ("urunEkle"):
        islemler2::urunEkle($db);
    break;

    case ("urunGuncelle"):
        islemler2::urunGuncelle($db);
    break;

    case ("urunSil"):
        islemler2::urunSil($db);
    break;
}
?>

<!-- SABİTTTTTTT-------------------------------------------- -->
<br><br>
<div class="headerBody1">
<div class="baslik">
<a href="welcomeToPanel.php"><img src="pac.avif" alt=""></a>
   

    <div class="links">
        <ul class="linksR">
            <li class="lis"><img src="pizzaAA.svg" alt=""><a href="menu.php" class="heck">MENÜ</a></li><br><br> 
            <li><img src="pizzaAA.svg" alt=""><a href="proof.php" class="heck">ADMİN EKLEMEK </a></li>
            <li><img src="pizzaAA.svg" alt=""><a href="urunler.php" class="heck">ÜRÜNLER </a></li>
            
        </ul><!--links biti -->
      
    </div>
    <div>
        <a href="welcomeToPanel.php?out=outOfPage" class="btn btn-success">ÇIKIŞ</a>
    </div>
    </div><br><br><br><br><br>
</div>


<!-- SABİTTTTTT------------------------------------------------ -->


        <form action="urunler.php?is=urunEkle" method="post" >
            <table class="table table-bordered table-striped text-center bg-white">
                <thead>
            
                <tr>
                    <th class="font-weight-bold">ÜRÜN ADI</th>
                    <th class="font-weight-bold">ÜRÜN  FİYATI</th>
                    <th class="font-weight-bold">ÜRÜN KODU</th>
                    <th class="font-weight-bold">ÜRÜN AÇIKLAMASI</th>
                    <th class="font-weight-bold">ÜRÜN RESMİ ADRESİ</th>
                    <th class="font-weight-bold">ÜRÜN RESMİ</th>
                    <th><a href="urunler.php?isi=urunEkle" class="btn btn-success">ÜRÜN EKLE</a></th>        

                </tr>
                </thead>



<?php

       islemler2::urunlist($db);

?>



<tbody>
                

                </form>

 
<div class="container">


</div>

</body>
</html>