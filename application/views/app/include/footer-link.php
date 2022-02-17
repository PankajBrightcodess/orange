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

  </body>
</html>