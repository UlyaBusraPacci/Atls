<?php

try  {
	$db = new PDO("mysql:host=localhost;dbname=panel;charset=utf8", "root","");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
} catch (PDOException $e) {
	die($e->getMessege());
}

class islemler{
    
    public static function list($db){

        $bastir=$db->prepare("SELECT * from menu");
        $bastir->execute();

        if($bastir->rowCount()==0){
            echo '<tr>
            <td >KAYITLI ÜYE YOK</td>
            </tr>';
        }

        else{
            while($eleman=$bastir->fetch(PDO::FETCH_ASSOC)){
                echo    '<tr>
                        <td>'.$eleman["firmaAd"].'</td>
                        <td>'.$eleman["firmaSecenek"].'</td>
                        <td>'.$eleman["firmaLink"].'</td>


                    
                        <td><a href="menu.php?isi=menuGuncelle&id='.$eleman["id"].'" class="btn btn-warning" name="menuGuncelButon" class="guncelleBut">GÜNCELLE</a>
                        <a href="menu.php?isi=menuSil&id='.$eleman["id"].'" class="btn btn-danger" >SİL</a></td>          
                        </tr>'; 
            }
        }
    }



   
    public static function menuEkle($db){

        @$butonEkle=$_POST["menuEkleButon"];
        echo ' <table class="table table-bordered table-striped text-center bg-white">
        <thead>
        <tr>
        <th colspan="6">MENÜ EKLEME</th>
            
        </tr>
        </thead>
        <tbody>
        <tr>
        <!-- arkasını aynı yapmak için th ye aldık formun -->
        <th colspan="6">
            <form action="menu.php?isi=menuEkle" method="post">
                <input type="text" name="firmaAd" class="form-control mx-auto col-md-3 mt-2" placeholder="FİRMA ADI ">
                <input type="text" name="firmaSecenek" class="form-control mx-auto col-md-3 mt-2" placeholder="SEÇENEĞİ">
                <input type="text" name="firmaLink" class="form-control mx-auto col-md-3 mt-2" placeholder="SEÇENEK LİNKİ">
                <input type="submit" name="menuEkleButon" class="btn btn-success" value= "EKLEYİNİZ">

            </form>
        </th>
        </thead>
        <tbody>
        <tr>';
      
        if($butonEkle){
            @$id=$_POST["id"];
            @$firmaAd=$_POST["firmaAd"];
            @$firmaSecenek=$_POST["firmaSecenek"];
            @$firmaLink=$_POST["firmaLink"];




            if(empty($firmaAd)|| empty($firmaSecenek) || empty($firmaLink)){
                echo '<tr>
                <td >LÜTFEN BOŞ ALAN BIRAKMAYINIZ</td>
                </tr>';
            }
        
            else {
                $add=$db->prepare("INSERT into menu(firmaAd,firmaSecenek,firmaLink) VALUES(?,?,?)");
                $add->bindParam(1,$firmaAd,PDO::PARAM_STR);
                $add->bindParam(2,$firmaSecenek,PDO::PARAM_STR);
                $add->bindParam(3,$firmaLink,PDO::PARAM_STR);
                $add-> execute();

                echo "MENÜ EKLEME BAŞARILI , KONTROL İÇİN LÜTFEN BEKLEYİNİZ";
                header("refresh:2, url=menu.php");
            }


        }

    }





    public static function menuSil($db){
        @$menuId=$_GET["id"];

        if($menuId){
            $sil=$db->prepare("DELETE from menu where id=:id");
            $sil->execute(array(':id'=>$menuId));

            echo  '<tr>
            <td >MENU SİLME İŞLEMİ TAMAMLANDI , GÖRMEK İÇİN LÜTFEN BEKLEYİNİZ !</td>
            </tr>';

            header("refresh:2, url=menu.php");
        }

        else{
            echo "HATA BU MENÜ DB DE BULUNAMADI !";
        }
}




public static function menuGuncelle($db){

    @$menuId=$_GET["id"];
            
    if(@$_POST["BUTON"]){

        @$id=$_POST["id"];
        @$firmaAd=$_POST["firmaAd"];
        @$firmaSecenek=$_POST["firmaSecenek"];
        @$firmaLink=htmlspecialchars($_POST["firmaLink"]);

// print_r($_POST);
// exit();
        if(!empty($firmaAd)|| !empty($firmaSecenek) || !empty($firmaLink)){
           
            $ek=$db->prepare("UPDATE menu set firmaAd=?, firmaSecenek=? , firmaLink=?  where id=$menuId");
            $ek->bindParam(1,$firmaAd,PDO::PARAM_STR);
            $ek->bindParam(2,$firmaSecenek,PDO::PARAM_STR);
            $ek->bindParam(3,$firmaLink,PDO::PARAM_STR);
            $ek-> execute();

            header("refresh:2, url=menu.php");
            echo "MENÜ GÜNCELLEME BAŞARILI , LÜTFEN BEKLEYİNİZ !";
        }

        else{
            echo '<tr>
            <td >LÜTFEN BOŞ ALAN BIRAKMAYINIZ</td>
            </tr>';
            header("refresh:2, url=menu.php");

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
                <form action="menu.php?isi=menuGuncelle&id='.$menuId.'" method="post">';

                $sorgum=$db->prepare("select * from menu where id=$menuId");
                $sorgum->execute();

                $sorguson=$sorgum->fetch();

            echo '
                <input type="text" name="firmaAd" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["firmaAd"].'">
                <input type="text" name="firmaSecenek" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["firmaSecenek"].'"">
                <input type="text" name="firmaLink" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["firmaLink"].'"">
                <input type="hidden" name="id" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["id"].'""><br>

                
                <input type="submit" name="BUTON" class="btn btn-success" value= " MENÜYÜ GÜNCELLE">';

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