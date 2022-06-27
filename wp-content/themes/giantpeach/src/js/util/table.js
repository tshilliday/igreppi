import Debounce from "../util/debounce";

function Table() {

    this.init();

}

Table.prototype.init = function(target_is_child,target_is_sibling) {

    var $this = this;

        var tables = document.querySelectorAll('table');

        if (tables !== null) {

            this.wrapAllTables(tables);

            var table_wrappers = document.querySelectorAll('.table__wrapper');

            if (table_wrappers !== null) {
                for (var i = 0; i < table_wrappers.length; i++) {

                    var table_wrapper = table_wrappers[i];

                    this.checkTableScroll(table_wrapper);
                    table_wrapper.addEventListener('scroll', function() {
                        $this.checkTableScroll(table_wrapper);
                    });

                    var resizeFunction = Debounce(function() {
                        $this.checkTableScroll(table_wrapper);
                    }, 100);

                    window.addEventListener('resize', resizeFunction, false);

                }
            }

        }

}

Table.prototype.wrapAllTables = function (tables) {
    for (var i = 0; i < tables.length; i++) {

        var table = tables[i];
        var wrapper = document.createElement('div');
        wrapper.classList.add('table__wrapper');
        wrapper.innerHTML = table.outerHTML;

        table.parentNode.insertBefore(wrapper,table);
        table.parentNode.removeChild(table);
    }
};

Table.prototype.checkTableScroll = function (table_wrapper) {
    if(table_wrapper.scrollWidth > (table_wrapper.clientWidth)+1){
        table_wrapper.classList.add('scrollable');
        if ((table_wrapper.offsetWidth + table_wrapper.scrollLeft) < table_wrapper.scrollWidth) {
            table_wrapper.classList.add('scrollRight');
        }
        else{
            table_wrapper.classList.remove('scrollRight');
        }
        if (table_wrapper.scrollLeft != 0) {
            table_wrapper.classList.add('scrollLeft');
        }
        else{
            table_wrapper.classList.remove('scrollLeft');
        }
    }else {
        table_wrapper.classList.remove('scrollable');
        table_wrapper.classList.remove('scrollLeft')
        table_wrapper.classList.remove('scrollRight');
    }
};

// Table.prototype.debounce = function(func, wait, immediate) {
//    var timeout;
//    return function() {
//        var context = this, args = arguments;
//        var later = function() {
//            timeout = null;
//            if (!immediate) func.apply(context, args);
//        };
//        var callNow = immediate && !timeout;
//        clearTimeout(timeout);
//        timeout = setTimeout(later, wait);
//        if (callNow) func.apply(context, args);
//    };
// };

export default Table;
