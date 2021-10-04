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