var Index = (function() {
    function Index() {
        _bindEvents();
    };

    // ===== public  =====
    Index.Hoge = function() {

    };

    // ===== private =====
    function _bindEvents() {
        var addButton = document.getElementsByClassName('control__add-button').item(0);
        addButton.addEventListener('click', _toggleAddForm);
    };

    function _toggleAddForm() {
        var addForm = document.getElementsByClassName('control__add-spending').item(0);
        if (!addForm.classList.contains("control__add-spending--expand")) {
            addForm.classList.add("control__add-spending--expand")
        } else {
            addForm.classList.remove("control__add-spending--expand")
        }
    }

    return Index;
})();
var index = new Index();