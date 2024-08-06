<?php 

class VT {
    var $sunucu = "localhost";
    var $user = "root";
    var $password = "";
    var $dbname = "yonetimpaneli";
    var $baglanti;

    function __construct() {
        try {
            $this->baglanti = new PDO("mysql:host=" . $this->sunucu . ";dbname=" . $this->dbname . ";charset=utf8", $this->user, $this->password);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function VeriGetir($tablo,$wherealanlar="",$wherearraydeger="",$orderby="ORDER BY ID ASC",$limit="")
    {
        $this->baglanti->query("SET CHARACTER SET utf8");
        $sql="SELECT * FROM ".$tablo;
        if(!empty($wherealanlar) && !empty($wherearraydeger))
        {
            $sql.=" ".$wherealanlar;
            if (!empty($orderby)) {$sql .= " " . $orderby;}
            if (!empty($limit)) {$sql .= " LIMIT " . $limit;}
            $calistir = $this->baglanti->prepare($sql);
            $sonuc=$calistir->execute($wherearraydeger);
            $veri = $calistir->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            if(!empty($orderby)) { $sql=" ".$orderby;}
            if(!empty($limit)) { $sql=" LIMIT ".$limit;}
            $veri=$this->baglanti->query($sql,PDO::FETCH_ASSOC);
        }

        if($veri!=false && !empty($veri))
        {
            $datalar=array();
            foreach ($veri as $bilgiler) {
                $datalar[]=$bilgiler;
            }
            return $datalar;
        }
        else{
            return false;
        }
    }
}

?>
