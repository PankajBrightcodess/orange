 <div class="header-area" id="headerArea">
      <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Logo Wrapper-->
        <div class="suha-navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#suhaOffcanvas" aria-controls="suhaOffcanvas"><span></span><span></span><span></span></div>
      <!--   <div class="logo-wrapper"><a href="home.html"><img src="img/core-img/logo-small.png" alt=""></a></div> -->
        <!-- Search Form-->
        <div class="top-search-form">
          <form action="#" method="">
            <input class="form-control" type="search" placeholder="Enter your keyword">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <div class="row">
          <div class="col-6"><a href="<?= base_url('app_control/cart')?>">
            <i class="lni lni-cart-full"><span class="cart-count"><?php if(!empty($count_cart)){
              echo $count_cart;  } else{ echo '0';} ?></span></i>
          </a></div>
          <div class="col-6"><a href="<?= base_url('app_control/profile')?>"><i class="lni lni-user"></i></a></div>
        </div>

        <!-- Navbar Toggler-->
        
      </div>
    </div>