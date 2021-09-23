<script>
    $("#dept_id").on('change',function(e){
        e.preventDefault();
        var designation_list = $("#designation_id");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('frontend.employee.designation')}}",
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