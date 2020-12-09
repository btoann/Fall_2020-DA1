window.addEventListener("load", event => {

    // Expand Left Side
    var icon = document.querySelector('.left__menuItem'),
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



// var queryAll = document.getElementById.querySelectorAll(' #div '); // query to selector innerHTML
var element = document.getElementById("tt__left").style.backgroundColor = "white";


const icon__down__2 = document.getElementById('tt__left__2');

icon__down__2.addEventListener('change', () => {

    var element = document.getElementById("light__2");
    element.classList.toggle("color__light");

});



const icon__down__3 = document.getElementById('tt__left__3');

icon__down__3.addEventListener('change', () => {

    var element = document.getElementById("light__3");
    element.classList.toggle("color__light");

});


const icon__down__4 = document.getElementById('tt__left__4');

icon__down__4.addEventListener('change', () => {

    var element = document.getElementById("light__4");
    element.classList.toggle("color__light");

});


const icon__down__5 = document.getElementById('tt__left__5');

icon__down__5.addEventListener('change', () => {

    var element = document.getElementById("light__5");
    element.classList.toggle("color__light");

});

const icon__down__6 = document.getElementById('tt__left__6');

icon__down__6.addEventListener('change', () => {

    var element = document.getElementById("light__6");
    element.classList.toggle("color__light");

});