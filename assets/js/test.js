function ok() {
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
      Swal.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success"
      });
    }
  });
}

function myFunction() {
  // var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (moreText.style.display === "none") {
    moreText.style.display = "inline";//dots hiển thị thì moreText none
    btnText.innerHTML = "Read less"; 
    //moreText.style.display = "none";
  } else {
    moreText.style.display = "none";
    btnText.innerHTML = "Read more"; 
    //moreText.style.display = "inline";
  }
}
function changeIcon(iconChange) {
  iconChange.closest('.wrapper-more-less').classList.toggle('active-more-less');
}
function target_popup(form) {
  window.open('', 'formpopup', 'width=400,height=400,resizeable,scrollbars');
  form.target = 'formpopup';
}
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
