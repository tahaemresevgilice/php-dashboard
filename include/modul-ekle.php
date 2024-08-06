<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modul Ekle</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
              <li class="breadcrumb-item active">Modul Ekle</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php 
        if($_POST)
        {
            $calistir=$VT->modulEkle();
            if($calistir!=false)
            {
              echo '<div class="alert alert-success">Modul Başarıyla Eklendi</div>';
            }
            else{
              echo '<div class="alert alert-danger">Modul oluşturulurken bir sorun oluştu, sorun şunlar olabilir.<br>
              - Boş alan olabilir<br>
              - Aynı isimde zaten kayıtlı bir veri mevcut olabilir<br>
              - Sistemsel bir sorun olmuş olabilir</div>';
            }
        }
        ?>
        <div class="col-md-6">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Modul Tanımlama Ekranı</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="#" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Başlık</label>
                    <input type="text" class="form-control" name="baslik" placeholder="Modül ismini yazınınz...">
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="durum" value="1" chechked>
                    <label class="form-check-label" for="exampleCheck1">AKTİF YAP</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Modul Ekle</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>