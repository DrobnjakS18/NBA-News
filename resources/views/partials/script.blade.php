<script src="{{asset('js/jquery.min.js')}}"> </script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/responsiveslides.min.js')}}"></script>
<script src="{{asset('js/modernizr.custom.js')}}"></script>
<script src="{{asset('js/move-top.js')}}"></script>
<script src="{{asset('js/easing.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
        });
    });
</script>


