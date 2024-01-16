<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AI Chat &mdash; NetFlop</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo _DEFAULT_PATH ?>/assets/images/favicon.svg" type="image/svg+xml" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              clifford: "#da373d",
            },
          },
        },
      };
    </script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body class="bg-[#242526]" onload="window.scrollTo(0, document.body.scrollHeight)">
    <html>
      <header>
        <title>Mobile Chat Layout</title>
      </header>
      <body >
        <div style="overscroll-behavior: none">
          <div
            class="fixed w-full bg-[#e3d803] h-16 pt-1 text-white flex shadow-md justify-between px-4"
            style="top: 0px; overscroll-behavior: none"
          >
            <!-- back button -->
            <a class="my-auto" href="<?php echo _DEFAULT_PATH ?>"><i class="fa-solid fa-home text-black my-auto text-[20px]"></i></a>
            
            <div class="my-3 text-[#333] font-bold text-2xl tracking-wide">
              @NetFlop
            </div>
            <!-- 3 dots -->
            
          </div>

          <div class="mt-20 mb-16 text-white">
            <div
              class="bg-[#303030] text-[18px] font-medium mx-auto w-[50%] text-center shadow-lg p-1 mt-[20px] mb-[50px]"
            >
              <h4 class="text-[23px] font-bold mb-1">NOTICE</h4>
<?php

if(!empty($_SESSION['user_username'])){
  echo 'Your questions and AI\'s answers are only saved in your login session, if you logout or close the browser, everything will be cleared!';
}else{
  echo 'You need a NetFlop account to use this feature!';
}

?>
              
            </div>
            <div class="clearfix flex">
              <i class="fa-solid fa-robot flex items-center ml-3"></i>
              <div class="bg-[#303030] mx-4 my-2 p-2 rounded-lg" style="max-width: 75%;">
                Ask me something ^^
              </div>
            </div>

<?php

if(!empty($_SESSION['chatgpt']['user_input'])){
  for($i = 0; $i < count($_SESSION['chatgpt']['user_input']); $i++){
    echo '
            <div class="clearfix flex flex-row-reverse">
              <i class="fa-solid fa-user flex items-center mr-3"></i>
              <div class="text-[#000] bg-[#e3d803] float-right mx-4 my-2 p-2 rounded-lg clearfix" style="max-width: 75%">
                '.$_SESSION['chatgpt']['user_input'][$i].'
              </div>
            </div>
    ';

    echo '
            <div class="clearfix flex">
              <i class="fa-solid fa-robot flex items-center ml-3"></i>
              <div class="bg-[#303030] mx-4 my-2 p-2 rounded-lg" style="max-width: 75%;">
                '.$_SESSION['chatgpt']['gpt_result'][$i].'
              </div>
            </div>
    ';
  }
}

?>

          </div>
        </div>

<?php

if(!empty($_SESSION['user_username'])){
  echo '
        <div
          class="fixed w-full flex justify-between"
          style="bottom: 0px; background-color: #242526;"
        >
          <input
            id="main-input"
            form="chatgpt"
            name="body"
            class="text-[#fff] flex-grow m-2 py-2 px-4 mr-1 rounded-full border border-gray-300 bg-[#3a3b3c] resize-none hover:border-[#fff]  focus:border-[#fff]"
            rows="1"
            placeholder="Try asking something..."
            style="outline: none"
            required
            autocomplete="off"
          >
          <button form="chatgpt" class="m-2" style="outline: none" id="main-btn" onclick="chatSubmit()">
            <svg
              class="svg-inline--fa text-[#e3d803] fa-paper-plane fa-w-16 w-12 h-12 py-2 mr-2"
              aria-hidden="true"
              focusable="false"
              data-prefix="fas"
              data-icon="paper-plane"
              role="img"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
            >
              <path
                fill="currentColor"
                d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"
              />
            </svg>
          </button>
        </div>

        <form id="chatgpt" action="'._DEFAULT_PATH.'/chatgpt/handling" method="post" style="display: none;"></form>
';}

?>

<!-- library of popup -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- custom js link-->
<script src="<?php echo _DEFAULT_PATH ?>/assets/js/chatgpt.js"></script>

      </body>
    </html>
  </body>
</html>
