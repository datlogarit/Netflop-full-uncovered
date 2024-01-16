const header = document.querySelector("[data-header]");

window.addEventListener("scroll", function () {

    window.scrollY >= 10 ? header.classList.add("active") : header.classList.remove("active");

});

function ban_user() {
    Swal.fire({
        title: "Are you sure?",
        text: "This user will be permanently BANED!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, BAN user!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Complete!",
                text: "This user has been banned.",
                icon: "success"
            });
        }
    });
}

// to top
const goTopBtn = document.querySelector("[data-go-top]");

window.addEventListener("scroll", function () {

  window.scrollY >= 500 ? goTopBtn.classList.add("active") : goTopBtn.classList.remove("active");

});


function F_Dropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
// window.onclick = function (event) {
//     if (!event.target.matches('.dropbtn')) {
//         var dropdowns = document.getElementsByClassName("dropdown-content");
//         var x;
//         for (x = 0; x < dropdowns.length; x++) {
//             var openDropdown = dropdowns[x];
//             if (openDropdown.classList.contains('show')) {
//                 openDropdown.classList.remove('show');
//             }
//         }
//     }
// }


// $(document).ready(function () {
//     var submitIcon = $('.searchbox-icon');
//     var inputBox = $('.searchbox-input');
//     var searchBox = $('.searchbox');
//     var submitButton = $('.searchbox-submit');
//     var isOpen = false;
//     submitIcon.click(function () {
//         if (isOpen == false) {
//             searchBox.addClass('searchbox-open');
//             submitButton.css('visibility', 'visible')
//             inputBox.focus();
//             isOpen = true;
//         } else {
//             searchBox.removeClass('searchbox-open');
//             inputBox.focusout();
//             isOpen = false;
//         }
//     });

//     function buttonUp() {
//         var inputVal = $('.searchbox-input').val();
//         inputVal = $.trim(inputVal).length;
//         if (inputVal !== 0) {
//             //customize this line of code to show X
//             //$('.searchbox-icon').css('display','none');
//         } else {
//             $('.searchbox-input').val('');
//             $('.searchbox-icon').css('display', 'block');
//         }
//     }
//     inputBox.keyup(buttonUp);
// });

'use strict';

/**
 * navbar variables
 */

const navOpenBtn = document.querySelector("[data-menu-open-btn]");
const navCloseBtn = document.querySelector("[data-menu-close-btn]");
const navbar = document.querySelector("[data-navbar]");
const overlay = document.querySelector("[data-overlay]");

const navElemArr = [navOpenBtn, navCloseBtn, overlay];

for (let i = 0; i < navElemArr.length; i++) {

    navElemArr[i].addEventListener("click", function () {

        navbar.classList.toggle("active");
        overlay.classList.toggle("active");
        document.body.classList.toggle("active");

    });

}

$("#searchbar .search-label").on("click", function (e) {
    e.preventDefault();
    $("#searchbar").toggleClass("collapsed");
});//click