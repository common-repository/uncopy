document.addEventListener('DOMContentLoaded', () => {
    // Disable Selection
    if (unCopyConfig.js.text_selection) {
        function disableSelection(e) {
            if (typeof e.onselectstart != "undefined") e.onselectstart = function() { return false };
            else if (typeof e.style.MozUserSelect != "undefined") e.style.MozUserSelect = "none";
            else e.onmousedown = function() { return false };
            e.style.cursor = "default"
        }
        window.onload = function() { disableSelection(document.body) };
    }


    // Disable keys
    if (unCopyConfig.js.disable_keys) {
        window.addEventListener("keydown", (e) => {
            if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 67 || e.which == 70 || e.which == 73 || e.which == 80 || e.which == 83 || e.which == 85 || e.which == 86)) {
                navigator.clipboard.writeText('');
                e.preventDefault()
            }
        });
        document.keypress = (e) => {
            if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 70 || e.which == 67 || e.which == 73 || e.which == 80 || e.which == 83 || e.which == 85 || e.which == 86)) {}
            navigator.clipboard.writeText('');
            return false
        };
        document.onkeydown = (e) => { e = e || window.event; if (e.keyCode == 123 || e.keyCode == 18) { navigator.clipboard.writeText(''); return false } };
    }

    // Disable Right Click
    if (unCopyConfig.js.right_click) {
        document.oncontextmenu = function(e) {
            var t = e || window.event;
            var n = t.target || t.srcElement;
            return false
        };
    }

    // Disable Drag/Drop
    if (unCopyConfig.js.image_text_dragging) {
        document.ondragstart = function() { return false };
    }

})