/*==================== Button Disabled Js Start ====================*/
$(window).load(function(){
(function() {
    $('form > input').keyup(function() {

        var empty = false;
        $('form > input').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#login').attr('disabled', 'disabled');
        } else {
            $('#login').removeAttr('disabled');
        }
    });
})()
});
/*==================== Button Disabled Js End ====================*/