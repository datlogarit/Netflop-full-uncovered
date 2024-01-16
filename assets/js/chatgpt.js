function chatSubmit(){
    var inp = document.getElementById("main-input");
    var btn = document.getElementById("main-btn");

    setTimeout(function(){
        inp.value = "";
    }, 10);

    if(inp.value != ""){
        setTimeout(function(){
            btn.innerHTML = "<i class=\"fa-solid fa-spinner fa-3x fa-pulse flex items-center ml-3\"></i>";
            btn.style.color = "rgb(227, 216, 3)";
            inp.disabled = true;
            btn.disabled = true;
        }, 10)

        Swal.fire({
            title: "Please wait!",
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
            }
        });
    }
  }