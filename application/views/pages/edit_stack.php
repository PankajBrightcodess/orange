<section class="content">
      <div class="container-fluid">
    	<div class="row">
        	<div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                    	<h3 class="card-title"><?php echo $title; ?></h3>
                    </div> -->
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div class="row">
                        	<div class="col-md-5 col-lg-4">
                                <?php echo form_open_multipart('admin/update_stack');?>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'stack_name','id'=>'activate_menu','class'=>'form-control','placeholder'=>'Enter Stack','value'=>$list[0]['stack_name'],'required'=>'true'));?>
                                        <input type="hidden" name="id" value="<?php echo $list[0]['id'];?>">
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'number','name'=>'business','id'=>'business','class'=>'form-control','value'=>$list[0]['business'],'placeholder'=>'Enter Business'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'invest','id'=>'invest','class'=>'form-control','placeholder'=>'Enter Investing','value'=>$list[0]['invest'],'required'=>'true'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type'=>'text','name'=>'earn_amount','value'=>$list[0]['earn_amount'],'id'=>'icon','class'=>'form-control','placeholder'=>'Earn Amount'));?>
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <?php echo form_submit(array('name'=>'update_cat','id'=>'save_cat','value'=>'Update','class'=>'form-control btn btn-success'));?>
                                    </div>
                                    <div class="col-md-4"></div>                                    
                                </div>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-md-2 col-lg-2"></div>
                        	
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>    
<script>
	
	$(document).ready(function(e) {
        $('.hoverable').mouseenter(function(){
            //$('[data-toggle="popover"]').popover();
            $(this).popover('show');                    
        }); 

        $('.hoverable').mouseleave(function(){
            $(this).popover('hide');
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