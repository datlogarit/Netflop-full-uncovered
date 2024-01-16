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

/**
 * header sticky
 */

const header = document.querySelector("[data-header]");

window.addEventListener("scroll", function () {

  window.scrollY >= 10 ? header.classList.add("active") : header.classList.remove("active");

});



/**
 * go top
 */

const goTopBtn = document.querySelector("[data-go-top]");

window.addEventListener("scroll", function () {

  window.scrollY >= 500 ? goTopBtn.classList.add("active") : goTopBtn.classList.remove("active");

});



// js for search
$(document).ready(function () {
  var submitIcon = $('.searchbox-icon');
  var inputBox = $('.searchbox-input');
  var searchBox = $('.searchbox');
  var submitButton = $('.searchbox-submit');
  var isOpen = false;
  submitIcon.click(function () {
    if (isOpen == false) {
      searchBox.addClass('searchbox-open');
      submitButton.css('visibility', 'visible')
      inputBox.focus();
      isOpen = true;
    } else {
      searchBox.removeClass('searchbox-open');
      inputBox.focusout();
      isOpen = false;
    }
  });

  function buttonUp() {
    var inputVal = $('.searchbox-input').val();
    inputVal = $.trim(inputVal).length;
    if (inputVal !== 0) {
      //customize this line of code to show X
      //$('.searchbox-icon').css('display','none');
    } else {
      $('.searchbox-input').val('');
      $('.searchbox-icon').css('display', 'block');
    }
  }
  inputBox.keyup(buttonUp);
});



// dropdowns user when login

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function F_Dropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var x;
    for (x = 0; x < dropdowns.length; x++) {
      var openDropdown = dropdowns[x];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
// dropdown more
function F_Dropdown_more_edit() {
  document.getElementById("myDropdown-more-edit").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function (e) {
  if (!e.target.matches('.dropbtn-more-edit')) {
    var dropdowns_edit = document.getElementsByClassName("dropdown-content-more-edit");
    var i;
    for (i = 0; i < dropdowns_edit.length; i++) {
      var openDropdown_edit = dropdowns_edit[i];
      if (openDropdown_edit.classList.contains('show')) {
        openDropdown_edit.classList.remove('show');
      }
    }
  }
}


// Replace the 5 with your initial rating value
let ratingValue = 0;
  
const ratingContainer = document.getElementById('rating-container');

// Function to create stars based on the rating value
function createStars() {
  ratingContainer.innerHTML = ''; // Clear previous stars

  for (let i = 1; i <= 10; i++) {
    const star = document.createElement('span');
    star.className = 'star';
    star.innerHTML = (i <= ratingValue) ? '★' : '☆';
    star.addEventListener('click', () => setRating(i));
    ratingContainer.appendChild(star);
  }
}

// Function to set the rating value
function setRating(value) {
  ratingValue = value;
  console.log(ratingValue);
  createStars();
  document.getElementById("rating-input").value = value;
}

// Initial creation of stars
createStars();


//  side media
const carousel = document.querySelector(".carousel"),
  firstImg = carousel.querySelectorAll("img")[0],
  arrowIcons = document.querySelectorAll(".wrapper-media i");

let isDragStart = false, isDragging = false, prevPageX, prevScrollLeft, positionDiff;

const showHideIcons = () => {
  // showing and hiding prev/next icon according to carousel scroll left value
  let scrollWidth = carousel.scrollWidth - carousel.clientWidth; // getting max scrollable width
  arrowIcons[0].style.display = carousel.scrollLeft == 0 ? "none" : "block";
  arrowIcons[1].style.display = carousel.scrollLeft == scrollWidth ? "none" : "block";
}

arrowIcons.forEach(icon => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImg.clientWidth + 14; // getting first img width & adding 14 margin value
    // if clicked icon is left, reduce width value from the carousel scroll left else add to it
    carousel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
    setTimeout(() => showHideIcons(), 60); // calling showHideIcons after 60ms
  });
});

const autoSlide = () => {
  // if there is no image left to scroll then return from here
  if (carousel.scrollLeft - (carousel.scrollWidth - carousel.clientWidth) > -1 || carousel.scrollLeft <= 0) return;

  positionDiff = Math.abs(positionDiff); // making positionDiff value to positive
  let firstImgWidth = firstImg.clientWidth + 14;
  // getting difference value that needs to add or reduce from carousel left to take middle img center
  let valDifference = firstImgWidth - positionDiff;

  if (carousel.scrollLeft > prevScrollLeft) { // if user is scrolling to the right
    return carousel.scrollLeft += positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
  }
  // if user is scrolling to the left
  carousel.scrollLeft -= positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
}

const dragStart = (e) => {
  // updatating global variables value on mouse down event
  isDragStart = true;
  prevPageX = e.pageX || e.touches[0].pageX;
  prevScrollLeft = carousel.scrollLeft;
}

const dragging = (e) => {
  // scrolling images/carousel to left according to mouse pointer
  if (!isDragStart) return;
  e.preventDefault();
  isDragging = true;
  carousel.classList.add("dragging");
  positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX;
  carousel.scrollLeft = prevScrollLeft - positionDiff;
  showHideIcons();
}

const dragStop = () => {
  isDragStart = false;
  carousel.classList.remove("dragging");

  if (!isDragging) return;
  isDragging = false;
  autoSlide();
}

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("touchstart", dragStart);

document.addEventListener("mousemove", dragging);
carousel.addEventListener("touchmove", dragging);

document.addEventListener("mouseup", dragStop);
carousel.addEventListener("touchend", dragStop);


// cmt without login
function userNeedLogin() {
  Swal.fire({
    title: "You must login to rate",
    // text: "You must login to rate",
    icon: "error"
  });
}
function click_follow(){
  Swal.fire({
    title: "Follow successfully!",
    text: "You will receive the latest notification about this",
    icon: "success"
  });}
// cmt with login
function confirm_delete_cmt(){
  var form = document.getElementById("delete-form");
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      form.submit();
    }
  });
}


function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function editForm() {
  document.getElementById("editForm").style.display = "block";
}

function closeEditForm() {
  document.getElementById("editForm").style.display = "none";
}

// show more cmt

// var btnMoreLess =  document.getElementById("myBtn-more-less")
// btnMoreLess.addEventListener("click", showMore)
// btnMoreLess.addEventListener("click", changeIcon)
// }
function showMore() {
  console.log('show more is actived')
  var more = document.getElementsByClassName("cmt-of-user-box more-cmt");
  var moreIcon = document.getElementById("btnmore")
  for (let i = 0; i < more.length; i++) {
    if (more[i].style.display === "none") {//nếu dots không đc hiển thị
      more[i].style.display = "block";// thì dot hiển thị ở dạng inline
    } else {
      more[i].style.display = "none";
      //btnText.innerHTML = "Read less"; 
      //moreText.style.display = "inline";
    }
  }

}
// function changeIcon(iconChange) {
//   iconChange.closest('.wrapper-more-less').classList.toggle('active-more-less');
// }


// bonus js
function receive() {
  alert("You have become a member of Netflop");
}

function mark_readed(element){
  element.style.backgroundColor = "rgba(136, 136, 136, 0.09)"; 
}
