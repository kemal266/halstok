 <!-- sidebar menu -->
 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3> <?php
                if ($kullanicicek['kullanici_yetki']==5) {
                 
                  echo "Yetki: Yönetici";
                }
                
                
                ?></h3>
                <ul class="nav side-menu">
                <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa </a></li>
                <li><a href="hakkimizda.php"><i class="fa fa-book"></i> Hakkımızda </a></li>
                <li><a href="firmalar.php"><i class="fa fa-building"></i> Firmalar </a></li>
                <li><a href="kullanici.php"><i class="fa fa-user"></i> Kullanıcılar </a></li>
                <li><a href="menu.php"><i class="fa fa-list"></i> Menüler </a></li>
                  <li><a><i class="fa fa-cog"></i> Ayarlar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="genel-ayar.php">Genel Ayarlar</a></li>
                      <li><a href="iletisim-ayar.php">İletişim Ayarları</a></li>
                      <li><a href="api-ayar.php">Api Ayarları</a></li>
                      <li><a href="sosyalmedya-ayar.php">Sosyam Medya Ayarları</a></li>
                      <li><a href="mail-ayar.php">Mail Ayarları</a></li>
                 
                    </ul>
                    <li><a href="yorum.php"><i class="fa fa-comments"></i> Yorumlar </a></li>
                    <li><a href="banka.php"><i class="fa fa-bank"></i> Bankalar </a></li>
                  </li>   
                </ul>
              </div>
              
            </div>