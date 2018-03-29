$('#contactphones-phone_number').focus();

$('body').on('click', '.reset-form', function (e) {
    $form = $(this).closest('form');
    $form.find('input').val('');
    $form[0].submit();
    // $.pjax.reload({container: '#pjax-contact'});
});

$(document).on('pjax:error', function() {
    alert('Во время выполнения запроса произошла ошибка.');
    event.preventDefault();
});

$(document).on('pjax:timeout', function() {
    alert('Превышено время выполнения запроса.');
    event.preventDefault();
});