<?php

try  {
	$db = new PDO("mysql:host=localhost;dbname=panel;charset=utf8", "root","");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
} catch (PDOException $e) {
	die($e->getMessege());
}

class islemler2{


    public static function outOfPage($db){
        ob_start();
        
// SİLMEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
        @$email=htmlspecialchars($_POST["email"]);
        @$sifre=md5(htmlspecialchars($_POST["sifre"]));
        $cookie_deger = md5($email.$sifre.uniqid());
        $myCookie=setcookie("admin_cookie", $cookie_deger,time()-1);

// veri tabanından silme
        $del=$db->prepare("UPDATE paneladmin SET cookie=NULL WHERE id=?");
        $del->bindParam(1,$_SESSION["id"],PDO::PARAM_INT);
        $del-> execute();

     
        echo "cookie silindi.";
// SİLMEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
        session_destroy();
        echo "Çıkış Yaptınız. Ana Sayfaya Yönlendiriliyorsunuz";
        header("Refresh: 2; url=panel.php");
        ob_end_flush();

    }
    public static function urunlist($db){

        $bastir=$db->prepare("SELECT * from urunler");
        $bastir->execute();

        // @$img=$eleman["urunResmi"];

        if($bastir->rowCount()==0){
            echo '<tr>
            <td >KAYITLI ÜYE YOK</td>
            </tr>';
        }
        // <td>'.$eleman["urunResmi"].'</td>
        // <td><img src='.$img.' alt=""></td>
        else{
            while($eleman=$bastir->fetch(PDO::FETCH_ASSOC)){
                echo    '<tr>
                        <td>'.$eleman["urunAd"].'</td>
                        <td>'.$eleman["urunFiyat"].'</td>
                        <td>'.$eleman["urunKodu"].'</td>
                        <td>'.$eleman["urunAciklamasi"].'</td>
                        <td>'.$eleman["urunResmi"].'</td>
                        <td><img src="heyo23/'.$eleman["urunResmi"].'"></td>
                        
                        
                        <td><a href="urunler.php?isi=urunGuncelle&id='.$eleman["id"].'" class="btn btn-warning" name="menuGuncelButon" class="guncelleBut">GÜNCELLE</a>
                        <a href="urunler.php?isi=urunSil&id='.$eleman["id"].'" class="btn btn-danger" >SİL</a></td>          
                        </tr>'; 
                        
            }
        }
    }



   
    public static function urunEkle($db){

        @$butonEkle=$_POST["urunEkleButon"];
        echo ' <table class="table table-bordered table-striped text-center bg-white">
        <thead>
        <tr>
        <th colspan="6">ÜRÜN EKLEME</th>
            
        </tr>
        </thead>
        <tbody>
        <tr>
        <!-- arkasını aynı yapmak için th ye aldık formun -->
        <th colspan="6">
            <form action="urunler.php?isi=urunEkle" method="post" name="ekleUrun" enctype="multipart/form-data">
                <input type="text" name="urunAd" class="form-control mx-auto col-md-3 mt-2" placeholder="ÜRÜN ADI ">
                <input type="text" name="urunFiyat" class="form-control mx-auto col-md-3 mt-2" placeholder="ÜRÜN FİYATI">
                <input type="text" name="urunKodu" class="form-control mx-auto col-md-3 mt-2" placeholder="ÜRÜN KODU">
                <input type="text" name="urunAciklamasi" class="form-control mx-auto col-md-3 mt-2" placeholder="ÜRÜN AÇILKLAMASI">
                <input type="file" name="urunResmi"">
                <input type="submit" name="urunEkleButon" class="btn btn-success" value= "EKLEYİNİZ">
               
            </form>
        </th>
        </thead>
        <tbody>
        <tr>';
      
        if($butonEkle){
            @$id=$_POST["id"];
            @$urunAd=$_POST["urunAd"];
            @$urunFiyat=$_POST["urunFiyat"];
            @$urunKodu=$_POST["urunKodu"];
            @$urunAciklamasi=$_POST["urunAciklamasi"];
            @$urunResmi=$_FILES["urunResmi"];


            if(empty($urunAd)|| empty($urunFiyat) || empty($urunKodu) || empty($urunAciklamasi) || empty($urunResmi)){
                echo '<tr>
                <td >LÜTFEN BOŞ ALAN BIRAKMAYINIZ</td>
                </tr>';
            }
        
            else {
                $add=$db->prepare("INSERT into urunler(urunAd,urunFiyat,urunKodu,urunAciklamasi,urunResmi) VALUES(?,?,?,?,?)");
                $add->bindParam(1,$urunAd,PDO::PARAM_STR);
                $add->bindParam(2,$urunFiyat,PDO::PARAM_STR);
                $add->bindParam(3,$urunKodu,PDO::PARAM_STR);
                $add->bindParam(4,$urunAciklamasi,PDO::PARAM_STR);
                $add->bindParam(5,$urunResmi["name"],PDO::PARAM_STR);
                $add-> execute();


// *******************************************************************************************
 

                    @$takeFile=$_FILES["urunResmi"];
                    @$fileName=$takeFile["name"];
                    @$fileTempName=$takeFile["tmp_name"];
                    @$fileType=$takeFile["type"];
                    $myPath="heyo23/".uniqid().$fileName;
                    // print_r($_FILES);
                    //  echo $fileName."<br>";
                    // echo $myPath."<br>";

                    // @$img=$eleman["urunResmi"];
                   

                    if(move_uploaded_file($fileTempName,$myPath)){
                        $bul=$db->prepare("select * from urunler where urunResmi=:urunResmi");
                        $bul->execute(array(':urunResmi'=>$fileName));
                            
                                    if($bul->rowCount()==0){
                                        echo '<tr>
                                        <td >aynı resim adı var değişiyor </td>
                                        </tr>';
                                        $newFileName=$fileName.$bul->rowCount().$fileType;
                                        rename($fileName,$newFileName);
                                    }
        
                            echo "YÜKLEME İŞLEMİ TAMAMLANDI !" ;
                            header("refresh:2, url=urunler.php");
                    }

                    else {
                        echo "resim yüklenemedi";
                    }

// ********************************************************************************************

                echo "ÜRÜN EKLEME BAŞARILI , KONTROL İÇİN LÜTFEN BEKLEYİNİZ";
                header("refresh:2, url=urunler.php");
            }


        }


    }

    public static function urunSil($db){
        @$urunId=$_GET["id"];

        if($urunId){
            $sil=$db->prepare("DELETE from urunler where id=:id");
            $sil->execute(array(':id'=>$urunId));

            echo  '<tr>
            <td >ÜRÜN SİLME İŞLEMİ TAMAMLANDI , GÖRMEK İÇİN LÜTFEN BEKLEYİNİZ !</td>
            </tr>';

            header("refresh:2, url=urunler.php");
        }

        else{
            echo "HATA BU MENÜ DB DE BULUNAMADI !";
        }
}




public static function urunGuncelle($db){

    @$urunId=$_GET["id"];
            
    if(@$_POST["BUTONN"]){

                    @$id=$_POST["id"];
                    @$urunAd=$_POST["urunAd"];
                    @$urunFiyat=$_POST["urunFiyat"];
                    @$urunKodu=$_POST["urunKodu"];
                    @$urunAciklamasi=$_POST["urunAciklamasi"];
                    @$urunResmi=$_POST["urunResmi"];

            // print_r($_POST);
            // exit();
                    if(!empty($urunAd)|| !empty($urunFiyat) || !empty($urunKodu) || !empty($urunAciklamasi)|| empty($urunResmi)){
                    
                        $add=$db->prepare("UPDATE urunler set urunAd=?, urunFiyat=? , urunKodu=?  , urunAciklamasi =? , urunResmi =? where id=$urunId");
                        $add->bindParam(1,$urunAd,PDO::PARAM_STR);
                        $add->bindParam(2,$urunFiyat,PDO::PARAM_STR);
                        $add->bindParam(3,$urunKodu,PDO::PARAM_STR);
                        $add->bindParam(4,$urunAciklamasi,PDO::PARAM_STR);
                        $add->bindParam(5,$urunResmi,PDO::PARAM_STR);
                        $add-> execute();

                        header("refresh:2, url=urunler.php");
                        echo "MENÜ GÜNCELLEME BAŞARILI , LÜTFEN BEKLEYİNİZ !";
                    }

                    else{
                        echo '<tr>
                        <td >LÜTFEN BOŞ ALAN BIRAKMAYINIZ</td>
                        </tr>';
                        header("refresh:2, url=urunler.php");

                    }

    }

    else{

        echo ' <table class="table table-bordered table-striped text-center bg-white">
                <thead>
                <tr>
                <th colspan="6">MENU GÜNCELLEME </th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>
                <!-- arkasını aynı yapmak için th ye aldık formun -->
                <th colspan="6">
                <form action="urunler.php?isi=urunGuncelle&id='.$urunId.'" method="post">';

                $sorgum=$db->prepare("select * from urunler where id=$urunId");
                $sorgum->execute();

                $sorguson=$sorgum->fetch();

            echo '
                <input type="text" name="urunAd" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["urunAd"].'">
                <input type="text" name="urunFiyat" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["urunFiyat"].'"">
                <input type="text" name="urunKodu" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["urunKodu"].'"">
                <input type="text" name="urunAciklamasi" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["urunAciklamasi"].'"">
                <input type="file" name="urunResmi" accept="image/*" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["urunResmi"].'"">
               
                <input type="hidden" name="id" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["id"].'""><br>

                
                <input type="submit" name="BUTONN" class="btn btn-success" value= " MENÜYÜ GÜNCELLE">';

            echo '</form>
                    </th>
                    </thead>
                    <tbody>
                    <tr>';
                    
                    exit();
    }






}






}











?>