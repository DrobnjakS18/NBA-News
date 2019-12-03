<!-- Bootstrap core JavaScript-->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('/bootstrap/js/bootstrap.bundle.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Page level plugin JavaScript-->
{{--<script src="{{asset('/datatables/jquery.dataTables.js')}}"></script>--}}
<script src="{{asset('/datatables/dataTables.bootstrap4.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin.min.js')}}"></script>

<!-- Demo scripts for this page-->
{{--<script src="{{asset('js/demo/datatables-demo.js')}}"></script>--}}
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>

<script>
    function showForm() {
        $("#form_show").slideToggle('slow');
    }
</script>
