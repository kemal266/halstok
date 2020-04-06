<?php 
try{

    $db=new PDO("mysql:host=localhost;dbname=halsite",'root','');
    $db->exec("SET NAMES 'utf8';SET CHARSET 'utf8'");
    //echo "veritabanı baglantısı basarılı";


}
catch (PDOExpception $e){
    echo $e->getMessage();
}

?>