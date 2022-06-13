<div class="page-content-wrapper">
      <div class="container">
        <div class="pt-3">
         <?php echo form_open('app_control/order_placed'); ?>
          <div class="row">
              <div class="col-md-12"><h5>Checkout</h5><hr></div>
                    <div class="col-md-8 mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                  <div class="card-header">
                                   <h5><?php echo $member_details['name'];?></h5>
                                  </div>
                                  <div class="card-body">
                                    <p><?php echo $member_details['email'];?></p>
                                    <p>+91-<?php echo $member_details['contact'];?> </p>
                                  </div>
                                </div>
                            </div>
                        </div><br>
                         <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                  <div class="card-header">
                                   Products
                                  </div>
                                  <div class="card-body">
                                   
                                    <div class="row">
                                        <div class="col-md-12"><strong>Products</strong><span style="color:red">(same day delivery not available)</span><hr></div>
                                        <div class="col-md-6">Order Date :<input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="order_date"></div>
                                        <div class="col-md-6">Order Time :<input type="time" class="form-control"  value="<?php echo date('h:i'); ?>" name="order_time"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"><strong>Delivery Details</strong><hr></div>
                                        <div class="col-md-8">Address : <textarea class="form-control" name="delivery_address" id="exampleFormControlTextarea1" required="true" rows="3"></textarea></div>
                                        <div class="col-md-4">Pincode :<input type="number" class="form-control"  value="" required="true" name="pincode"></div>
                                        <div class="col-md-6">State :<input type="text" class="form-control" value="" required="true"  name="state"></div>
                                        <div class="col-md-6">Delivery Zone  :<input type="text"  class="form-control" required="true"  value="Ranchi" name="deliveryzone"></div>
                                        <div class="col-md-6">Land Mark :<input type="text" class="form-control" value="" required="true" placeholder="Enter Land Mark" name="landmark"></div>
                                        <div class="col-md-6">Contact No.  :<input type="text" class="form-control" required="true" placeholder="Enter Mobile Number"   name="contact"><input type="hidden" class="form-control" required="true" placeholder="Amount"   name="amount" value="<?php echo $amount; ?>"></div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>                      
                    </div>
                    <div class="col-md-4">
                     <div class="card">
                       <div class="card-header">Grand Total</div>
                   <ul class="list-group list-group-flush">
                    <li class="list-group-item"><div class="row"><div class="col-md-12">₹<!-- <?php echo $this->session->userdata('totalamount')?> --><?php echo $amount; ?> + 00.00 (delivery charge)</div><div class="col-md-12" ><input type="submit" class="btn btn-success form-control" name="" value="Checkout" name="checkout"></div></li>   
                   </ul>
                </div>
            </div>
        </div>
        <?php echo form_close();?>
        <div class="space"></div>
    </div>
  </div>
</div>

  