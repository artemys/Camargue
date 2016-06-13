var AttachDragTo = (function () {
    var _AttachDragTo = function (el) {
        this.el = el;
        this.mouse_is_down = false;

        this.init();
    };

    _AttachDragTo.prototype = {
        onMousemove: function (e) {
            if ( !this.mouse_is_down ) return;
            var tg = e.target,
                x = e.clientX,
                y = e.clientY;

            tg.style.backgroundPositionX = x - this.origin_x + this.origin_bg_pos_x + 'px';
            tg.style.backgroundPositionY = y - this.origin_y + this.origin_bg_pos_y + 'px';
        },

        onMousedown: function(e) {
            this.mouse_is_down = true;
            this.origin_x = e.clientX;
            this.origin_y = e.clientY;
        },

        onMouseup: function(e) {
            var tg = e.target,
                styles = getComputedStyle(tg);

            this.mouse_is_down = false;
            this.origin_bg_pos_x = parseInt(styles.getPropertyValue('background-position-x'), 10);
            this.origin_bg_pos_y = parseInt(styles.getPropertyValue('background-position-y'), 10);
        },

        init: function () {
            var styles = getComputedStyle(this.el);
            this.origin_bg_pos_x = parseInt(styles.getPropertyValue('background-position-x'), 10);
            this.origin_bg_pos_y = parseInt(styles.getPropertyValue('background-position-y'), 10);

            //attach events
            this.el.addEventListener('mousedown', this.onMousedown.bind(this), false);
            this.el.addEventListener('mouseup', this.onMouseup.bind(this), false);
            this.el.addEventListener('mousemove', this.onMousemove.bind(this), false);
        }
    };

    return function ( el ) {
        new _AttachDragTo(el);
    };
})();


/*** IMPLEMENTATION ***/
//1. Get your element.
var map = document.querySelector('#filter_prev');
//2. Attach the drag.
AttachDragTo(map);