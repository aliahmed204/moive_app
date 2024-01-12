<script src="{{asset('dashboard')}}/js/jquery-3.7.0.min.js"></script>
<script src="{{asset('dashboard')}}/js/bootstrap.min.js"></script>
<script src="{{asset('dashboard')}}/js/main.js"></script>
<script src="{{asset('dashboard')}}/js/custom/index.js"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('dashboard')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('dashboard')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('dashboard')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- SweetAlert2 -->
<script src="{{asset('dashboard')}}/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- Magnific-Popup -->
<script src="{{asset('dashboard')}}/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>

{{--cahrt--}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
</script>

@if(session()->has('success'))
    <script>
        Toast.fire({
            icon: 'success',
            title: "{{session()->get('success')}}"
        })
    </script>
@endif
<!-- Select2 -->
<script src="{{asset('dashboard')}}/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select22').select2();
    });
</script>
@stack('js')



<!-- Google analytics script-->
<script type="text/javascript">
    if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>

</body>
</html>
