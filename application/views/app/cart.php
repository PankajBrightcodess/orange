<div class="page-content-wrapper">
      <div class="container">
        <div class="pt-3">
          <div class="row g-3">
              <!-- <div class="col-md-12"> -->
                    <div class="col-md-12 mb-3">
                      <div class="card">
                          <div class="card-header">
                           My Cart
                          </div>
                          <div class="card-body">

                           <!--  <?php
                            $totaladd = 0;
                            $extra = 1000;
                            $qnty = 0;;
                            if(!empty($productdetails)){
                                foreach ($productdetails as $key => $value) {
                                $totaladd = $totaladd + $value['totalamount'];
                                $qnty = $qnty + $value['qnty'];
                                 $extra = $extra + $value['totalamount'];
                                ?>
                                <div class="row">
                                <div class="col-md-4">
                                     <img src="<?php echo base_url('assets/website/images/blue-jeans-ripped-on-knee-with-ribbon-list-wb-700x700.jpg')?>"width="50%">
                                     <p>Quantity : <?php echo $value['qnty']?></p>
                                </div>
                                 <div class="col-md-4">
                                   <strong>Product Price</strong> <br>
                                   <span style="color:red"><s><?php echo $extra;?></s></span> &nbsp;&nbsp; <span style="color:green"><?php echo $value['totalamount']?>/-</span>
                                </div>
                                 <div class="col-md-4">
                                    <strong>Product Description</strong>&nbsp;&nbsp;<a href="<?php echo base_url('website/deletecart/').$value['id']?>"><i class="fas fa-trash-alt"></i></a><hr>
                                    <p>Blue Jeans Good Looking</p>

                                </div>
                                 </div><hr>
                                <?php
                                $extra  = 1000;
                            }
                            $data['totalamount'] = $totaladd;
                            $data['quantity'] =$qnty;
                            $this->session->set_userdata($data);

                            }
                            else{
                               ?><label><strong> No Record Found !</strong></label><?php 
                            }
                            ?> -->
                           <div class="row">
                            <?php
                                if(!empty($cart_item)){
                                        $amount = 0;
                                        $extra = 0;                          
                                    foreach ($cart_item as $key => $value) {
                                        $amount = ($amount+$value['offer_price'])*$value['qty'];
                                        $extra = ($extra+$value['price'])*$value['qty'];
                                        $saving = $extra-$amount;

                                        ?>
                                            <div class="col-md-12">
                                               <strong><h5><?= $value['product_name'];?></h5></strong> <br>
                                            </div>
                                            <div class="col-md-12">
                                                 <img src="<?= base_url($value['image']);?>"width="50%">
                                                 <p>Quantity : <?= $value['qty'];?></p>
                                            </div>
                                            <div class="col-md-12">
                                               <strong>Price</strong> <br>
                                               <span style="color:red"><s>₹<?= $value['price'];?>/-</s></span> &nbsp;&nbsp; <span style="color:green">₹<?= $value['offer_price'];?>/-</span>
                                            </div>
                                            <div class="col-md-12">
                                                <strong>Product Description</strong><i class="lni lni-trash-can"></i><hr>
                                                <p><?= $value['description'];?></p>
                                            </div>

                                        <?php
                                    }
                                    
                                }
                            ?>
                                
                            </div><hr> 
                            <div class="row">
                                <div class="col-12 mb-3"><a href="<?php echo base_url('app_control/home');?>" class="btn btn-warning btn-sm form-control">Continue Shoping</a></div>
                                <div class="col-12">
                                        
                                    <a href="<?php echo base_url('app_control/checkout/'.$amount.'/'.$extra);?>" class="btn btn-success btn-sm form-control">Proceed To Checkout</a>
                                </div>
                                
                                </form>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                     <div class="card">
                          <div class="card-header">
                           Price Details
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item"><div class="row"><div class="col-md-6">Price</div><div class="col-md-6" style="float:right">₹&nbsp;<?php echo $extra;?></div></div></li>
                            <li class="list-group-item"><div class="row"><div class="col-md-6">Saving Amount</div><div class="col-md-6" style="color:red; float: right;">₹&nbsp;<?php echo $saving;?></div></div></li>
                            <li class="list-group-item"><div class="row"><div class="col-md-6">Pay Amount</div><div class="col-md-6"style="color:green; float: right;">₹&nbsp;<?php echo $amount;?></div></div></li>
                          </ul>
                        </div>
                    </div>

            </div>
            <div class="space"></div>
    </div>
</div>
</div>

  
