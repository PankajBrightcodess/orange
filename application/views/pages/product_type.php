<section class="content">
      <div class="container-fluid">
    	<div class="row">
        	<div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        	<div class="col-md-5 col-lg-4">
                                <?php echo form_open_multipart('admin/add_product_type');?>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'product_type','id'=>'activate_menu','class'=>'form-control','placeholder'=>'Enter Product Type','required'=>'true'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <?php echo form_submit(array('name'=>'save_cat','id'=>'save_cat','class'=>'form-control btn btn-success'));?>
                                    </div>
                                    <div class="col-md-4"></div>                                    
                                </div>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-md-2 col-lg-2"></div>
                        	<div class="col-md-5 col-lg-6 table-responsive">
                            	<table class="table data-table stripe hover nowrap table-bordered">
                                    <thead>
                                        <tr>    
                                            <th>#</th>
                                            <th>Stack Name</th>                                            
                                            <th>Business</th>                                            
                                                                                       
                                            <th>Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php if(!empty($categorylist)){ $i=0;
                                                foreach ($categorylist as $key => $row) { $i++;
                                                   ?>
                                                   <tr>
                                                      <td><?php echo $i;?></td>
                                                      <td ><?php echo $row['name'];?></td>
                                                      <td><img src="<?= base_url($row['image'])?>" class="img-fluid" width="20%"> </td>
                                                        
                                                      <td><span class="float-right">
                                                        <a href='<?php echo base_url("admin/delete_category/?id=$row[id]");?>'><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
                                                         <button type="button" class="btn btn-success btn-xs updt" data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['name'];?>" data-image="<?php echo $row['image'];?>" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i></button>
                                                        </span>
                                                      </td>
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
       <?php echo form_open_multipart('admin/update_category');?>
      <div class="modal-body">
       <div class="row">
           <div class="col-md-12 col-lg-12 col-12 mb-2">
               <label>Name</label>
               <input type="text" name="name" id="name" class="form-control" placeholder="Name :">
               <input type="hidden" name="id" id="id" class="form-control" placeholder="Name :">
           </div>
           <div class="col-md-12 col-lg-12 col-12 mb-2">
                <label>Image</label>
                <img src="" id="images" class="img-fluid">
               <input type="file" name="image" id="image" class="form-control" >
           </div>
           
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Update</button>
      </div>
      <?php echo form_close();?>
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
            var image = $(this).data('image');
            
          
            $('#id').val(id);
            $('#name').val(name);
            $('#images').src(image);
           
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