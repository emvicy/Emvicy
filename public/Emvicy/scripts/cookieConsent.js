/**
 * @usage var bCookieExists = cookieExists('Emvicy_cookieConsent');
 * @param sCookieName
 * @returns {boolean}
 */
function cookieExists(sCookieName) {

    var aCookie = document.cookie.split(';');

    for (iCnt = 0; iCnt < aCookie.length; iCnt++) {
        if (aCookie[iCnt].split('=')[0].trim() == sCookieName) {
            return true;
        };
    }
}

/**
 * Cookie Consent Handling
 * @requires jquery
 */
$(document).ready(function() {
    var sCookieName = 'Emvicy_cookieConsent';
    if (undefined === cookieExists(sCookieName)) {$('#' + sCookieName).fadeIn();}
    $('#' + sCookieName + ' button').on('click', function(oEvent){
        if (true === $('#' + sCookieName + ' input').is(':checked')) {
            document.cookie = sCookieName + "=true; expires=365; path='/'; SameSite=None; Secure;";
            $('#' + sCookieName).fadeOut(function(){'slow', location.reload();});
        }
    });
});
