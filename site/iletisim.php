<?php include 'header.php';

$hakkimizdasor=$db->prepare("select * from hakkimizda where hakkimizda_id=?");
$hakkimizdasor->execute(array(0));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);



?>
      <!-- Breadcrumbs -->
      <section class="breadcrumbs-custom-inset">
        <div class="breadcrumbs-custom context-dark bg-overlay-46">
          <div class="container">
            <h2 class="breadcrumbs-custom-title">About Our Farm</h2>
            <ul class="breadcrumbs-custom-path">
              <li><a href="index.html">Home</a></li>
              <li class="active">About Us</li>
            </ul>
          </div>
          <div class="box-position" style="background-image: url(images/bg-breadcrumbs.jpg);"></div>
        </div>
      </section>
      <!-- Why choose us-->
      <section class="section section-md section-first bg-default text-md-left">
        <div class="container">
          <div class="row row-50 justify-content-center">
            <div class="col-md-10 col-lg-5 col-xl-6"><img src="images/about-1-519x446.jpg" alt="" width="519" height="446"/>
            </div>
            <div class="col-md-10 col-lg-7 col-xl-6">
              <h2><?php echo $hakkimizdacek['hakkimizda_baslik']; ?></h2>
              <!-- Bootstrap tabs-->
              <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-4">
                <!-- Nav tabs-->
                <ul class="nav nav-tabs">
                  <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-4-1" data-toggle="tab">Amacı</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-4-2" data-toggle="tab">Kurucusu</a></li>
                
                </ul>
                <!-- Tab panes-->
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="tabs-4-1">
                    <p><?php echo $hakkimizdacek['hakkimizda_icerik']; ?></p>
                    <div class="text-center text-sm-left offset-top-30">
                      <ul class="row-16 list-0 list-custom list-marked list-marked-sm list-marked-secondary">
                        <li>Eiusmod tempor</li>
                        <li>Dolore magna</li>
                        <li>Minim veniam</li>
                        <li>Nostrud exercitation</li>
                        <li>Laboris nisi</li>
                        <li>Officia deserunt</li>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tabs-4-2">
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="text-center text-sm-left offset-top-30">
                      <ul class="row-16 list-0 list-custom list-marked list-marked-sm list-marked-secondary">
                        <li>Nostrud exercitation</li>
                        <li>Laboris nisi</li>
                        <li>Officia deserunt</li>
                        <li>Eiusmod tempor</li>
                        <li>Dolore magna</li>
                        <li>Minim veniam</li>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tabs-4-3">
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <div class="text-center text-sm-left offset-top-30">
                      <ul class="row-16 list-0 list-custom list-marked list-marked-sm list-marked-secondary">
                        <li>Minim veniam</li>
                        <li>Nostrud exercitation</li>
                        <li>Eiusmod tempor</li>
                        <li>Dolore magna</li>
                        <li>Laboris nisi</li>
                        <li>Officia deserunt</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Latest Projects-->
    
    

      <!-- What people say-->
     
      <section class="section section-md section-last bg-gray-100">
        <div class="container">
          <div class="oh">
            <h2 class="wow slideInUp" data-wow-delay="0s">Our Partners</h2>
          </div>
          <!-- Owl Carousel-->
          <div class="owl-carousel owl-clients owl-dots-secondary" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="4" data-margin="30" data-dots="true" data-animation-in="fadeIn" data-animation-out="fadeOut"><a class="clients-modern" href="#"><img src="images/clients-1-270x145.png" alt="" width="270" height="145"/></a><a class="clients-modern" href="#"><img src="images/clients-2-270x145.png" alt="" width="270" height="145"/></a><a class="clients-modern" href="#"><img src="images/clients-3-270x145.png" alt="" width="270" height="145"/></a><a class="clients-modern" href="#"><img src="images/clients-4-270x145.png" alt="" width="270" height="145"/></a></div>
        </div>
      </section>
      <!-- Page Footer-->
      <?php include 'footer.php';?>