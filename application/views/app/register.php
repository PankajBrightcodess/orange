<div class="login-wrapper d-flex align-items-center justify-content-center text-center">
      <!-- Background Shape-->
      <div class="background-shape"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
            <!-- <img class="big-logo" src="img/core-img/logo-white.png" alt=""> -->
            <h2 style="color: white; font-weight:700">ORANGE</h2>
            <!-- Register Form-->
            <div class="register-form mt-5 px-4">
              <form action="<?= base_url('app_control/otp')?>" method="post">
                <div class="form-group text-start mb-4"><span>Username</span>
                  <label for="username"><i class="lni lni-user"></i></label>
                  <input class="form-control" id="username" type="text" placeholder="User Name">
                </div>
                <div class="form-group text-start mb-4"><span>Email</span>
                  <label for="email"><i class="lni lni-envelope"></i></label>
                  <input class="form-control" id="email" type="email" placeholder="help@example.com">
                </div>
                 <div class="form-group text-start mb-4"><span>Contact No.</span>
                  <label for="email"><i class="lni lni-phone"></i></label>
                  <input class="form-control" id="contact" type="text" placeholder="Contact No.">
                </div>
                <div class="form-group text-start mb-4"><span>Password</span>
                  <label for="password"><i class="lni lni-lock"></i></label>
                  <input class="input-psswd form-control" id="registerPassword" type="password" placeholder="Password">
                </div>
                 <div class="form-group text-start form-check mb-4">
                    <input class="form-check-input" id="registration" type="checkbox">
                    <span sty>I Agree (Term & Condition)</span>
                    <!-- <label  for="Registration" style="color:white;">I Agree(Term & Condition)</label> -->
                  </div>
                <button class="btn btn-info btn-lg w-100" type="submit">Sign Up</button>
              </form>
            </div>
            <!-- Login Meta-->
            <div class="login-meta-data">
              <p class="mt-3 mb-0">Already have an account?<a class="ms-1" href="<?= base_url('app_control/login')?>">Sign In</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>