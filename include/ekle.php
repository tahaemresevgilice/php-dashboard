<?php 
    if(!empty($_GET["tablo"]))
    {
        $tablo=$VT->filter($_GET["tablo"]);
        $kontrol=$VT->VeriGetir("moduller","WHERE tablo=? AND durum=?",array($tablo,1),"ORDER BY ID ASC",1);
        if($kontrol!=false)
        {
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?=$kontrol[0] ["baslik"] ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
                        <li class="breadcrumb-item active"><?=$kontrol[0] ["baslik"] ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.card -->
            <div class="row justify-content">
                <div class="col-md-12">
                    <a href="<?=SITE?>ekle/<?=$kontrol [0] ["tablo"]?>" class="btn btn-success"
                        style="float:right;margin-bottom:10px;">Yeni Ekle <i class="fa fa-plus"></i></a>
                </div>
            </div>
            <?php
            if($_POST)
            {
                if(!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["anahtar"]) && !empty($_POST["description"]) && !empty($_POST["sirano"]))
                {
                    $kategori=$VT->filter($_POST["kategori"]);
                    $baslik=$VT->filter($_POST["baslik"]);
                    $seflink=$VT->seflink($baslik);
                    $anahtar=$VT->filter($_POST["anahtar"]);
                    $description=$VT->filter($_POST["description"]);
                    $sirano=$VT->filter($_POST["sirano"]);
                    $metin=$VT->filter($_POST["metin"],true);
                    if(!empty($_FILES["resim"] ["name"]))
                    {
                        $yukle=$VT->upload("resim","../images/".$kontrol [0] ["tablo"]."/");
                        if($yukle!=false)
                        {
                            $ekle=$VT->sorguCalistir("INSERT INTO ".$kontrol[0] ["tablo"],"SET baslik=?, seflink=?, kategori=?, anahtar=?, resim=?, description=?, sirano=?, metin=?, durum=?, tarih=?",array($baslik,$seflink,$kategori,$metin,$yukle,$anahtar,$description,1,$sirano,date("Y-m-d")));
                        }
                        else
                        {
                            ?>
                            <div class="alert alert-info">Resim yükleme işleminiz başarısız olmuştur.</div>
                            <?php
                        }
                    }
                    else
                    {
                        $ekle=$VT->sorguCalistir("INSERT INTO ".$kontrol[0] ["tablo"],"SET baslik=?, seflink=?, kategori=?, anahtar=?, description=?, sirano=?, metin=?, durum=?, tarih=?",array($baslik,$seflink,$kategori,$metin,$anahtar,$description,1,$sirano,date("Y-m-d")));
                        if($ekle!=false)
                        {
                            ?>
                            <div class="alert alert-success">işleminiz başarıyla  kaydedildi.</div>
                            <?php
                        }
                        else{
                            ?>
                            <div class="alert alert-info">İşleminiz sırasında bir hata oluştu.</div>
                            <?php
                        }
                    }
                }
                else
                {
                    ?>
                    <div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
                    <?php
                }
            }
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="col-md-8">
                    <!-- /.card-header -->
                    <div class="card-body card card-primary">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kategori Seç</label>
                                    <select class="form-control select2" style="width: 100%;" name="kategori">
                                        <?php 
        $sonuc = $VT->kategoriGetir($kontrol[0]["tablo"], "", -1);

        if ($sonuc !== false) {
            echo $sonuc;
        } else {
          
            echo $VT->tekKategori($kontrol[0]["tablo"], "", -1);
        }
    ?>
                                    </select>


                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Başlık</label>
                                    <input type="text" class="form-control" name="baslik" placeholder="Başlık ...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Açıklama</label>
                                    <textarea class="textarea" name="metin" placeholder="Açıklama"
                                        style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Anahtar</label>
                                    <input type="text" class="form-control" name="anahtar" placeholder="Anahtar ...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="description"
                                        placeholder="Description ...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Resim</label>
                                    <input type="file" class="form-control" name="resim" placeholder="Resim Seçin ...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sıra No</label>
                                    <input type="number" class="form-control" name="sirano" placeholder="Sıra No ..."
                                        style="width:100px;">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary">Kaydet</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
    </section>
    <!-- /.content -->
</div>
<?php
        }
        else{
            ?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>" <?php
        }
    }
    else{
        ?> <meta http-equiv="refresh" content="0;url=<?=SITE?>" <?php
    }
    
  ?>