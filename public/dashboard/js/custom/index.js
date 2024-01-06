$(function(){

    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });

    $(document).on('change','.record__select',function(){
        getSelectedRecorde();
    })

    /* checked all */
    $(document).on('change','#record__select-all',function(){
        $('.record__select').prop('checked', this.checked);
        getSelectedRecorde();
    })


    function getSelectedRecorde()
    {
        var recordIds = [];
        $.each($(".record__select:checked"), function(){
           recordIds.push($(this).val());
        });

        /*out values that in recordIds in bulk-delete form hidden input record_ids*/
        $('#record-ids').val(JSON.stringify(recordIds));

        /*show button if ids selected*/
        var bulkDelete = $('#bulk-delete');
        recordIds.length > 0
            ? bulkDelete.attr('disabled',false)
            : bulkDelete.attr('disabled', true);

        console.log(recordIds);
    }



});
