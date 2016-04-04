var QC = {
    showModal: function(e) {
        $('#af_product').val($(this).parent().find('.QCproductOuter').html());
        $('#QCproductRowHandler').html($(this).parent().find('.QCproductRowOuter').html());
        $('#QCorderModal').modal('show');
        return false;
    }
}

$(document).on('click', '.quickcheckout', QC.showModal);
$(document).on('af_complete', function(event, response) {
    if (response.success) {
        $('#QCorderModal').modal('hide');
    }
});