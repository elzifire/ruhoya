<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">


<!-- Layout config Js -->
<script src="{{asset('BE/js/layout.js')}}"></script>
<!-- Bootstrap Css -->
<link href="{{asset('BE/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{asset('BE/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{asset('BE/css/app.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Page CSS -->
@stack('css')

<style>
    .swal2-container {
        z-index: 9999 !important;
    }

    table.dataTable td.dataTables_empty, table.dataTable th.dataTables_empty {
        padding: .75rem .6rem !important;
    }
</style>