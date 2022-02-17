<div class="page-content-wrapper">
      <div class="container">
        <div class="pt-3">
        <!-- <?php echo form_open('website/order'); ?> -->
          <div class="row">
              <div class="col-md-12"><h5>Checkout</h5><hr></div>
                    <div class="col-md-8 mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                  <div class="card-header">
                                   <h5>Pankaj Tiwari<!-- <?php echo $this->session->userdata('name')?> --></h5>
                                  </div>
                                  <div class="card-body">
                                    <p>pmt.pankaj29@gmail.com</p>
                                    <p>+91-7051248648 </p>
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
                                        <div class="col-md-6">Order Date :<input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="orderdate"></div>
                                        <div class="col-md-6">Order Time :<input type="time" class="form-control"  value="<?php echo date('h:i'); ?>" name="ordertime"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"><strong>Delivery Details</strong><hr></div>
                                        <div class="col-md-8">Address : <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea></div>
                                        <div class="col-md-4">Pincode :<input type="number" class="form-control"  value="" name="pincode"></div>
                                        <div class="col-md-6">State :<input type="text" class="form-control" value="Jharkhand" readonly name="state"></div>
                                        <div class="col-md-6">Delivery Zone  :<input type="text" readonly class="form-control"  value="Ranchi" name="deliveryzone"></div>
                                        <div class="col-md-6">Land Mark :<input type="text" class="form-control" value="" placeholder="Enter Land Mark" name="landmark"></div>
                                        <div class="col-md-6">Contact No.  :<input type="text" class="form-control" placeholder="Enter Mobile Number"   name="contact"></div>
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
                    <li class="list-group-item"><div class="row"><div class="col-md-12">Rs.<!-- <?php echo $this->session->userdata('totalamount')?> -->2000 + 50.00 (delivery charge)</div><div class="col-md-12" ><a  href="<?= base_url('app_control/make_payment');?>" name="submit" class="btn btn-success form-control">Checkout</a> </div></div></li>   
                   </ul>
                </div>
            </div>
        </div>
        <div class="space"></div>
    </div>
  </div>
</div>

  