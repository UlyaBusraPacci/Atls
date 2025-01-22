<?php
    ob_start();
    session_start(); 

try  {
	$db=new PDO("mysql:host=localhost;dbname=panel;charset=utf8","root","");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
} catch (PDOException $e) {
	die($e->getMessege());
}



class panelIslemler{

 
    public static function giris($db){

        @$butonum1 =$_POST["new1Buton"];

        if($butonum1){
            @$id=htmlspecialchars($_POST["id"]);
            @$email=htmlspecialchars($_POST["email"]);
            @$sifre=md5(htmlspecialchars($_POST["sifre"]));
            // print_r($_POST);
            // exit();
                if(!empty($email) && !empty($sifre)){     
                               
                    $new1=$db->prepare("SELECT * FROM paneladmin where email=? AND sifre=?");
                    $new1->execute([$email,$sifre]);
 
                   if($new1->rowCount()>0){
                   
                        $kullanici =$new1->fetch();                    
                        $_SESSION["id"] = $kullanici["id"]; // oturum için kullanıcı id değerini tutmamız yeterli. bu id değeri ile diğer bilgilerine ulaşabiliriz.  
                        $_SESSION["giris"] =true;

                         
                        header("refresh:2,url=welcomeToPanel.php");
                       
                    }

                    else{
                         echo "GİRDİĞİNİZ ŞİFRE VEYA EMAİL ADRESİ YANLIŞ LÜTFEN BEKLEYİNİZ !";
                         header("refresh:2,url=panel.php");
                    }
                }

                else {
                    echo "BOŞ ALAN BIRAKMAYINIZ LÜTFEN ! ";
                    header("refresh:2,url=panel.php");
                }



        }


// *******************************************************************************************
    //     $hata = "";
 
    //     if($_POST) {
    //         // post işlemi yapılmış mı 
            
    //         $email = addslashes($_POST["email"]);
    //         $sifre= addslashes($_POST["sifre"]);
            
    //         $prepare = $db->prepare("select * from paneladmin where email=? &&  sifre=?");
    //         $prepare->execute([$email,$sifre]);; 
            
            
    //         if($prepare->rowCount() > 0) {
    //             // bilgiler eşleşiyor oturum aç. 
    //             $kullanici = $prepare->fetch();
                
    //             $_SESSION["id"] = $kullanici["id"]; // oturum için kullanıcı id değerini tutmamız yeterli. bu id değeri ile diğer bilgilerine ulaşabiliriz.  
    //             $_SESSION["giris"] =true;

                
    //             // index sayfasına yeniden yönlendir.  
    //             header("Location: panel.php");
                
    //         }else {
    //             $hata = " Kullanıcı adı veya şifre hatalı!";
    //         }
            
    //     }
        
    //     // çıkış yap
        
    //     if(isset($_GET["islem"]) && $_GET["islem"] == "cikis") {
    //         session_destroy();
    //         // çıkış yap index sayfasına yeniden yönlendir.
    //         header("Location: panel.php");
    //     }
        
    // }     
        

//        @$butonum1 =$_POST["new1Buton"];

//         if($butonum1){
//             @$id=htmlspecialchars($_POST["id"]);
//             @$email=htmlspecialchars($_POST["email"]);
//             @$sifre=md5(htmlspecialchars($_POST["sifre"]));
//             // print_r($_POST);
//             // exit();
//                 if(!empty($email) && !empty($sifre)){     
                               
//                     $new1=$db->prepare("SELECT * FROM paneladmin where email=? AND sifre=?");
//                     $new1->execute([$email,$sifre]);
// //  echo $new1->rowCount();
// //  exit();
//                    if($new1->rowCount()>0){
//                         header("refresh:2,url=welcomeToPanel.php");
//                     }

//                     else{
//                          echo "GİRDİĞİNİZ ŞİFRE VEYA EMAİL ADRESİ YANLIŞ LÜTFEN BEKLEYİNİZ !";
//                     }
//                 }

//                 else {
//                     echo "BOŞ ALAN BIRAKMAYINIZ LÜTFEN ! ";
//                     header("refresh:2,url=panel.php");
//                 }



//         }

//         @$butonum2 =$_POST["new2Buton"];
//         @$kod=$_POST["kod"];


//         if($butonum2){
//             header("refresh:2,url=proof.php");

//             if($kod="mypanel1234"){

//             }

//             else{
//                 echo "LÜTFEN ŞİRKET KODUNU DOĞRU GİRİNİZ!";
//                 header("refresh:2,url=proof.php");

//             }
//         }

       
//     }

    }
    
    public static function adminEkle($db){
        @$butonum3=$_POST["new3Buton"];
        @$email=$_POST["email"];
        @$sifre=md5($_POST["sifre"]);
  
            if(!empty($email) && !empty($sifre)){  
                $dogru=$db->prepare("SELECT role FROM paneladmin where email=? AND sifre=?");
                $dogru->execute(array($email,$sifre));
                $kullanici=$dogru->fetch();
                

                            if($butonum3){
                            
                                if($kullanici["role"]!=1){
                                    echo "BURAYA GİRİŞ İÇİN YETKİNİZ YOKTUR !";
                                    header("refresh:2,url=welcomeToPanel.php");
                                }
                                else{

                                    echo "<th>DOĞRULAMA BAŞARILI LÜTFEN BEKLEYİNİZ...<th>";
                                    header("refresh:2,url=adminForm.php");
                                }
                                
                            }
                      

                   

            }

            else {
                    echo "<th>BOŞ ALAN BIRAKMAYINIZ LÜTFEN !<th> ";
                    header("refresh:2,url=panel.php");
                }



}
}




?>