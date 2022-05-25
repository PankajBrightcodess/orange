<?php 
$someprice = $payment['amount'];
$paisaprice = $someprice*100;
$orderno = $payment['request_no'];
$custname = $payment['name'];
$productinfo = 'Order From Customer';
$txnid = time();
$surl = base_url("app_control/success/");
$furl = base_url("app_control/success/");
$key_id = API_KEY;
$currency_code = 'INR';
$total = $paisaprice; 
$amount = $someprice;
$merchant_order_id = strtoupper(random_string('alpha', 4)).random_string('numeric', 4);
$card_holder_name = $custname;
$email =  $payment['email'];
$phone = $payment['contact'];
$name = "Customer of $custname - $orderno";
$return_url = site_url().'razorpay/callback';
?>
<div class="page-content-wrapper">
      <div class="container">
        <div class="pt-3">
          <div class="row">
              <div class="col-md-12"><h5>Make Payment</h5><hr></div>
                    <div class="col-md-12">
                         <div class="card">
                          <div class="card-header">
                               <h5><?php echo $custname;?></h5>  <!-- //name -->
                         </div>
                          <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                    <p><?php echo $email;?></p> <!-- //Email -->
                                    <p>+91-<?php echo $phone;?></p>  <!-- //contact -->
                                  <hr>
                            </div>
                                <div class="col-md-12 text-center">
                                    Request Details<hr>
                                </div>
                                <div class="col-md-6 text-center">
                                    Request No : 
                                </div>
                                <div class="col-md-6 text-center">
                                   <?php echo $orderno;?>
                                </div>
                                <div class="col-md-6 text-center">
                                   Order Total Amount:
                                </div>
                                <div class="col-md-6 text-center">
                                   <strong style="color:red;">  <?php echo $someprice;?></strong>
                                </div>
                               <!--  </div> -->
                                <div class="col-md-12 text-center">
                                     <?php echo form_open('app_control/success','id="razorpay-form"'); ?>
                                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                                        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                                        <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                                        <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
                                        <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                                        <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                                        <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
                                        <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
                                        <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
                                        <input type="hidden" name="order_id" id="order_id" value="<?php echo $merchant_order_id; ?>">
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('pay_id'); ?>">
                                        <!-- <button class='btn btn-danger btn-outline-warning'>MAKE PAYMENT</button> -->
                                        <input  id="submit-pay" type="button" onclick="razorpaySubmit(this);" value="PAY NOW" class="btn btn-sm btn-success" />
                                        </form>
                                </div>
                            </div>
                            </div>
                        </div><br>
                    </div>
                    <div class=" clearfix"></div>
            </div>
         </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>   
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var razorpay_options = {
        key: "<?php echo $key_id; ?>",
        amount: "<?php echo $total; ?>",
        name: "<?php echo $name; ?>",
        description: "Order # <?php echo $merchant_order_id; ?>",
        netbanking: true,
        currency: "<?php echo $currency_code; ?>",
        prefill: {
        name:"<?php echo $card_holder_name; ?>",
        email: "<?php echo $email; ?>",
        contact: "<?php echo $phone; ?>"
        },
        notes: {
        soolegal_order_id: "<?php echo $merchant_order_id; ?>",
        },
        handler: function (transaction) {
            document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
            document.getElementById('razorpay-form').submit();
        },
        "modal": {
            "ondismiss": function(){
                location.reload()
            }
        }
    };
    var razorpay_submit_btn, razorpay_instance;

    function razorpaySubmit(el){
        if(typeof Razorpay == 'undefined'){
        setTimeout(razorpaySubmit, 200);
        if(!razorpay_submit_btn && el){
            razorpay_submit_btn = el;
            el.disabled = true;
            el.value = 'Please wait...';  
        }
        } else {
        if(!razorpay_instance){
            razorpay_instance = new Razorpay(razorpay_options);
            if(razorpay_submit_btn){
            razorpay_submit_btn.disabled = false;
            razorpay_submit_btn.value = "Pay Now";
            }
        }
        razorpay_instance.open();
        }
    }  
</script>
<script>
        $('document').ready(function(){
            setTimeout(function() {
                $('#msgpopup').click();
            },5000); 
            countdown();
        });
            
        function countdown(){
            // Set the date we're counting down to
            // 1. JavaScript
            // var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
            // 2. PHP
            var countDownDate = <?php if(!isset($differencemin)){$totime = $orderdetails['time_duration']; echo strtotime('+'.$totime.'minutes');}else{ echo strtotime('+'.$differencemin.'minutes');} ?> * 1000;
            var now = <?php echo time() ?> * 1000;

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get todays date and time
                // 1. JavaScript
                // var now = new Date().getTime();
                // 2. PHP
                now = now + 1000;

                // Find the distance between now an the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("timeremain").innerHTML = /*days + "d " +  hours + "h " +*/
                    minutes + "min " + seconds + "sec ";
                updatecur_time();
                // If the count down is over, write some text 
                if (distance <= 0) {
                    clearInterval(x);
                    location.reload();
                    //document.getElementById("timeremain").innerHTML = "EXPIRED";
                    //$('#submit_exam').trigger('click');
                }
            }, 1000);
        } 
 </script>

  