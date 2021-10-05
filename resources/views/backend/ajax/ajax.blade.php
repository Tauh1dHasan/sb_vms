<script>
            
    $("#dept_id").on('change',function(e){
        e.preventDefault();
        let designation_list = $("#designation_id");
        let user_type = $('#user_type_id').val();

        // alert(user_type);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: window.location.origin + `/backend/designations/${user_type}`,
            data: {_token:$('input[name=_token]').val(),
            dept_id: $(this).val()},
            success:function(response){
                $('option', designation_list).remove();
                $('#designation_id').append('<option value="">--Select Designation--</option>');
                $.each(response, function(){
                    $('<option/>', {
                        'value': this.designation_id,
                        'text': this.designation
                    }).appendTo('#designation_id');
                });
            }
        });
    });
    
</script>
<script type="text/javascript">

    $('#employee_id').select2({
        placeholder: "Write Host Name",
        allowClear: false,
        ajax: {
            url: '{{ route('visitor.search-employees') }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.first_name+' '+item.last_name+' ('+item.designation+', '+item.department+')',
                            id: item.employee_id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>

<script type="text/javascript">

    $('#employee_id').select2({
        placeholder: "Write Host Name",
        allowClear: false,
        ajax: {
            url: '{{ route('reception.search-employees') }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.first_name+' '+item.last_name+' ('+item.designation+', '+item.department+')',
                            id: item.employee_id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>