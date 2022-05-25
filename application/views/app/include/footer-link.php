    <script src="<?php echo base_url('assets/app_assets/js/bootstrap.bundle.min.js');?>"></script>
     <script src="<?php echo base_url('assets/app_assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/waypoints.min.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/jquery.easing.min.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/jquery.magnific-popup.min.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/owl.carousel.min.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/jquery.counterup.min.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/jquery.countdown.min.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/jquery.passwordstrength.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/dark-mode-switch.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/active.js');?>"></script>
    <script src="<?php echo base_url('assets/app_assets/js/pwa.js');?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
       <?php if(isset($this->session->web_msg)){ ?>
        <script type="text/javascript">
           swal("Good job!", "You clicked the button!", "success");
           swal('Good job!','<?php echo $this->session->web_msg;?>','success');
        </script>
           <?php }else if(isset($this->session->web_err_msg)){ ?>
        <script type="text/javascript">
           // swal("Good job!", "You clicked the button!", "success");
           swal('Opps!','<?php echo $this->session->web_err_msg;?>','error');
        </script>
    <?php }?>


    <script type="text/javascript">
        var collapseElementList = [].slice.call(document.querySelectorAll('#collapseExample'))
        var collapseList = collapseElementList.map(function (collapseE1) {
            $('#collapseExample1').hide();
          return new bootstrap.Collapse(collapseE1)
        })

         $(document).ready(function(){
        $('#collapseExample1').on('click', function(){
        $('#collapseExample').hide();
        $('#collapseExample1').show();
      });
   });


    </script>

   <script type="text/javascript">
          $(document).ready(function() {
             $('body').on('click','#pay', function(){
            var amt = $('.balance').val();
            amount = parseFloat(amt);
            var wbalance = $('.wallet_balance').val();
            wallet_balance = parseFloat(wbalance);
            if(amount<=wallet_balance){
               if (confirm('Are You Sure ?')) {
                     $.ajax({
                        type:'POST',
                        url: '<?php echo base_url('app_control/transcation')?>',
                        data:{amount:amount},
                        // dataType:'JSON',
                        success:function(result){
                          if(result){
                           window.location.href = "<?php echo base_url('app_control/home');?>";
                           // location.reload();
                           swal("Balance","Payment Successfully","success");
                          }else{
                           swal("Balance","Payment not Submitted","error");
                          }
                        },

                      });
               }    
            }else{
               swal("Balance","You have no sufficient balance!","error");
            }
         })
          });
   </script>

  </body>
</html>