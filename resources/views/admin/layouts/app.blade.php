<!DOCTYPE html>
<html lang="tr">  
<head>
   @include('admin.includes.header')
</head>
<body id="page-top"> 

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.includes.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
             
                @include('admin.includes.topbar')

                @yield('content')

            </div>
            <!-- End of Main Content -->

            @include('admin.includes.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('back/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('back/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('back/vendor/jquery-easing/jquery.easing.min.js')}}"></script> 

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('back/js/sb-admin-2.min.js')}}"></script>


    <!-- Page level plugins -->
    <script src="{{ asset('back/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('back/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('back/js/demo/datatables-demo.js')}}"></script>

    <!-- Sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>