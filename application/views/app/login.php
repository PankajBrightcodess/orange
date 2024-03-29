 <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
      <!-- Background Shape-->
      <div class="background-shape"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><!-- <img class="big-logo" src="img/core-img/logo-white.png" alt=""> --><h2 style="color:white">ORANGE</h2>
            <!-- Register Form-->
            <div class="register-form mt-5 px-4">
              <form action="<?= base_url('app_control/check_login')?>" method="POST">
                <div class="form-group text-start mb-4"><span>Username</span>
                  <label for="username"><i class="lni lni-user"></i></label>
                  <input class="form-control" id="username" name="username"  type="text" placeholder="info@example.com">
                </div>
                <div class="form-group text-start mb-4"><span>Password</span>
                  <label for="password"><i class="lni lni-lock"></i></label>
                  <input class="form-control" id="password" name="password"  type="password" placeholder="Password">
                </div>
                <div class="form-group text-start mb-4"><span>Referral Code (Optional)</span>
                  <label for="referral"><i class="lni lni-invention"></i></label>
                  <input class="form-control" id="password" name="referral" type="text" placeholder="Referral Code">
                </div>
                <button class="btn  btn-info btn-lg w-100" type="submit">Log In</button>
              </form>
            </div>
            <!-- Login Meta-->
            <div class="login-meta-data"><a class="forgot-password d-block mt-3 mb-1" href="<?= base_url('app_control/forgot_password')?>">Forgot Password?</a>
              <p class="mb-0">Didn't have an account?<a class="ms-1" href="<?= base_url('app_control/register')?>">Register Now</a></p>
            </div>
            <!-- View As Guest-->
            <div class="view-as-guest mt-3"><a class="btn" href="#">View as Guest</a></div>
          </div>
        </div>
      </div>
    </div>

