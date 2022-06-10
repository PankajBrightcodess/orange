<section class="content">
      <div class="container-fluid">
    	<div class="row">
        	<div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        	<div class="col-md-4 col-lg-3">
                                <?php echo form_open_multipart('admin/add_product');?>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_dropdown(array('name' => 'catg_id', 'id' => 'catg_id', 'class' => 'form-control', 'required' => 'true','title'=>'Category'), $categorys); ?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 pro_type">
                                        <?php echo form_dropdown(array('name' => 'type_id', 'id' => 'type_id', 'class' => 'form-control', 'required' => 'true','title'=>'Product type')); ?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_dropdown(array('name' => 'brand_id', 'id' => 'brand_id', 'class' => 'form-control', 'required' => 'true','title'=>'Brand')); ?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'product_name','id'=>'activate_menu','class'=>'form-control','placeholder'=>'Enter Product Name','required'=>'true','title'=>'Product Name'));?>
                                    </div>                                    
                                </div>
                                 <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'file','name'=>'image','id'=>'activate_menu','class'=>'form-control','required'=>'false','title'=>'Image'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'number','name'=>'price','id'=>'price','class'=>'form-control price','placeholder'=>'Enter Price','required'=>'true','title'=>'Price'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'number','name'=>'offer_price','id'=>'offer_price','class'=>'form-control amount offer_price','placeholder'=>'Enter Offer Price','required'=>'true','title'=>'Offer Price'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'discount','id'=>'discount','class'=>'form-control discount','placeholder'=>'Enter Discount','required'=>'true','title'=>'Discount'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'description','id'=>'activate_menu','class'=>'form-control','placeholder'=>'Enter Description','required'=>'true','title'=>'Description'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <?php echo form_submit(array('name'=>'save_cat','id'=>'save_cat','class'=>'form-control btn btn-success','value'=>'Submit'));?>
                                    </div>
                                    <div class="col-md-4"></div>                                    
                                </div>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-md-1 col-lg-1"></div>
                        	<div class="col-md-7 col-lg-8 table-responsive">
                            	<table class="table data-table stripe hover nowrap table-bordered">
                                    <thead>
                                        <tr>    
                                            <th>#</th>
                                            <th>Category</th>                                            
                                            <th>Product Type</th>                                            
                                            <th>Brand</th>                                            
                                            <th>Product Name</th>                                            
                                            <th>Price</th>                                            
                                            <th>Offer Price</th>                                            
                                            <th>Discount</th>                                            
                                            <th>Image</th>                                            
                                            <th>Description</th>                                        
                                            <th>Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php if(!empty($products)){ $i=0;
                                                foreach ($products as $key => $row) { $i++;
                                                   ?>
                                                   <tr>
                                                      <td><?php echo $i;?></td>
                                                      <td ><?php echo $row['category_name'];?></td>
                                                      <td><?php echo $row['product_type'];?></td>
                                                      <td><?php echo $row['brand'];?></td>
                                                      <td><?php echo $row['product_name'];?></td>
                                                      <td><?php echo $row['price'];?></td>
                                                      <td><?php echo $row['offer_price'];?></td>
                                                      <td><?php echo $row['discount'];?></td>
                                                      <td><img src="<?= base_url($row['image']);?>" class="img-fluid" height="100" width="100"> </td>
                                                      <td style="width: 20px;"><?php echo $row['description'];?></td>
                                                        
                                                      <td><span class="float-right">
                                                        <a href='<?php echo base_url("admin/image/?id=$row[id]");?>'><button class="btn btn-xs btn-info" title="Add Image"><i class="fa fa-picture-o" aria-hidden="true"></i></button></a>
                                                        
                                                         <button type="button" class="btn btn-success btn-xs updt" title
                                                         ="Edit" data-id="<?php echo $row['id'];?>" data-catg_id="<?php echo $row['catg_id'];?>" data-type_id="<?php echo $row['type_id'];?>" data-product_name="<?php echo $row['product_name'];?>" data-price="<?php echo $row['price'];?>" data-brand_id="<?php echo $row['brand_id'];?>" data-offer_price="<?php echo $row['offer_price'];?>" data-discount="<?php echo $row['discount'];?>" data-description="<?php echo $row['description'];?>" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i></button>
                                                         <a href='<?php echo base_url("admin/product_delete/?id=$row[id]");?>'><button class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button></a>
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
       <?php echo form_open_multipart('admin/update_product');?>
      <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_dropdown(array('name' => 'catg_id', 'id' => 'model_catg_id', 'class' => 'form-control', 'required' => 'true','title'=>'Category'), $categorys); ?>

                                        <input type="hidden" name="id" id="id">
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 pro_type">
                                        <?php echo form_dropdown(array('name' => 'type_id', 'id' => 'model_type_id', 'class' => 'form-control', 'required' => 'true','title'=>'Product type')); ?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_dropdown(array('name' => 'brand_id', 'id' => 'model_brand_id', 'class' => 'form-control', 'required' => 'true','title'=>'Brand')); ?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'product_name','id'=>'activate_menu','class'=>'form-control product_name','placeholder'=>'Enter Product Name','required'=>'true','title'=>'Product Name'));?>
                                    </div>                                    
                                </div>
                                 <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'file','name'=>'image','id'=>'activate_menu','class'=>'form-control','title'=>'Image'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'number','name'=>'price','id'=>'pricee','class'=>'form-control price','placeholder'=>'Enter Price','required'=>'true','title'=>'Price'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'number','name'=>'offer_price','id'=>'offer_pricee','class'=>'form-control change_amount','placeholder'=>'Enter Offer Price','required'=>'true','title'=>'Offer Price'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'discount','id'=>'discounts','class'=>'form-control discount','placeholder'=>'Enter Discount','required'=>'true','title'=>'Discount'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'description','id'=>'activate_menu','class'=>'form-control description','placeholder'=>'Enter Description','required'=>'true','title'=>'Description'));?>
                                    </div>                                    
                                </div>
                               <!--  <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                       
                                    </div>
                                    <div class="col-md-4"></div>                                    
                                </div> -->
           
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <?php echo form_submit(array('name'=>'','id'=>'save_cat','class'=>'form-control btn btn-success','value'=>'Update'));?>
        <!-- <button type="submit" class="btn btn-info">Update</button> -->
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
            debugger;
            var id = $(this).data('id');
            var catg_id = $(this).data('catg_id');
            var type_id = $(this).data('type_id');
            var brand_id = $(this).data('brand_id');
            var product_name = $(this).data('product_name');
            var price = $(this).data('price');
            var offer_price = $(this).data('offer_price');
            var discount = $(this).data('discount');
            var description = $(this).data('description');

            $('#id').val(id);
            $('#model_catg_id').val(catg_id);
            $('.product_name').val(product_name);
            $('#pricee').val(price);
            $('#offer_pricee').val(offer_price);
            $('#discounts').val(discount);
            $('.description').val(description);
            var catg_id=$('#model_catg_id').val();
           $.ajax({
            type:"POST",
            url:"<?php echo base_url('admin/ajax_ptype')?>",
            data:{catg_id:catg_id},
            // dataType:"JSON",
            success: function(data){
                $('#model_type_id').html(data);
                $('#model_type_id').val(type_id);
               
            }
           });

           $.ajax({
            type:"POST",
            url:"<?php echo base_url('admin/ajax_brand')?>",
            data:{catg_id:catg_id},
            // dataType:"JSON",
            success: function(data){
                $('#model_brand_id').html(data);
                $('#model_brand_id').val(brand_id); 
            }
           });

           
        });
           
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

        $('body').on('change','#catg_id',function(){
            debugger;
            var catg_id=$(this).val();
           $.ajax({
            type:"POST",
            url:"<?php echo base_url('admin/ajax_ptype')?>",
            data:{catg_id:catg_id},
            // dataType:"JSON",
            success: function(data){
                $('#type_id').html(data);
               
            }
           });
        });

        $('body').on('keyup','.amount',function(){
                var price=$('#price').val();
                var offer_price=$('#offer_price').val();
                if(parseFloat(price)>=parseFloat(offer_price)){
                var saving = parseFloat(price)-parseFloat(offer_price);
                var final = parseFloat(saving)*100;
                var profit  = parseFloat(final).toFixed(1)/parseFloat(price).toFixed(1);
                var profit_persent =parseFloat(profit).toFixed(1)
                $('#discount').val(profit_persent);

            }else{
                alert('Please, Less your offer price from price');
                $('#offer_price').val('');
                $('#discount').val('');
            }

          
        });

         $('body').on('keyup','.change_amount',function(){
                var price=$('#pricee').val();
                var offer_price=$('#offer_pricee').val();
                if(parseFloat(price)>=parseFloat(offer_price)){
                var saving = parseFloat(price)-parseFloat(offer_price);
                var final = parseFloat(saving)*100;
                var profit  = parseFloat(final).toFixed(1)/parseFloat(price).toFixed(1);
                var profit_persent =parseFloat(profit).toFixed(1)
                $('#discounts').val(profit_persent);

            }else{
                alert('Please, Less your offer price from price');
                $('#offer_price').val('');
                $('#discount').val('');
            }

          
        });

        $('body').on('change','#catg_id',function(){
            debugger;
            var catg_id=$(this).val();
           $.ajax({
            type:"POST",
            url:"<?php echo base_url('admin/ajax_brand')?>",
            data:{catg_id:catg_id},
            // dataType:"JSON",
            success: function(data){
                $('#brand_id').html(data);
               
            }
           });
        });



        $('body').on('change','#model_catg_id',function(){
            debugger;
            var catg_id=$(this).val();
           $.ajax({
            type:"POST",
            url:"<?php echo base_url('admin/ajax_ptype')?>",
            data:{catg_id:catg_id},
            // dataType:"JSON",
            success: function(data){
                $('#model_type_id').html(data);
               
            }
           });
        });

        $('body').on('change','#model_catg_id',function(){
            debugger;
            var catg_id=$(this).val();
           $.ajax({
            type:"POST",
            url:"<?php echo base_url('admin/ajax_brand')?>",
            data:{catg_id:catg_id},
            // dataType:"JSON",
            success: function(data){
                $('#model_brand_id').html(data);
               
            }
           });
        });
        $('#parent_id').trigger('change');
    // });
</script>