<?php  
include("panelF.php");
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

  <form action="proof.php?islem=ekle" method="post"> 
            <table class="table  table-bordered " style="text-align:center">

                
                <thead>
                <tr>
                    <th colspan="12">BİLGİLERİ TEYİT İÇİN TEKRAR GİRİNİZ</th>      
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
                
                
                <th colspan="24"><input type="submit" name="new3Buton" class="btn btn-success" value="PANEL GİRİŞİ İÇİN TIKLAYINIZ"></th>
                
                
                
            </table>

        </form>
                
                
            </table>

        </form>


 
</div>
<?php 

@$islem= $_GET["islem"];
switch ($islem):
    case "ekle":
        panelIslemler::adminEkle($db);
    break;

    default:
    break;

 endswitch;
 
?>
 

</body>
</html>