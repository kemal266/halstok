<?php 
try{

    $db=new PDO("mysql:host=localhost;dbname=halsite",'root','');
    echo "veritabanı baglantısı basarılı";


}
catch (PDOExpception $e){
    echo $e->getMessage();
}

?>