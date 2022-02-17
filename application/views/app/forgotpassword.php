<div class="login-wrapper d-flex align-items-center justify-content-center text-center"> 
    <div class="background-shape"></div>              
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
            <!-- <img class="big-logo" src="img/core-img/logo-white.png" alt=""> -->
            <h2 style="color: white; font-weight: 700;">ORANGE</h2>
            <!-- Register Form-->
            <div class="register-form mt-5 px-4">
              <form action="<?= base_url('app_control/forgetpassword_success')?>"  method="post">
                <div class="form-group text-start mb-4"><span>Username or Mobile</span>
                  <label for="email"><i class="lni lni-user"></i></label>
                  <input class="form-control" id="check_user" name="check_user" type="text" required placeholder="Designing World">
                </div>
                <a href="<?= base_url('app_control/forgetpassword_success')?>" class="btn btn-info btn-lg w-100">Reset Password</a>
                <!-- <button class="btn btn-info btn-lg w-100" type="submit">Reset Password</button> -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>