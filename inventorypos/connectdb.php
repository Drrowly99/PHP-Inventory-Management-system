<?php 


try{
    
  $pdo = new PDO('mysql:host=localhost;dbname=pos_db','root','');
//echo'Connection Successfull'; 
    
}catch(PDOException $f){
    
    echo $f->getmessage();
    
}

?>