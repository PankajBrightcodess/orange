<div class="offcanvas offcanvas-start suha-offcanvas-wrap" tabindex="-1" id="suhaOffcanvas" aria-labelledby="suhaOffcanvasLabel">
      <!-- Close button-->
      <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      <!-- Offcanvas body-->
      <div class="offcanvas-body">
        <!-- Sidenav Profile-->
        <div class="sidenav-profile">
          <div class="user-profile"><!-- <img src="<?= base_url('assets/app_assets/img/bg-img/9.jpg')?>" alt=""> --></div> 
          <div class="user-info">
            <h6 class="user-name mb-1">ORANGE</h6>
            <!-- <p class="available-balance">Total balance $<span class="counter">583.67</span></p> -->
          </div>
        </div>
        <!-- Sidenav Nav-->
        <ul class="sidenav-nav ps-0">
          <li><a href="<?= base_url('app_control/home')?>"><i class="lni lni-user"></i>Home</a></li>
          <!-- <li><a href="notifications.html"><i class="lni lni-alarm lni-tada-effect"></i>Notifications<span class="ms-3 badge badge-warning">3</span></a></li> -->
          <li><a href="<?= base_url('app_control/product_page')?>"><i class="lni lni-infinite"></i>Products</a></li>
        <!--  <li class="suha-dropdown-menu"><a href="#"><i class="lni lni-rupee"></i>Accounts</a>
            <ul>
              <li><a href="#">- Stakes Details</a></li>
              <li><a href="#">- Order Details</a></li>
              <li><a href="#">- Wallet</a></li>
              <li><a href="#">- Customer Support</a></li>
            </ul>
          </li> --> 
          <li><a href="<?= base_url('app_control/account')?>"><i class="lni lni-rupee"></i>Accounts</a></li>
          <li><a href="<?= base_url('app_control/sharelink')?>"><i class="lni lni-joomla"></i>Invite</a></li>
          <li><a href="<?= base_url('app_control/history')?>"><i class="lni lni-notepad"></i>History</a></li>
         <!--  <li class="suha-dropdown-menu"><a href="wishlist-grid.html"><i class="lni lni-heart"></i>My Wishlist</a>
            <ul>
              <li><a href="wishlist-grid.html">- Wishlist Grid</a></li>
              <li><a href="wishlist-list.html">- Wishlist List</a></li>
            </ul>
          </li> -->
          <!-- <li><a href="settings.html"><i class="lni lni-cog"></i>Settings</a></li> -->
          <li><a href="<?= base_url('app_control/login')?>"><i class="lni lni-power-switch"></i>Sign Out</a></li>
        </ul>
      </div>
    </div>