
<?php

try  {
	$db = new PDO("mysql:host=localhost;dbname=panel;charset=utf8", "root","");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
} catch (PDOException $e) {
	die($e->getMessege());
}

    
?>



<!DOCTYPE html>
<html lang="tr"> <!--class = "dark-mode"-->
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device, initial-scale=1.0">
    <title> El Koruyucular</title>
    <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="elkoruyucular.css">
   
</head>
<body>

<!-- ********************************************************************************** -->
<!-- ----------------------------------Header--------------------------------------- -->
<div class="header">

    <div class="bos">
        <img class="atlasko" src="atlaskkd_logo.svg" alt="">
    </div>

    <div class="linko">
        <ul class="links">
            <li><a href="<?php 
                    $bastir=$db->prepare("SELECT * from menu where id=11");
                    $bastir->execute();
                    $eleman=$bastir->fetch(PDO::FETCH_ASSOC);
                    echo $eleman["firmaLink"];?>">
                    Hakkımızda</a>
            </li>

            <li><a href="<?php 
                    $bastir=$db->prepare("SELECT * from menu where id=12");
                    $bastir->execute();
                    $eleman=$bastir->fetch(PDO::FETCH_ASSOC);
                    echo $eleman["firmaLink"];?>">
                    Ürünler</a>
            </li>


            <li><a href="<?php 
                    $bastir=$db->prepare("SELECT * from menu where id=13");
                    $bastir->execute();
                    $eleman=$bastir->fetch(PDO::FETCH_ASSOC);
                    echo $eleman["firmaLink"];?>">
                    Özel Üretim</a>
            </li>


            <li><a href="<?php 
                    $bastir=$db->prepare("SELECT * from menu where id=14");
                    $bastir->execute();
                    $eleman=$bastir->fetch(PDO::FETCH_ASSOC);
                    echo $eleman["firmaLink"];?>">
                    Bölge Bayilerimiz</a>
            </li>


            <li><a href="<?php 
                    $bastir=$db->prepare("SELECT * from menu where id=15");
                    $bastir->execute();
                    $eleman=$bastir->fetch(PDO::FETCH_ASSOC);
                    echo $eleman["firmaLink"];?>">
                    İnsan Kaynakları</a>
            </li>


            <li><a href="<?php 
                    $bastir=$db->prepare("SELECT * from menu where id=16");
                    $bastir->execute();
                    $eleman=$bastir->fetch(PDO::FETCH_ASSOC);
                    echo $eleman["firmaLink"];?>">
                   İletişim</a></li>
        </ul><!--links biti -->
    </div>

    <div class="right">
        <button type="button"><img src="fi-bs-search.jpg" alt=""></button>
        <div class="lang">
            <div  class="lang en">EN</div>
            <div class="lang tr">TR</div>
        </div><!-- lang bitiş -->
    </div>
</div><!-- header bitiş -->

<!-- *********************************************************************************** -->
<!-- --------------------------whatsapp------------------------------------------------- -->

<img class="wp" src="logos_whatsapp.svg" alt="">

<!-- *********************************************************************************** -->
<!-- ----------------------------- el koruyucular------------------------------------ -->

<div class="elko">
    <img  class="rec" src="Rectangle9.svg" alt="">

    <div class="hey">
         <a href="https://3mpati.com/stajyer/ulya/project6/atlas.html"><img src="fi-ss-angle-left.svg" alt="">Ana Sayfa</a> 
       
        <div class="middle">
            <div class="headerE">El Koruyucular</div>
            <div class="litheader">(47 Ürün)</div>
        </div><!-- middle bitiş -->
        
    </div><!-- hey bitiş -->

</div><!-- elko bitiş -->


<!-- ******************************************************************************* -->
<!-- --------------------------------filtersssssss------------------------------- -->
<div class="general">

    <div class="headerFil">Filtrele</div>

    <div class="filters">

        <form class="katagoriler">
            <select>
                <option> <div>Katagoriler</div></option>
                <option></option>
                <option></option>
            </select>
        </form>

        <form class="marka">
            <select>
                <option>Marka</option>
                <option></option>
                <option></option>
            </select>
        </form>

        <form class="yeniden">
            <select>
                <option>Yeniden eskiye</option>
                <option>eskiden yeniye</option>
            </select>
        </form>

    </div><!-- filters bitiş -->

<!-- ********************************************************************************* -->
<!-- -------------------------containers but in the general class------------------- -->

<!-- 1 -->
<?php
    $bastir1=$db->prepare("SELECT * from urunler");
    $bastir1->execute();
    $elemanlar=$bastir1->fetchAll(PDO::FETCH_ASSOC);
    foreach ($elemanlar as $eleman1) {
?>
<div class="container one">
    <img src="heyo23/<?php echo $eleman1["urunResmi"]; ?>">
    <div class="etiket"><?php echo $eleman1["urunAciklamasi"]; ?></div>
    <div class="kod"><?php echo $eleman1["urunKodu"]; ?></div>
    <div class="bilgi"><?php echo $eleman1["urunAd"];?></div>
</div>
<?php } ?>

<!-- 3 -->

</div><!-- general bitiş -->

<!-- ********************************************************************************** -->
<!-- ----------------------------------- footer ----------------------------- -->
<footer>


    <!-- ************************************************************************* -->
    <!-- --------------------------------özel üretim---------------------------- -->
   
        <div class="destek">
    
            <img class="headp" src="fa-solid_headphones-alt (1).svg" alt="">
    
            <div class="ara">
                <div class="asis">Destek Asistanı</div>
                <div class="no">+90 212 689 89 07</div>
            </div><!-- ara bitiş -->
    
            <button>Şimdi ara</button>
    
        </div><!-- destek bitiş -->
    
    <div class="menu">
        <div class="imgsss">
            <img id="atlasko2" src="atlassu.PNG" alt="">
    
            <div class="social">
                <img src="bi_facebook (1).svg" alt="">
                <img src="entypo-social_twitter-with-circle (2).svg" alt="">
                <img src="bxl_instagram-alt (1).svg" alt="">
                <img src="bi_linkedin (1).svg" alt="">
            </div><!-- socia bitiş -->
    
        </div><!--  images bitiş -->
    
    
        <div class="iletisim">
            <div class="baslik"> İLETİŞİM</div>
            <div class="a"> H. Rıfat Paşa
                Mahallesi Perpa <br>Sok Perpa İş Merkezi
                No:943 <br>D:B Blok, 34384 Şişli 
                
                <div>info@atlaskkd.com</div>
        </div><!-- baslik bitiş -->
    </div><!-- iletişim bitiş -->
    
        <div class="hizlimenu">
            <div class="baslikM">HIZLI MENÜ</div>
            <br>
            <a href="#">Kurumsal</a>
            <br>
            <a href="#">Gizlilik Politikası</a>
            <br>
            <a href="#">Galeri</a>
            <br>
            <a href="#">İletişim</a>
            <br>
        </div><!-- hizli menu bitiş -->
    
    </div><!-- menu bitiş -->
    
     
    </footer>
    
    <div class="sent">Tüm hakları saklıdır | Copyright 2023 Website made by More IT</div>








</body>
</html>
