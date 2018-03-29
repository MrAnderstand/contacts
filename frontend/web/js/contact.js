// $('body').on('click', '.ajax-delete', function (e) {
//     e.preventDefault();
//     var deleteUrl     = $(this).attr('delete-url');
//     var pjaxContainer = $(this).attr('pjax-contact');
//     $.ajax({
//         url:   deleteUrl,
//         type:  'post',
//     }).fail(function (xhr, status, error) {
//         console.log(xhr);
//     }).done(function (data) {
//         $.pjax.reload({container: '#' + $.trim(pjaxContainer)});
//     });
// });

$('#contact-name').focus();

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