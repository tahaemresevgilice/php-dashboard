<?php 

class VT {
    var $sunucu = "localhost";
    var $user = "root";
    var $password = "";
    var $dbname = "yonetimpaneli";
    var $baglanti;

    function __construct() {
        try {
            // PDO bağlantı dizesindeki $this kullanımı yanlış
            $this->baglanti = new PDO("mysql:host=" . $this->sunucu . ";dbname=" . $this->dbname . ";charset=utf8", $this->user, $this->password);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
}

?>
