<section class="content">
      <div class="container-fluid">
    	<div class="row">
        	<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	<h3 class="card-title"><?php echo $title; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div class="row">
                        	<div class="col-md-12 col-lg-12 table-responsive">
                            	<table class="table data-table stripe hover nowrap table-bordered">
                                    <thead>
                                        <tr>    
                                            <th>#</th>
                                            <th>Order No</th>                                       
                                            <th>Order Date/Time</th>                             
                                            <th>Member Name</th>                            
                                            <th>Conact No.</th>                                      
                                            <th>Email</th>                                       
                                            <th>Delivery Address</th>
                                            <th>Pin Code</th>
                                            <th>State</th>
                                            <th>Amount</th>                                        
                                            <th>Payment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php if(!empty($orderlist)){ 
                                            $i=0;
                                            foreach ($orderlist as $key => $row) {
                                                $i++;
                                               ?>
                                               <tr>
                                                <td ><?php echo $i;?></td>
                                                <td><?php echo $row['order_no'];?></td>
                                                <td><?php echo date('d-m-Y',strtotime($row['order_date'])).'['.$row['order_time'].']';?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $row['mobile_no'];?></td>  
                                                <td><?php echo $row['email'];?></td>  
                                                <td><?php echo $row['delivery_address'];?></td>  
                                                <td><?php echo $row['pincode'];?></td>  
                                                <td><?php echo $row['state'];?></td>  
                                                <td><?php echo $row['amount'];?></td>  
                                                <td><?php if($row['payment_status']==1){?>
                                                    <button type="button" class="btn btn-success"><span class="badge">Paid</span></button>    
                                                     <?php }else{ ?><button type="button" class="btn btn-danger"><span class="badge">Unpaid</span></button><?php } ;?>
                                                </td>  
                                                <td><span class="float-right">
                                                <a href='<?php echo base_url("admin/delete_productid/?id=$row[id]");?>'><button class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Delete"></i></button></a>
                                                <a href="<?php echo base_url("admin/order_product/".$row['order_no']);?>" class="btn btn-info btn-xs" title="Product List"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
                                                <button type="button" title="Status Update" class="btn btn-success btn-xs updt" data-order_no="<?php echo $row['order_no'];?>"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i></button>
                                                </span></td>
                                            </tr>
                                         <?php
                                            }
                                     }

                                     ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>    
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalLabel">Update Delivery Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?= base_url('admin/update_delivery_status');?>">
      <div class="modal-body">
       <div class="row">
           <div class="col-md-12 col-lg-12 col-12 mb-2">
               <input type="hidden" name="order_id" id="order_no" class="form-control" placeholder="Name :">
           </div>
           <div class="col-md-12 col-lg-12 col-12 mb-2">
                <label>Delivery Status</label>
                <select class="form-control" name="order_status">
                    <option value="1">Ordered</option>
                    <option value="2">Shipped</option>
                    <option value="3">Out For Delivery</option>
                    <option value="4">Delivered</option>
                </select>
           </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Update</button>
      </div>
    </form>
  </div>
</div>
<!-- Model Close -->
<script>
	
	$(document).ready(function(e) {
        $('.hoverable').mouseenter(function(){
            //$('[data-toggle="popover"]').popover();
            $(this).popover('show');                    
        }); 

        $('.hoverable').mouseleave(function(){
            $(this).popover('hide');
        });

        $('body').on('click','.updt',function(e){
            var order_no = $(this).data('order_no');
            $('#order_no').val(order_no);
       });

        $('.duplicate').click(function(){
            var dupid = $(this).data('dupid');
            $.ajax({
                url:"<?php echo base_url('home/ajax_sidebar') ;?>",
                method:"POST",
                data:{dupid:dupid},
                success:function(data){
                    //console.log(data);
                    var setdata = JSON.parse(data);
                    //console.log(setdata);
                    $('#activate_menu').val(setdata.activate_menu);
                    $('#activate_not').val(setdata.activate_not);
                    $('#base_url').val(setdata.base_url);
                    $('#icon').val(setdata.icon);
                    $('#parent_id').val(setdata.parent).trigger('change');
                    $('#position').val(setdata.position);
                    var role_text = setdata.role_id;                    
                    $('#roles').val(role_text);
                    $('#status').val(setdata.status);
                }
            });
        });
        
		var table=$('.data-table').DataTable({
			scrollCollapse: true,
			autoWidth: false,
			responsive: true,
			columnDefs: [{
				targets: "no-sort",
				orderable: false,
			}],
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"language": {
				"info": "_START_-_END_ of _TOTAL_ entries",
				searchPlaceholder: "Search"
			},
		});		
        
		$('body').on('change','#parent_id',function(){
			var parent_id=$(this).val();
			var option="<select name='position' id='position' class='form-control' required>";
			option+="<option value=''>Select </option>";
			option+="<option value='0'>Top</option>";
			$.ajax({
				type:"POST",
				url:"<?php echo base_url("home/getOrderList"); ?>",
				data:{parent_id:parent_id},
				dataType:"json",
				beforeSend: function(){
					//$(".box-overlay").show();
				},
				success: function(data){
					$(data).each(function(i, val) {
						option+="<option value='"+val['position']+"'>After "+val['name']+"</option>";
					});
					option+='</select>';
					$('#position').replaceWith(option);
					$('.box-overlay').hide();
				}
			});
		});
        $('#parent_id').trigger('change');
    });
</script>