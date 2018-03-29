$('#contactphones-phone_number').focus();

$(document).on('pjax:success', function() {
    $('#contactphones-phone_number').focus();
});

$(document).on('pjax:error', function() {
    alert('Во время выполнения запроса произошла ошибка.');
    event.preventDefault();
});

$(document).on('pjax:timeout', function() {
    alert('Превышено время выполнения запроса.');
    event.preventDefault();
});