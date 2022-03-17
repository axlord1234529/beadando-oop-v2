<?php
if (isset($_POST['email'])&&isset($_POST['subject'])&&isset($_POST['message'])&&isset($_POST['lakhely'])) {
        $email = $_POST['email'] ;
        $subject = $_POST['subject'] ;
        $message = $_POST['message'] ;
        $lakhely = $_POST['lakhely'] ;  
                try {
        
        $dbh = new PDO('mysql:host=localhost;dbname=beadando', 'root', '',
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        
            $sqlInsert = "insert into uzenet(email, subject, message,lakhely)
                          values(:email, :subject, :message, :lakhely)";
            $stmt = $dbh->prepare($sqlInsert); 
            $stmt->execute(array(':email' => $_POST['email'], ':subject' => $_POST['subject'],
                                 ':message' => $_POST['message'],':lakhely'=> $_POST['lakhely'])); 
            if($count = $stmt->rowCount()) {
                $newid = $dbh->lastInsertId();
                
                $uzenet = "Az üzenet elküldése sikerült.";                 
                $ujra = false;
                
                
            }else{
                $uzenet="Az üzenetet nem sikerült elküldeni";
                $ujra = true;
            }
    }
    catch (PDOException $e) {
        $uzenet = "Hiba: ".$e->getMessage();
        $ujra = true;
    }              
}else{
        header("Location:/beadando/index.php?oldal=kapcsolat");
}
?>