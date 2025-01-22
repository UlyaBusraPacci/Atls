<?php  
   ob_start();
   session_start(); 

if($_SESSION["giris"]!=true){


   header("Location: panel.php");
}
try  {
	$db=new PDO("mysql:host=localhost;dbname=panel;charset=utf8","root","");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
} catch (PDOException $e) {
	die($e->getMessege());
}
include("menuF.php");
 include("urunlerF.php");
?>
 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE4ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="menu.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>USER </title>
</head>

<body>
<?php
@$nee=$_GET["isi"];

switch ($nee){
    case ("menuEkle"):
        islemler::menuEkle($db);
    break;

    case ("menuGuncelle"):
        islemler::menuGuncelle($db);
    break;

    case ("menuSil"):
        islemler::menuSil($db);
    break;
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

        <form action="menu.php?is=menuEkle" method="post" >
            <table class="table table-bordered table-striped text-center bg-white">
                <thead>
            
                <tr>
                    <th class="font-weight-bold">FİRMA ADI</th>
                    <th class="font-weight-bold">SEÇENEĞİ</th>
                    <th class="font-weight-bold">LİNK</th>
                    <th><a href="menu.php?isi=menuEkle" class="btn btn-success">MENÜ EKLE</a></th>        

                </tr>
                </thead>



<?php

       islemler::list($db);

?>



<tbody>
                

                </form>

 
<div class="container">


</div>

</body>
</html>