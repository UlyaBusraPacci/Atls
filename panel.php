<?php  
    include("panelF.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){ 
        @$email=htmlspecialchars($_POST["email"]);
        @$sifre=md5(htmlspecialchars($_POST["sifre"]));
        @$rememberMe=$_POST["rememberMe"];
    
            // yukarıda girilenleri atadım.
                
                if(!empty($email) && !empty($sifre)){
                    $new1=$db->prepare("SELECT * FROM paneladmin where email=? AND sifre=?");
                    $new1->execute([$email,$sifre]);
 
                   if($new1->rowCount()>0){
                   
                        $kullanici =$new1->fetch();                    
                        $_SESSION["id"] = $kullanici["id"]; // oturum için kullanıcı id değerini tutmamız yeterli. bu id değeri ile diğer bilgilerine ulaşabiliriz.  
                        $_SESSION["giris"] =true;

                        if(isset($rememberMe)){
                            
                            
                                        $cookie_deger = md5($email.$sifre.uniqid());
                                        $myCookie=setcookie("admin_cookie", $cookie_deger,time()+3600);

                                        if(($myCookie==true)){
                                            $add=$db->prepare("UPDATE paneladmin SET cookie=? WHERE id=?");
                                            $add->bindParam(1,$cookie_deger,PDO::PARAM_STR);
                                            $add->bindParam(2,$kullanici["id"],PDO::PARAM_INT);
                                            $add-> execute();
                
                                            echo "cookie oluştu";
                                        }
                                        else{
                                            echo "cookie oluşmuna izin verilmedi";
                                        }
                        }

                        
                    // echo "cookie için izin verildi";
                }

                else{
                    echo "izin verilmedi";
                }
                      
                       
                    }
    
    }
?>
 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE4ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>has user </title>
</head>

<body>



<br><br>

<div class="container">

  <form action="panel.php?islem=giris" method="post" action="<?php
                                                            echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
            <table class="table  table-bordered " style="text-align:center">
                <thead>
                <tr>
                    <th colspan="12">PANELE GİRİŞ</th>      
                </tr>
                </thead>
                
                <tbody>
                <tr>
                <tr>
                
                <th colspan="8">E-POSTA</th>
                <th colspan="8" style="text-align:left;"><input name="email" type="email" /></th>
                </tr>
                
                
                <tr>
                
                <th colspan="8">SIFRE</th>
                <th colspan="8" style="text-align:left;"><input name="sifre" type="text" /></th>
                </tr>
                
                <tr>
                
               
                <th colspan="24">

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="rememberMe" value="">
                        <label class="form-check-label" for="rememberMe">beni hatırla</label>
                    </div>

                    <input type="submit" name="new1Buton" class="btn btn-success" value="PANEL GİRİŞİ İÇİN TIKLAYINIZ">
                </th>
                
                
            </table>

        </form>

 
</div>
<?php 

@$islem= $_GET["islem"];
switch ($islem):
    case "giris":
        panelIslemler::giris($db);
    break;


    default:
    break;

 endswitch;
?>
 

</body>
</html>