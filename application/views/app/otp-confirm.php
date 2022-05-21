<div class="login-wrapper d-flex align-items-center justify-content-center text-center">
       <div class="background-shape"></div> 
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
            <div class="text-start px-4">
              <h5 class="mb-1 text-white">Verify Phone Number</h5>
              <p class="mb-4 text-white">Enter the OTP code sent to<strong class="ms-1">+880 106 236 175</strong></p>
            </div>
            <!-- OTP Verify Form-->
            <div class="otp-verify-form mt-5 px-4">
              <form action="<?= base_url('app_control/otp_check')?>" method="post">
                <div class="d-flex justify-content-between mb-5">
                  <input class="single-otp-input form-control" name="first" required type="text" value="" placeholder="-" maxlength="1">
                  <input class="single-otp-input form-control" name="second" required type="text" value="" placeholder="-" maxlength="1">
                  <input class="single-otp-input form-control" name="third" required type="text" value="" placeholder="-" maxlength="1">
                  <input class="single-otp-input form-control" name="forth" required type="text" value="" placeholder="-" maxlength="1">
                </div>
                <button class="btn btn-info btn-lg w-100" type="submit">Verify &amp; Proceed</button>
              </form>
            </div>
            <!-- Term & Privacy Info-->
            <div class="login-meta-data px-4">
              <p class="mt-3 mb-0">Don't received the OTP?<span class="otp-sec ms-1 text-white" id="resendOTP"></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>