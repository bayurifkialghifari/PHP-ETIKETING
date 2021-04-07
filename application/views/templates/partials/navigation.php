<style type="text/css">.navbar-bawah{height: 100px;}</style>
<header style="margin-top: 0px !important;padding-top: 0px !important">
  
  <nav class="navbar navbar-expand-md navbar-success bg-dark" style="color:black;height:30px;background: #6c63ff!important;">
    <div class="container">

      <?php if($this->session->userdata('status') == true) : ?>
        
        <p style="margin-bottom: 0;"><i class="fa fa-user"></i> <?= $this->session->userdata('data')['nama'] ?> | <?= $this->session->userdata('data')['email'] ?></p>
      
      <?php else : ?>

        <p style="margin-bottom: 0;"><i class="fa fa-user"></i> Belum Login

      <?php endif; ?>

    </div>
  </nav>
  
  <nav class="navbar navbar-expand-md navbar-dark bg-dark static-top navbar-bawah">
    <div class="container">

      <div class="header-navbar-brand">
          <a class="header-logo" style="color: #fafafa">etiketing.com</a>
      </div>
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        
        <ul class="navbar-nav ml-auto" style="font-size: 14.5px">






          <?php foreach ($this->default->menu() as $q):?>

            <?php $menu_url = $q['menu_url'] == '#' ? '#' : (site_url() . $q['menu_url']); ?>
            
            <li class="nav-item dropdown">
              
              <?php 
                $sub_menu =  $this->default->sub_menu($q['menu_id']);
                if($sub_menu):
              ?>

                <a href="<?= $menu_url ?>" class="nav-link dropdown-toggle color-costum" title="<?=$q['menu_name']?>" id="navbardrop" data-toggle="dropdown"><i class="<?=$q['menu_icon']?>"></i>&nbsp; <?=$q['menu_name']?></a>

                <div class="dropdown-menu">
                    <?php foreach ($sub_menu as $row):?>
                    <a class="dropdown-item" href="<?= site_url() ?><?=$row['menu_url']?>"><i class="fa fa-caret-right"></i>&nbsp; <?=$row['menu_name']?></a>
                    <?php endforeach;?>
                </div>

              <?php else: ?>

                <a class="nav-link color-costum" href="<?= $menu_url ?>" title="<?=$q['menu_name']?>" id="navbardrop"><i class="<?=$q['menu_icon']?>"></i>&nbsp; <?=$q['menu_name']?></a>
              
              <?php endif; ?>

            </li>

          <?php endforeach;?>






          <?php if($this->session->userdata('status') == true) : ?>
            <li class="pl-5"></li>
            <li class="nav-item">
            
              <a class="nav-link color-costum" href="<?= base_url() ?>order/cek"><i class="fa fa-check-circle"></i>&nbsp; Cek Order</a>
            
            </li>

            <li class="nav-item">
            
              <a class="nav-link color-costum" href="#" id="logout"><i class="fa fa-sign-out"></i>&nbsp; Logout</a>

            </li>

          <?php else: ?>
            <li class="pl-5"></li>
            <li class="nav-item">
            
              <a class="nav-link color-costum" href="<?= base_url() ?>order/cek"><i class="fa fa-check-circle"></i>&nbsp; Cek Order</a>
            
            </li>

            <li class="nav-item">
            
              <a class="nav-link color-costum" href="<?= base_url() ?>login"><i class="fa fa-sign-in"></i>&nbsp; Login</a>
            
            </li>
            
            <li class="nav-item">

              <a class="nav-link color-costum active" href="<?= base_url() ?>register"><i class="fa fa-registered"></i>&nbsp; Daftar</a>
            
            </li>

          <?php endif; ?>

        </ul>

      </div>
    </div>
  </nav>
</header>