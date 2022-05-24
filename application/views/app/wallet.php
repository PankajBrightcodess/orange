 <div class="page-content-wrapper">
      <!-- Top Products-->
      <div class="top-products-area py-3">
        <div class="container">
          <div class="product-catagories">
            <div class="card">
                <div class="card-body">
                  <div class="row text-center">
                    <div class="col-12"><span>Balance</span></div>
                    <div class="col-12"><h4 style="font-weight: 900;"><i class="lni lni-rupee"></i><?php echo $member_wallet['cradit'];?></h4></div>
                  </div>
                </div>
              </div>
          </div>
          <div class="product-catagories">
            <div class="row g-3">
              <div class="col-6"><a class="shadow-sm" href="#"><img src="" alt="">Transcation</a></div>
              <div class="col-6"><a class="shadow-sm" href="<?= base_url('app_control/order_status')?>"><img src="img/product/9.png" alt="">Recharge </a></div>
            </div>
          </div>
          <div class="row g-3">
            <!-- Single Top Product Card -->
            <div class="col-12 mb-3">
              <div class="card">
                <div class="card-body">
                    <form>
                      <div class="row">
                        <?php if(!empty($amount['final_amount'])){
                          ?> <div class="col-12 mb-4"><input type="text" name="balance"  value="<?php echo $amount['final_amount'];?>" readonly class="form-control balance" placeholder="Amount"></div><?php

                        }else{
                          ?> <div class="col-12 mb-4"><input type="text" name="balance"  class="form-control balance" placeholder="Amount"></div><?php
                        }
                        ?>
                        <input type="hidden" class="wallet_balance" value="<?php echo $member_wallet['cradit'];?>">
                        <div class="col-12"><input type="button" name="" id="pay" class="form-control btn btn-sm btn-success" value="Pay Now"></div>
                        <div class="col-12"></div>
                        <div class="col-12"></div>
                      </div>
                    </form>
                  <!-- Badge-->
                </div>
              </div>
            </div>
          </div>
          <div class="row g-3">
            <!-- Single Top Product Card -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                   <div class="row" style="background:gray; color: white;font-size: 11px; font-weight: 300;">
                    <div class="col-4"><span><strong>Date</strong></span></div>
                    <div class="col-4"><span><strong>Amount</strong></span></div>
                    <div class="col-4"><span><strong>Transcation</strong></span></div>
                    
                  </div>
                  <div class="row"><div class="col-md-12 mb-3"></div></div>
                  <div class="row">
                      <?php
                        if(!empty($wallet_list)){
                          // echo PRE;
                          // print_r($wallet_list);die;
                          foreach ($wallet_list as $key => $value) {
                            ?>
                              <!-- 1/1/2022 -->
                             <div class="col-4"><span class="badge rounded-pill badge-warning"><?php echo date('d/m/Y',strtotime($value['added_on']));?></span></div>
                             <div class="col-4" style="font-size:14px"><?php echo $value['trans_amount'];?>/-<i class="lni lni-rupee"></i></div>
                             <div class="col-4">
                                  <?php
                                    if($value['trans_type']=='Withdraw'){
                                      ?><div class="col-4"><span class="badge rounded-pill badge-danger">Withdraw</span></div><?php
                                    }else{
                                      ?><span class="badge rounded-pill badge-success">Recharge</span><?php
                                    }
                                  ?>
                             </div>
                             <div class="col-12"><hr></div>
                            <?php
                          }
                        }
                      ?>
                     <!-- <div class="col-4"><span class="badge rounded-pill badge-warning">8/1/2022</span></div>
                    <div class="col-4" style="font-size:14px">440/-<i class="lni lni-rupee"></i></div>
                    <div class="col-4"><span class="badge rounded-pill badge-danger">Withdraw</span></div>
                    <div class="col-12"><hr></div>
                     <div class="col-4"><span class="badge rounded-pill badge-warning">27/1/2022</span></div>
                    <div class="col-4" style="font-size:14px">800/-<i class="lni lni-rupee"></i></div>
                    <div class="col-4"><span class="badge rounded-pill badge-success">Recharge</span></div>
                    <div class="col-12"><hr></div>
                   <div class="col-4"><span class="badge rounded-pill badge-warning">10/2/2022</span></div>
                    <div class="col-4" style="font-size:14px">440/-<i class="lni lni-rupee"></i></div>
                    <div class="col-4"><span class="badge rounded-pill badge-success">Recharge</span></div> -->
                  </div>
                  <!-- Badge-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>