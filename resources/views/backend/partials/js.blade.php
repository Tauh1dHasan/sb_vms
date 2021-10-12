
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
	<script src="{{asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('backend/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/app.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('backend/plugins/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/dashboard/dash_1.js')}}"></script>
    <script src="{{asset('backend/plugins/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/custom-select2.js')}}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{asset('backend/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>    
    <script src="{{asset('backend/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    {{-- Datetime picker --}}
    <script src="{{asset('backend/datetimepicker/jquery.datetimepicker.full.js')}}"></script>
    <script>
        $("#meeting_datetime").datetimepicker({
            step:5
        });
    </script>

    <script> 

        c3 = $('#style-3').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
            },
            "order": [[ 0, "desc" ]],
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 10
        });

        multiCheck(c3);
        
    </script>

<script>
    $('#html5-extension').DataTable( {
        "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
    "<'table-responsive'tr>" +
    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-sm' },
                { extend: 'csv', className: 'btn btn-sm' },
                { extend: 'excel', className: 'btn btn-sm' },
                { extend: 'print', className: 'btn btn-sm' }
            ]
        },
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
           "sLengthMenu": "Results :  _MENU_",
        },
        "order": [[ 0, "desc" ]],
        "stripeClasses": [],
        "lengthMenu": [5, 10, 20, 50],
        "pageLength": 10
    } );
</script>

    <script type="text/javascript"> 
        $('.select2').select2({
            allowClear: false,
        });
    </script>

    <script> 
        $('form')
            .each(function(){
                $(this).data('serialized', $(this).serialize())
            })
            .on('change input', function(){
                $(this)             
                    .find('input:submit, button:submit')
                        .prop('disabled', $(this).serialize() == $(this).data('serialized'))
                ;
            })
            .find('input:submit, button:submit')
                .prop('disabled', true)
        ;
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script>
        // passing meeting_id function
        function meeting_func(id){
            var meeting_id = id.getAttribute("data-id");
            document.getElementById("gatePassMeetingID").value = meeting_id;

            // Load webcam
            Webcam.set({
                width:200,
                height:150,
                image_format:'jpeg',
                jpeg_quality:90
            });
            Webcam.attach("#camera")
            
        }
        // Taking picture function
        function take_snapshot(){
            Webcam.snap(function(data_uri){
                document.getElementById('camera').innerHTML = '<img src="'+data_uri+'"/>';
                document.getElementById('visitor_photo').value = data_uri;
            });
        }
    </script>

    @include('backend.ajax.ajax')

