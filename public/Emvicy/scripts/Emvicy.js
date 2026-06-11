/**
 * @usage var bEmvicy_cookieExists = Emvicy_cookieExists('Emvicy_cookieConsent');
 * @param sCookieName
 * @returns {boolean}
 */
function Emvicy_cookieExists(sCookieName) {

    var aCookie = document.cookie.split(';');

    for (iCnt = 0; iCnt < aCookie.length; iCnt++) {
        if (aCookie[iCnt].split('=')[0].trim() == sCookieName) {
            return true;
        };
    }
}

document.addEventListener("DOMContentLoaded", function (event) {

    // Cookie Consent Handling
    var sCookieName = 'Emvicy_cookieConsent';
    if (undefined === Emvicy_cookieExists(sCookieName)) {$('#' + sCookieName).fadeIn();}
    $('#' + sCookieName + ' button').on('click', function(oEvent){
        if (true === $('#' + sCookieName + ' input').is(':checked')) {
            document.cookie = sCookieName + "=true; expires=365; path=/; SameSite=None; Secure;";
            $('#' + sCookieName).fadeOut(function(){'slow', location.reload();});
        }
    });

    const Emvicy_resizeObserver = new ResizeObserver((aResizeObserverEntry) => {
        for (const oElement of aResizeObserverEntry) {
            var sPosition = localStorage.getItem(oElement.target.id);
            (null === sPosition) ? sPosition = '{"top":50,"left":50}' : false;
            if (null === sPosition || 0 === oElement.contentRect.width || 0 === oElement.contentRect.height) {
                return;
            }
            (null === sPosition) ? sPosition = '{"top":' + ((window.innerHeight / 4)) + ',"left":' + ((window.innerWidth / 4)) + '}' : false;
            var oPosition = JSON.parse(sPosition);
            localStorage.setItem(
                oElement.target.id,
                '{"top":' + oPosition.top + ',"left":' + oPosition.left + ',"width":' + oElement.contentRect.width + ',"height":' + oElement.contentRect.height + '}'
            );
        }
    });

    function Emvicy_dragElement(oElement) {

        Emvicy_resizeObserver.observe(oElement);
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        Emvicy_dragRestore(oElement);

        if (document.getElementById(oElement.id + "_mover")) {
            document.getElementById(oElement.id + "_mover").onmousedown = Emvicy_dragMouseDown;
        } else {
            oElement.onmousedown = Emvicy_dragMouseDown;
        }

        function Emvicy_dragMouseDown(oEvent) {
            oEvent = oEvent || window.event;
            oEvent.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = oEvent.clientX;
            pos4 = oEvent.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = Emvicy_elementDrag;
        }

        function Emvicy_elementDrag(oEvent) {
            oEvent = oEvent || window.event;
            oEvent.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - oEvent.clientX;
            pos2 = pos4 - oEvent.clientY;
            pos3 = oEvent.clientX;
            pos4 = oEvent.clientY;
            // set the element's new position:
            oElement.style.top = (oElement.offsetTop - pos2) + "px";
            oElement.style.left = (oElement.offsetLeft - pos1) + "px";

            localStorage.setItem(oElement.id, '{"top":' + (oElement.offsetTop - pos2) + ',"left":' + (oElement.offsetLeft - pos1) + ',"width":' + oElement.clientWidth + ',"height":' + oElement.clientHeight + '}');
        }

        function Emvicy_dragRestore(oElement) {
            var sPosition = localStorage.getItem(oElement.id);
            (null === sPosition) ? sPosition = '{"top":50,"left":50}' : false;
            var oPosition = JSON.parse(sPosition);
            oElement.style.top = oPosition.top + 'px';
            oElement.style.left = oPosition.left + 'px';
            oElement.style.display = 'block';
            oElement.style.maxWidth = (window.innerWidth - 100)+ 'px';
            oElement.style.maxHeight = (window.innerWidth - 100) + 'px';
            document.getElementById(oElement.id + '_content').style.width = oPosition.width + 'px';
            document.getElementById(oElement.id + '_content').style.height = (oPosition.height - 100) + 'px';
        }

        function closeDragElement() {
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }

    // init all draggable
    for (var oElement of document.getElementsByClassName('emvicy_draggable')) {
        Emvicy_dragElement(document.getElementById(oElement.id));
    }
});

