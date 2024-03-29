
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

document.getElementById("myMvcToolbar").addEventListener("click", function(oEvent){
    oEvent.stopPropagation();
});

function setExpand()
{
    document.getElementById("myMvcToolbar").classList.remove('myMvcToolbar_shrink');
    document.getElementById("myMvcToolbar_head").classList.remove('myMvcToolbar_shrink');
    document.getElementById("myMvcToolbar").classList.add('myMvcToolbar_expand');
    document.getElementById("myMvcToolbar_head").classList.remove('myMvcToolbar_expand');
}

function setShrink()
{
    document.getElementById("myMvcToolbar").classList.remove('myMvcToolbar_expand');
    document.getElementById("myMvcToolbar_head").classList.remove('myMvcToolbar_expand');
    document.getElementById("myMvcToolbar").classList.add('myMvcToolbar_shrink');
    document.getElementById("myMvcToolbar_head").classList.remove('myMvcToolbar_shrink');
}

function toggleInOut()
{
    // Using an if statement to check the class
    if (document.getElementById("myMvcToolbar").classList.contains('myMvcToolbar_shrink')) {
        setExpand();
        localStorage.setItem("myMvcToolbar_toggle", localStorage.getItem('myMvcToolbar_width'));
    } else {
        setShrink();
        localStorage.setItem("myMvcToolbar_toggle", 0);
    }
}

document.getElementById("myMvcToolbar_toggle").addEventListener("click", function(){
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

document.getElementById('myMvcToolbar').style.display = 'block';
var fMyMvcToolbar_toggle = localStorage.getItem('myMvcToolbar_toggle');

if (null === fMyMvcToolbar_toggle) {

    localStorage.setItem("myMvcToolbar_width", document.getElementById("myMvcToolbar").offsetWidth);
    localStorage.setItem("myMvcToolbar_toggle", localStorage.getItem('myMvcToolbar_width'));
    fMyMvcToolbar_toggle = 0;
}

if (0 === parseInt(localStorage.getItem('myMvcToolbar_toggle'))) {
    setShrink();
}


