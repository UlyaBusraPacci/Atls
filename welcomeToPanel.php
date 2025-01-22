<?php 

  include("urunlerF.php");

    ob_start();
    session_start(); 

if($_SESSION["giris"]!=true){
    if($_COOKIE["admin_cookie"]){

        $varmi=$db->prepare("SELECT id FROM paneladmin WHERE cookie=:cookie");
        $varmi->execute(array(":cookie" => $_COOKIE["admin_cookie"]));
        $varmi2=$varmi->fetch();
    
        if($varmi2["id"]){
            $_SESSION["id"] = $varmi2["id"]; // oturum için kullanıcı id değerini tutmamız yeterli. bu id değeri ile diğer bilgilerine ulaşabiliriz.  
            $_SESSION["giris"] =true;

            header("refresh:2,url=welcomeToPanel.php");
        } else {
            header("Location: panel.php");
        }
    } else {
        header("Location: panel.php");
    }    
}
?>
 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE4ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="welcomeToPanel.css">
<title>USER </title>
</head>

<body>

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

<div class="container">


</div>

</body>
</html>