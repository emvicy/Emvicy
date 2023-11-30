/**
 * Cookie Consent Handling
 * @requires jquery
 */
$(document).ready(function() {

    // cookie consent
    if ('undefined' === typeof $.cookie('Emvicy_cookieConsent')) {$('#Emvicy_cookieConsent').fadeIn();}
    $('#Emvicy_cookieConsent button').on('click', function(oEvent){
        if (true === $('#Emvicy_cookieConsent input').is(':checked')) {
            $.cookie('Emvicy_cookieConsent', true, {expires: 365, path:"/"});
            $('#Emvicy_cookieConsent').fadeOut(function(){
                'slow',
                    location.reload();
            });
        }
    });
});
