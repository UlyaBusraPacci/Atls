<?php


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
//  echo $new1->rowCount();
//  exit();
                   if($new1->rowCount()>0){
                        $kullanici = $prepare->fetch();
                    
                        $_SESSION["id"] = $kullanici["id"]; // oturum için kullanıcı id değerini tutmamız yeterli. bu id değeri ile diğer bilgilerine ulaşabiliriz.  
                        $_SESSION["giris"] =true;
                        header("refresh:2,url=welcomeToPanel.php");
                    }

                    else{
                         echo "GİRDİĞİNİZ ŞİFRE VEYA EMAİL ADRESİ YANLIŞ LÜTFEN BEKLEYİNİZ !";
                    }
                }

                else {
                    echo "BOŞ ALAN BIRAKMAYINIZ LÜTFEN ! ";
                    header("refresh:2,url=panel.php");
                }



        }

        @$butonum2 =$_POST["new2Buton"];
        @$kod=$_POST["kod"];


        if($butonum2){
            header("refresh:2,url=proof.php");

            if($kod="mypanel1234"){

            }

            else{
                echo "LÜTFEN ŞİRKET KODUNU DOĞRU GİRİNİZ!";
                header("refresh:2,url=proof.php");

            }
        }

       
    
?>