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
                                            <th>Product Name</th>                                       
                                            <th>Amount</th>                             
                                            <th>Quantity</th>                                        
                                            <th>Total</th>                                       
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php if(!empty($orderproduct)){ 
                                            $i=0;
                                            foreach ($orderproduct as $key => $row) {
                                                $i++;
                                               ?>
                                               <tr>
                                                <td ><?php echo $i;?></td>
                                                <td><?php echo $row['product_name'];?></td>
                                                <td><?php echo $row['offer_price'];?></td>
                                                <td><?php echo $row['qnty'];?></td>  
                                                <td><?php echo $row['offer_price']*$row['qnty'];?></td>  
                                                <td><img src="<?= base_url($row['image']);?>" class="img-fluid" height="100" width="100"></td>
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
        <h5 class="modal-title" id="exampleModalLabel">User List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?= base_url('admin/update_user');?>">
      <div class="modal-body">
       <div class="row">
           <div class="col-md-12 col-lg-12 col-12 mb-2">
               <label>Name</label>
               <input type="text" name="name" id="name" class="form-control" placeholder="Name :">
               <input type="hidden" name="id" id="id" class="form-control" placeholder="Name :">
           </div>
           <div class="col-md-12 col-lg-12 col-12 mb-2">
                <label>User Name</label>
               <input type="text" name="username" id="username" class="form-control" placeholder="User Name :">
           </div>
           <div class="col-md-12 col-lg-12 col-12 mb-2">
               <label>Email</label>
               <input type="email" name="email" id="email" class="form-control" placeholder="Email :">
           </div>
           <div class="col-md-12 col-lg-12 col-12 mb-2">
                <label>Mobile No.</label>
               <input type="text" name="contact" id="contact" class="form-control" placeholder="Mobile No. :">
           </div>
           <div class="col-md-12 col-lg-12 col-12 mb-2">
                 <label>Password</label>
               <input type="text" name="password" id="password" class="form-control" placeholder="Password :">
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
            var id = $(this).data('id');
            var name = $(this).data('name');
            var username = $(this).data('username');
            var email = $(this).data('email');
            var contact = $(this).data('contact');
            var password = $(this).data('password');
          
            $('#id').val(id);
            $('#name').val(name);
            $('#username').val(username);
            $('#email').val(email);
            $('#contact').val(contact);
            $('#password').val(password);
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