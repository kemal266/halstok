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

            </ul>
          </div>
          <div class="box-position" style="background-image: url(images/bg-breadcrumbs.jpg);"></div>
        </div>
      </section>
     
      <section class="section section-md section-first bg-default text-md-left">
        <div class="container">
          <div class="row row-50 justify-content-center">

            
          <?php
                          
                        $firmasor=$db->prepare("select * from firma order by firma_id DESC limit 25");
                        $firmasor->execute(array());

                        while($firmacek=$firmasor->fetch(PDO::FETCH_ASSOC)) {
                        ?>
            
            <div class="col-md-10 col-lg-5 col-xl-6"><img width="350"height="350" src="<?php echo $firmacek['firma_resimyol']?>">
            <h2><?php echo $firmacek['firma_ad']?></h2>
            <p><?php echo $firmacek['firma_tel']?></p>
            <p><?php echo $firmacek['firma_adres']?></p>
             
              
                
                </ul>
            </div>

                        <?php } ?>


          
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