<?php

try  {
	$db=new PDO("mysql:host=localhost;dbname=panel;charset=utf8","root","");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
} catch (PDOException $e) {
	die($e->getMessege());
}



class islem{

    public static function ekleDb($db){
        $butonumm =$_POST["fbuton"];

        if($butonumm){
            @$id=htmlspecialchars($_POST["id"]);
            @$ad=htmlspecialchars($_POST["ad"]);
            @$soyad=htmlspecialchars($_POST["soyad"]);
            @$email=htmlspecialchars($_POST["email"]);
            @$sifre=md5(htmlspecialchars($_POST["sifre"]));
            @$sifreTekrar=md5(htmlspecialchars($_POST["sifreTekrar"]));
          
            

            if(!empty($ad) && !empty($soyad) && !empty($email) && !empty($sifre) &&!empty($sifreTekrar)){
                 // eklemenin asıl yapıldığı yer!!!!!!!!!!!!!!!!!!!!!!!
                

                @$emailNew=$db->prepare("SELECT email FROM panelAdmin where email='$email'");
                $emailNew->execute();

                    if($sifre==$sifreTekrar){

                                if($emailNew->rowCount()>0){
                                        echo "Yazmış olduğunuz eposta adresi adına başkabir hesap bulunmaktadır
                                        <br> Lütfen başka bir eposta adresi giriniz.";   
                                }

                                else{
                                        $ekleme=$db->prepare("INSERT INTO panelAdmin(ad,soyad,email,sifre) VALUES(?,?,?,?)");

                                        $ekleme->bindParam(1,$ad,PDO::PARAM_STR);
                                        $ekleme->bindParam(2,$soyad,PDO::PARAM_STR);
                                        $ekleme->bindParam(3,$email,PDO::PARAM_STR);
                                        $ekleme->bindParam(4,$sifre,PDO::PARAM_STR);               
                                        $ekleme->execute();
                        
                                        echo "ÜYE EKLEME BAŞARILI , LÜTFEN BEKLEYİNİZ :)";
                                        header("refresh:2,url=welcomeToPanel.php");
                                    }

                    }


                    else{
                            echo "oluşturduğunuz şifre ile aynı olmalıdır";
                    }
            }

            else {
                echo "BOŞ ALAN BIRAKMA HEPSİ GEREKLİ ! ";
                header("refresh:2,url=adminForm.php");
            }




        }


}
}// class bitimi



?>