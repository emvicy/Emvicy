
// vanilla js dom ready, @see http://stackoverflow.com/a/13456810/2487859
window.readyHandlers = [];
window.ready = function ready(handler) {window.readyHandlers.push(handler); handleState();};
window.handleState = function handleState () {if (['interactive', 'complete'].indexOf(document.readyState) > -1) {while(window.readyHandlers.length > 0) {(window.readyHandlers.shift())();}}};
document.onreadystatechange = window.handleState;

/**
 * @param oElement
 * @returns {{top: *, left: *}}
 */
function getOffset(oElement) {
    var rect = oElement.getBoundingClientRect(),
        scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
}

document.getElementById("EmvicyToolbar").addEventListener("click", function(oEvent){
    oEvent.stopPropagation();
});

function setExpand()
{
    document.getElementById("EmvicyToolbar").classList.remove('EmvicyToolbar_shrink');
    document.getElementById("EmvicyToolbar_head").classList.remove('EmvicyToolbar_shrink');
    document.getElementById("EmvicyToolbar").classList.add('EmvicyToolbar_expand');
    document.getElementById("EmvicyToolbar_head").classList.remove('EmvicyToolbar_expand');
}

function setShrink()
{
    document.getElementById("EmvicyToolbar").classList.remove('EmvicyToolbar_expand');
    document.getElementById("EmvicyToolbar_head").classList.remove('EmvicyToolbar_expand');
    document.getElementById("EmvicyToolbar").classList.add('EmvicyToolbar_shrink');
    document.getElementById("EmvicyToolbar_head").classList.remove('EmvicyToolbar_shrink');
}

function toggleInOut()
{
    // Using an if statement to check the class
    if (document.getElementById("EmvicyToolbar").classList.contains('EmvicyToolbar_shrink')) {
        setExpand();
        localStorage.setItem("EmvicyToolbar_toggle", localStorage.getItem('EmvicyToolbar_width'));
    } else {
        setShrink();
        localStorage.setItem("EmvicyToolbar_toggle", 0);
    }
}

document.getElementById("EmvicyToolbar_toggle").addEventListener("click", function(){
    toggleInOut();
});

window.addEventListener('click', function (evt) {
    for (var i = 1; i < 10; i++) {
        var oElement = document.getElementById('tab' + i);
        if (null !== oElement) {
            oElement.checked = false;
        }
    }
});

document.getElementById('EmvicyToolbar').style.display = 'block';
var fEmvicyToolbar_toggle = localStorage.getItem('EmvicyToolbar_toggle');

if (null === fEmvicyToolbar_toggle) {

    localStorage.setItem("EmvicyToolbar_width", document.getElementById("EmvicyToolbar").offsetWidth);
    localStorage.setItem("EmvicyToolbar_toggle", localStorage.getItem('EmvicyToolbar_width'));
    fEmvicyToolbar_toggle = 0;
}

if (0 === parseInt(localStorage.getItem('EmvicyToolbar_toggle'))) {
    setShrink();
}


