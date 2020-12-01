window.addEventListener("load", event => {

    // Expand Left Side
    var icon = document.querySelector('.left__icon'),
        left = document.querySelector('.left');

    icon.addEventListener('click', expand);

    function expand() {
        if (left.classList.contains('show')) {
            left.classList.remove('show')
        } else {
            left.classList.add('show')
        }
    }

    var menuItem = document.querySelectorAll('.left__menuItem');

    menuItem.forEach(function(el) {
        el.addEventListener("click", openMenu);
    });

    function openMenu(event) {
        var currentmenuItem = event.currentTarget;

        if (currentmenuItem.classList.contains('open')) {
            currentmenuItem.classList.remove('open');
        } else {
            currentmenuItem.classList.add('open');
        }
    };
});

const checkbox = document.getElementById('checkbox');

checkbox.addEventListener('change', () => {
    // document.body.classList.toggle('dark');

    var element = document.getElementById("dark");
    element.classList.toggle("toggle");
    var element = document.getElementById("dark2");
    element.classList.toggle("toggle");


});

const icon__down = document.getElementById('tt__left');

icon__down.addEventListener('change', () => {

    var element = document.getElementById("light");
    element.classList.toggle("color__light");

});


var element = document.getElementById("tt__left").style.backgroundColor = "white";