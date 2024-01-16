const carousel_u = document.querySelector(".carousel"),
    firstImg_u = carousel_u.querySelectorAll("img")[0],
    arrowIcons_u = document.querySelectorAll(".wrapper i");

let isDragStart_u = false, isDragging_u = false, prevPageX_u, prevScrollLeft_u, positionDiff_u;

const showHideIcons_u = () => {
    // showing and hiding prev/next icon according to carousel scroll left value
    let scrollWidth = carousel_u.scrollWidth - carousel_u.clientWidth; // getting max scrollable width
    arrowIcons_u[0].style.display = carousel_u.scrollLeft == 0 ? "none" : "block";
    arrowIcons_u[1].style.display = carousel_u.scrollLeft == scrollWidth ? "none" : "block";
}

arrowIcons_u.forEach(icon => {
    icon.addEventListener("click", () => {
        let firstImgWidth = firstImg_u.clientWidth + 14; // getting first img width & adding 14 margin value
        // if clicked icon is left, reduce width value from the carousel scroll left else add to it
        carousel_u.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
        setTimeout(() => showHideIcons_u(), 60); // calling showHideIcons after 60ms
    });
});

const autoSlide_u = () => {
    // if there is no image left to scroll then return from here
    if (carousel_u.scrollLeft - (carousel_u.scrollWidth - carousel_u.clientWidth) > -1 || carousel_u.scrollLeft <= 0) return;

    positionDiff_u = Math.abs(positionDiff_u); // making positionDiff value to positive
    let firstImgWidth = firstImg_u.clientWidth + 14;
    // getting difference value that needs to add or reduce from carousel left to take middle img center
    let valDifference = firstImgWidth - positionDiff_u;

    if (carousel_u.scrollLeft > prevScrollLeft_u) { // if user is scrolling to the right
        return carousel_u.scrollLeft += positionDiff_u > firstImgWidth / 3 ? valDifference : -positionDiff_u;
    }
    // if user is scrolling to the left
    carousel_u.scrollLeft -= positionDiff_u > firstImgWidth / 3 ? valDifference : -positionDiff_u;
}

const dragStart_u = (e) => {
    // updatating global variables value on mouse down event
    isDragStart_u = true;
    prevPageX_u = e.pageX || e.touches[0].pageX;
    prevScrollLeft_u = carousel_u.scrollLeft;
}

const dragging_u = (e) => {
    // scrolling images/carousel to left according to mouse pointer
    if (!isDragStart_u) return;
    e.preventDefault();
    isDragging_u = true;
    carousel_u.classList.add("dragging");
    positionDiff_u = (e.pageX || e.touches[0].pageX) - prevPageX_u;
    carousel_u.scrollLeft = prevScrollLeft_u - positionDiff_u;
    showHideIcons_u();
}

const dragStop_u = () => {
    isDragStart_u = false;
    carousel_u.classList.remove("dragging");

    if (!isDragging_u) return;
    isDragging_u = false;
    autoSlide_u();
}

carousel_u.addEventListener("mousedown", dragStart);
carousel_u.addEventListener("touchstart", dragStart);

document.addEventListener("mousemove", dragging_u);
carousel_u.addEventListener("touchmove", dragging_u);

document.addEventListener("mouseup", dragStop_u);
carousel_u.addEventListener("touchend", dragStop_u);

//edit information
function edit_name() {
    document.getElementById("full_name").disabled = !document.getElementById("full_name").disabled
    document.getElementById("full_name").focus();
}
function edit_dob() {
    document.getElementById("dob").disabled = !document.getElementById("dob").disabled
    document.getElementById("dob").focus();
}
function edit_email() {
    document.getElementById("email").disabled = !document.getElementById("email").disabled
    document.getElementById("email").focus();
}


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

// const navOpenBtn = document.querySelector("[data-menu-open-btn]");
// const navCloseBtn = document.querySelector("[data-menu-close-btn]");
// const navbar = document.querySelector("[data-navbar]");
// const overlay = document.querySelector("[data-overlay]");

// const navElemArr = [navOpenBtn, navCloseBtn, overlay];

// for (let i = 0; i < navElemArr.length; i++) {

//     navElemArr[i].addEventListener("click", function () {

//         navbar.classList.toggle("active");
//         overlay.classList.toggle("active");
//         document.body.classList.toggle("active");

//     });

// }

// $("#searchbar .search-label").on("click", function (e) {
//     e.preventDefault();
//     $("#searchbar").toggleClass("collapsed");
// });//click

/**
 * header sticky
 */

// const header = document.querySelector("[data-header]");

// window.addEventListener("scroll", function () {

//     window.scrollY >= 10 ? header.classList.add("active") : header.classList.remove("active");

// });

function confirm_change_inf_user() {
    Swal.fire({
        title: "Are you sure?",
        text: "Information will be change!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, change it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Deleted!",
                text: "Your information has been changed.",
                icon: "success"
            });
        }
    });
}

// to top
// const goTopBtn = document.querySelector("[data-go-top]");

// window.addEventListener("scroll", function () {

//   window.scrollY >= 500 ? goTopBtn.classList.add("active") : goTopBtn.classList.remove("active");

// });



/*
  lmao
*/

function per_info_confirm(){
    var form = document.getElementById("per_info");
    Swal.fire({
        title: "Are you sure?",
        text: "You will still be able to edit them later!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
    });
}

function email_info_confirm(){
    var form = document.getElementById("email_info");
    Swal.fire({
        title: "Are you sure?",
        text: "You will still be able to edit it later!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
    });
}

function password_info_confirm(){
    var form = document.getElementById("password_info");
    Swal.fire({
        title: "Are you sure?",
        text: "You will still be able to change your password later!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
    });
}