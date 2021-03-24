<div class="ui menu menutop">
  <a id="main-menu" class="item"><i class="expand arrows alternate icon"></i></a>
  <div class="right menu">
    <a class="ui item" href="<?php echo e(url('users/'.Auth::user()->id.'/change-pass')); ?>">Xin chào !<strong> &nbsp; <?php echo e(Auth::user()->name); ?> </strong></a>
    <a class="ui item dangxuat" title="Đăng xuất">
      <i class="share square icon"></i>
    </a>  
  </div> 
</div>
<script type="text/javascript">
  var lag = 0;
  $('#main-menu').click(function(event){
      if(lag==0){
        $('#sidebar-content').css('left','-230px').transition('slide right');
        $('#wrap-content').css('width','100%').css('margin-left','0');
        lag = 1;
      }else{
        $('#sidebar-content').css('left', '0').transition('slide right');
        $('#wrap-content').css('width','unset').css('margin-left','230px');
        lag = 0;
      }
  });
  
  $('.dangxuat').click(function(event){
      swal({
      buttons: {
            cancel: true,
            confirm: {
                      text: "OK",
                      className: "ok"
                    },
           },
      title: 'Bạn có muốn đăng xuất ?'
      });
      $('.ok').click(function(){
          window.location.href = '<?php echo e(url('/logout')); ?>';
      });
  });
</script>


