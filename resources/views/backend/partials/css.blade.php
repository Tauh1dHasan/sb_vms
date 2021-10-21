	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="{{asset('backend/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/structure.css')}}" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('backend/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" class="dashboard-analytics" />
    <link href="{{asset('backend/assets/css/custom.css')}}" rel="stylesheet" type="text/css" class="dashboard-analytics" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/custom_dt_custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/custom_dt_html5.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <link href="{{asset('backend/assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('backend/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/switches.css')}}">
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />

    {{-- Datetime picker plugin --}}
    <link rel="stylesheet" href="{{asset('backend/datetimepicker/jquery.datetimepicker.min.css')}}">

    <style> 
        table tbody tr td .dropdown .dropdown-menu {
            padding: 9px!important;
        }
        .dropdown-menu a.dropdown-item.action-view {
            background: #DDF5F0 !important;
            color: #1abc9c !important;
            margin-bottom: 7px;
        }
        .dropdown-menu a.dropdown-item.action-edit {
            background: #e7f7ff !important;
            color: #2196f3 !important;
            margin-bottom: 7px;
        }
        .dropdown-menu a.dropdown-item.action-delete {
            background: #fff5f5 !important;
            color: #e7515a !important;
            margin-bottom: 7px;
        }
        .input-group .input-group-prepend .input-group-text {
            width: 208px;
        }
        .widget-content.widget-content-area form {
            padding-left: 15px;
        }

        div.dataTables_wrapper .table-responsive {
            overflow: visible;
        }

        /* style for webcam */
        #camera {
            width: 200px;
            height: 200px;
            border: 1px solid black;
            margin-left: 25%;
            margin-bottom: 10px;
        }

        /* style for make an appointment from reception panel */
        div.visitor_type_div {
            margin-top: 10%; 
            margin-left: 5%;
        }

        a.visitor_type_card_body_one {
            width: 18rem; 
            height: 20rem; 
            cursor: pointer; 
            background: rgb(241, 241, 241);
        }

        a.visitor_type_card_body_two {
            width: 18rem; 
            height: 20rem; 
            cursor: pointer; 
            background: rgb(241, 241, 241);
        }

        a.visitor_type_card_body_one:hover, a.visitor_type_card_body_two:hover, h5:hover {
            background: #009688;
            color: #fff;
        }


    </style>
