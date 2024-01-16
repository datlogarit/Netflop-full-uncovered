<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users &mdash; NetFlop Admin</title>
    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <!-- icon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo _DEFAULT_PATH.'/assets/images'; ?>/favicon.svg" type="image/svg+xml" />

    <!-- custom css link-->
    <link rel="stylesheet" href="<?php echo _DEFAULT_PATH ?>/assets/css/admin-page.css">
    <link rel="stylesheet" href="<?php echo _DEFAULT_PATH ?>/assets/css/style.css" />
    <!--google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="top" 
<?php
if(!empty($msg['announcement'])){
    echo 'onload="announcement()"';
}

if(!empty($msg['user_ban'])){
    echo 'onload="user_ban()"';
}

if(!empty($msg['user_unban'])){
    echo 'onload="user_unban()"';
}
?>
>
    <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
      <div class="container">
        <div class="overlay" data-overlay></div>
        <a href="<?php echo _DEFAULT_PATH ?>"><h1 class="logo-index">NetFlop</h1></a>
        <!-- </button> -->

        <div class="header-actions">

          <!-- search-button -->
          <div id="searchbar" class="collapsed">
            <div id="search-box">
              <div id="sliding-panel-outer">
                <div id="sliding-panel-inner">
                  <input
                    type="text"
                    name="keyword"
                    id="search-input"
                    placeholder="Text here to search"
                    form="search-form"
                    required
                  />
                  <button id="search-submit" form="search-form">Search</button>
                </div>
                <!--#sliding-panel-inner-->
              </div>
              <!--#sliding-panel-outer-->

              <div class="search-label">
                <i class="fa fa-search"></i>
                <i class="fa fa-times"></i>
              </div>
            </div>
            <!--#search-box-->
          </div>
          <form action="<?php echo _DEFAULT_PATH ?>/search" method="get" id="search-form" style="display: hidden;"></form>
          <!--#searchbar-->

          <?php
          if(empty($_SESSION['user_role'])){
            echo '
          <a href="'._DEFAULT_PATH.'/login"
            ><button class="btn btn-primary">Login</button>
          </a>
          ';}else{
            echo '
            <div class="dropdown">
              <button onclick="F_Dropdown()" class="dropbtn">
                <div class="avt-user">
                  <i class="fa-regular fa-circle-user"></i>
                  <span>';
            if(!empty($_SESSION['user_fullname'])){
              echo $_SESSION['user_fullname'];
            }else{
              echo $_SESSION['user_username'];
            }
            echo '</span>
                  <i class="fa-solid fa-caret-down"></i>
                </div>
              </button>

              <div id="myDropdown" class="dropdown-content">
                <a href="'._DEFAULT_PATH.'/account">Your Account</a>';
            if($_SESSION['user_role'] == 'admin'){
              echo '<a href="'._DEFAULT_PATH.'/admin">Admin Page</a>';
              echo '<a href="'._DEFAULT_PATH.'/admin/users_manage">Users Manage</a>';
            }
            echo '<a href="'._DEFAULT_PATH.'/home/logout">Logout</a>
              </div>
            </div>
            ';

            //Notifications
            echo '
              <div class="header-actions-notify">
                <i class="fa-solid fa-bell notify-icon position-relative"></i>';

            if(!empty($user_notifications_vol)){
              echo '<span class="position-absolute top-10 start-100 badge text-bg-secondary">'.$user_notifications_vol.'</span>';
            }

            echo
                '<div class="notify">
                  <header class="header-noty">Your notifications</header>
                  <ul class="noty-list">';
            if(!empty($user_notifications_vol)){
              $user_notifications = array_reverse($user_notifications);
              foreach($user_notifications as $notification){
                echo '<li class="noty-details"">
                <form action="'._DEFAULT_PATH.'/home/remove_notification" method="post" style="padding-left: 10px; padding-right: 15px; padding-top: 10px;">
                  <input type="hidden" name="redirect_path" value="';
                  if(!empty($_SERVER['PATH_INFO'])){
                    echo $_SERVER['PATH_INFO'];
                  }else{
                    echo _DEFAULT_PATH;
                  }
                  echo'">
                  <input type="hidden" name="not_id" value="'.$notification['not_id'].'">
                  <button><ion-icon name="close-outline"></ion-icon></button>
                </form>
                <div class="noty-details-content">';
                if($notification['post_id'] == 'admin'){
                  echo '<h6>'.$notification['body'].'</h6>';
                }else{
                  echo '<a href="'._DEFAULT_PATH.'/detail/'.$notification['post_id'].'">'.$notification['body'].'</a>';
                }
                  echo '<p>'.$notification['posted_time'].'</p>
                </div>
              </li>';
              }
            }else{
              echo '<p style="text-align: center">There aren\'t any new notifications</p>';
            }
            echo '</ul>
                </div>
              </div>';
          }
          ?>
        </div>

        <button class="menu-open-btn" data-menu-open-btn>
          <ion-icon name="reorder-two"></ion-icon>
        </button>

        <nav class="navbar" data-navbar>
          <div class="navbar-top">
            <a href="#"><h1 class="logo-index">NetFlop</h1></a>

            <button class="menu-close-btn" data-menu-close-btn>
              <ion-icon name="close-outline"></ion-icon>
            </button>
          </div>

          <ul class="navbar-list">

            <li>
              <a href="<?php echo _DEFAULT_PATH ?>/movies" class="navbar-link">Movie</a>
            </li>

            <li>
              <a href="<?php echo _DEFAULT_PATH ?>/tvshows" class="navbar-link">TV Show</a>
            </li>

            <li>
              <a href="<?php echo _DEFAULT_PATH ?>/about" class="navbar-link">About Us</a>
            </li>

            <li>
              <a href="<?php echo _DEFAULT_PATH ?>/chatgpt" class="navbar-link">AI Chat</a>
            </li>
          </ul>

          <ul class="navbar-social-list">
            <li>
              <a href="#" class="navbar-social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="navbar-social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="navbar-social-link">
                <ion-icon name="logo-pinterest"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="navbar-social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="navbar-social-link">
                <ion-icon name="logo-youtube"></ion-icon>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <main>
        <article>
            <section class="nar-inf">
                <i class="fa-solid fa-user-gear"></i>
                <h5>ADMIN</h5>
            </section>
            <form class="control-input-search" method="get">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" class="input-search-user" placeholder="Search for users...">
                <button class="search-user">Search</button>
            </form>
            <section class="body-inf">
                <div class="suggest-content">
                    <div class="menu-option">
                        <i class="fa-solid fa-bars"></i>
                        <h5>Page</h5>
                    </div>
                    <div class="option">
                        <a href="<?php echo _DEFAULT_PATH ?>/admin" class="option-film">
                            <h6 style="margin-left: 18px;">Reports management</h6>
                        </a>
                        <a href="<?php echo _DEFAULT_PATH ?>/admin/users_manage" class="option-film">
                            <i class="fa-solid fa-caret-right"></i>
                            <h6 style="color: rgb(227, 216, 3);">Users management</h6>
                        </a>
                    </div>
                </div>
                <div class="content">
                    <h3>Users management</h3>
                    <div class="body-report-request">
                        <div class="container">
                            <div class="row row-title">
                                <div class="col">
                                    <h5>Username</h5>
                                </div>
                                <div class="col">
                                    <h5>Email</h5>
                                </div>
                                <div class="col">
                                    <h5>Action</h5>
                                </div>
                            </div>
                            <?php
                            if(!empty($_GET['search'])){
                                $users = Helper::getUsers($_GET['search']);

                                if(!empty($users)){
                                    foreach($users as $user){
                                        echo '
                                        <div class="row">
                                            <div class="col">
                                                <div class="inf-user-report">
                                                    <i class="fa-solid fa-circle-user"></i>
                                                    <p>'.$user['username'].'</p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="inf-user-report">
                                                    <p>'.$user['email'].'</p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="control-action">';
                                                    if($user['username'] != 'admin' && $user['username'] != $_SESSION['user_username']){
                                                        if($user['status'] == 1){
                                                            echo '<button style="width: 75px;" onclick="ban_'.$user['username'].'()">BAN</button>';
                                                            echo '
                                                            <script>
                                                            function ban_'.$user['username'].'(){
                                                                var form = document.getElementById("form_ban_'.$user['username'].'");
                                                                Swal.fire({
                                                                    title: "Ban '.$user['username'].'?",
                                                                    icon: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#3085D6",
                                                                    cancelButtonColor: "#D33",
                                                                    confirmButtonText: "Yes"
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        form.submit();
                                                                    }
                                                                });
                                                            }
                                                            </script>
                                                            <form id="form_ban_'.$user['username'].'" action="'._DEFAULT_PATH.'/admin/ban" method="POST">
                                                                <input type="hidden" name="username" value="'.$user['username'].'">
                                                                <input type="hidden" name="redirect_path" value="'.$_SERVER['PATH_INFO'].'">
                                                            </form>
                                                            ';
                                                        }else{
                                                            echo '<button style="background-color: blue;" onclick="unban_'.$user['username'].'()">UNBAN</button>';
                                                            echo '
                                                            <script>
                                                            function unban_'.$user['username'].'(){
                                                                var form = document.getElementById("form_unban_'.$user['username'].'");
                                                                Swal.fire({
                                                                    title: "Unban '.$user['username'].'?",
                                                                    icon: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#3085D6",
                                                                    cancelButtonColor: "#D33",
                                                                    confirmButtonText: "Yes"
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        form.submit();
                                                                    }
                                                                });
                                                            }
                                                            </script>
                                                            <form id="form_unban_'.$user['username'].'" action="'._DEFAULT_PATH.'/admin/unban" method="POST">
                                                                <input type="hidden" name="username" value="'.$user['username'].'">
                                                            </form>
                                                            ';
                                                        }
                                                    }
                                                echo '</div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }else{
                                    echo '<div class="row"><div class="col"><p style="margin-left: 100px; font-style: italic;">There is no users matches your search!</p></div></div>';
                                }
                            }else{
                                $all_users = Helper::getUsers();
                                $user_count = count($all_users);
                                $page_num = ceil($user_count / 10);

                                if(!empty($_GET['page'])){
                                    if($_GET['page'] < $page_num && $_GET['page'] > 0){
                                        for($index = 10 * ($_GET['page'] - 1); $index < 10 * $_GET['page']; $index++){
                                            echo '
                                            <div class="row">
                                                <div class="col">
                                                    <div class="inf-user-report">
                                                        <i class="fa-solid fa-circle-user"></i>
                                                        <p>'.$all_users[$index]['username'].'</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="inf-user-report">
                                                        <p>'.$all_users[$index]['email'].'</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="control-action">';
                                                        if($all_users[$index]['username'] != 'admin' && $all_users[$index]['username'] != $_SESSION['user_username']){
                                                            if($all_users[$index]['status'] == 1){
                                                                echo '<button style="width: 75px;" onclick="ban_'.$all_users[$index]['username'].'()">BAN</button>';
                                                                echo '
                                                                <script>
                                                                function ban_'.$all_users[$index]['username'].'(){
                                                                    var form = document.getElementById("form_ban_'.$all_users[$index]['username'].'");
                                                                    Swal.fire({
                                                                        title: "Ban '.$all_users[$index]['username'].'?",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#3085D6",
                                                                        cancelButtonColor: "#D33",
                                                                        confirmButtonText: "Yes"
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            form.submit();
                                                                        }
                                                                    });
                                                                }
                                                                </script>
                                                                <form id="form_ban_'.$all_users[$index]['username'].'" action="'._DEFAULT_PATH.'/admin/ban" method="POST">
                                                                    <input type="hidden" name="username" value="'.$all_users[$index]['username'].'">
                                                                    <input type="hidden" name="redirect_path" value="'.$_SERVER['PATH_INFO'].'">
                                                                </form>
                                                                ';
                                                            }else{
                                                                echo '<button style="background-color: blue;" onclick="unban_'.$all_users[$index]['username'].'()">UNBAN</button>';
                                                                echo '
                                                                <script>
                                                                function unban_'.$all_users[$index]['username'].'(){
                                                                    var form = document.getElementById("form_unban_'.$all_users[$index]['username'].'");
                                                                    Swal.fire({
                                                                        title: "Unban '.$all_users[$index]['username'].'?",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#3085D6",
                                                                        cancelButtonColor: "#D33",
                                                                        confirmButtonText: "Yes"
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            form.submit();
                                                                        }
                                                                    });
                                                                }
                                                                </script>
                                                                <form id="form_unban_'.$all_users[$index]['username'].'" action="'._DEFAULT_PATH.'/admin/unban" method="POST">
                                                                    <input type="hidden" name="username" value="'.$all_users[$index]['username'].'">
                                                                </form>
                                                                ';
                                                            }
                                                        }
                                                    echo '</div>
                                                </div>
                                            </div>
                                            ';
                                        }
                                    }else{
                                        for($index = 10 * ($_GET['page'] - 1); $index < $user_count; $index++){
                                            echo '
                                            <div class="row">
                                                <div class="col">
                                                    <div class="inf-user-report">
                                                        <i class="fa-solid fa-circle-user"></i>
                                                        <p>'.$all_users[$index]['username'].'</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="inf-user-report">
                                                        <p>'.$all_users[$index]['email'].'</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="control-action">';
                                                        if($all_users[$index]['username'] != 'admin' && $all_users[$index]['username'] != $_SESSION['user_username']){
                                                            if($all_users[$index]['status'] == 1){
                                                                echo '<button style="width: 75px;" onclick="ban_'.$all_users[$index]['username'].'()">BAN</button>';
                                                                echo '
                                                                <script>
                                                                function ban_'.$all_users[$index]['username'].'(){
                                                                    var form = document.getElementById("form_ban_'.$all_users[$index]['username'].'");
                                                                    Swal.fire({
                                                                        title: "Ban '.$all_users[$index]['username'].'?",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#3085D6",
                                                                        cancelButtonColor: "#D33",
                                                                        confirmButtonText: "Yes"
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            form.submit();
                                                                        }
                                                                    });
                                                                }
                                                                </script>
                                                                <form id="form_ban_'.$all_users[$index]['username'].'" action="'._DEFAULT_PATH.'/admin/ban" method="POST">
                                                                    <input type="hidden" name="username" value="'.$all_users[$index]['username'].'">
                                                                    <input type="hidden" name="redirect_path" value="'.$_SERVER['PATH_INFO'].'">
                                                                </form>
                                                                ';
                                                            }else{
                                                                echo '<button style="background-color: blue;" onclick="unban_'.$all_users[$index]['username'].'()">UNBAN</button>';
                                                                echo '
                                                                <script>
                                                                function unban_'.$all_users[$index]['username'].'(){
                                                                    var form = document.getElementById("form_unban_'.$all_users[$index]['username'].'");
                                                                    Swal.fire({
                                                                        title: "Unban '.$all_users[$index]['username'].'?",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#3085D6",
                                                                        cancelButtonColor: "#D33",
                                                                        confirmButtonText: "Yes"
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            form.submit();
                                                                        }
                                                                    });
                                                                }
                                                                </script>
                                                                <form id="form_unban_'.$all_users[$index]['username'].'" action="'._DEFAULT_PATH.'/admin/unban" method="POST">
                                                                    <input type="hidden" name="username" value="'.$all_users[$index]['username'].'">
                                                                </form>
                                                                ';
                                                            }
                                                        }
                                                    echo '</div>
                                                </div>
                                            </div>
                                            ';
                                        }
                                    }
                                }else{
                                    if($user_count < 10){
                                        for($index = 0; $index < $user_count; $index++){
                                            echo '
                                            <div class="row">
                                                <div class="col">
                                                    <div class="inf-user-report">
                                                        <i class="fa-solid fa-circle-user"></i>
                                                        <p>'.$all_users[$index]['username'].'</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="inf-user-report">
                                                        <p>'.$all_users[$index]['email'].'</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="control-action">';
                                                        if($all_users[$index]['username'] != 'admin' && $all_users[$index]['username'] != $_SESSION['user_username']){
                                                            if($all_users[$index]['status'] == 1){
                                                                echo '<button style="width: 75px;" onclick="ban_'.$all_users[$index]['username'].'()">BAN</button>';
                                                                echo '
                                                                <script>
                                                                function ban_'.$all_users[$index]['username'].'(){
                                                                    var form = document.getElementById("form_ban_'.$all_users[$index]['username'].'");
                                                                    Swal.fire({
                                                                        title: "Ban '.$all_users[$index]['username'].'?",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#3085D6",
                                                                        cancelButtonColor: "#D33",
                                                                        confirmButtonText: "Yes"
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            form.submit();
                                                                        }
                                                                    });
                                                                }
                                                                </script>
                                                                <form id="form_ban_'.$all_users[$index]['username'].'" action="'._DEFAULT_PATH.'/admin/ban" method="POST">
                                                                    <input type="hidden" name="username" value="'.$all_users[$index]['username'].'">
                                                                    <input type="hidden" name="redirect_path" value="'.$_SERVER['PATH_INFO'].'">
                                                                </form>
                                                                ';
                                                            }else{
                                                                echo '<button style="background-color: blue;" onclick="unban_'.$all_users[$index]['username'].'()">UNBAN</button>';
                                                                echo '
                                                                <script>
                                                                function unban_'.$all_users[$index]['username'].'(){
                                                                    var form = document.getElementById("form_unban_'.$all_users[$index]['username'].'");
                                                                    Swal.fire({
                                                                        title: "Unban '.$all_users[$index]['username'].'?",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#3085D6",
                                                                        cancelButtonColor: "#D33",
                                                                        confirmButtonText: "Yes"
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            form.submit();
                                                                        }
                                                                    });
                                                                }
                                                                </script>
                                                                <form id="form_unban_'.$all_users[$index]['username'].'" action="'._DEFAULT_PATH.'/admin/unban" method="POST">
                                                                    <input type="hidden" name="username" value="'.$all_users[$index]['username'].'">
                                                                </form>
                                                                ';
                                                            }
                                                        }
                                                    echo '</div>
                                                </div>
                                            </div>
                                            ';
                                        }
                                    }else{
                                        for($index = 0; $index < 10; $index++){
                                            echo '
                                            <div class="row">
                                                <div class="col">
                                                    <div class="inf-user-report">
                                                        <i class="fa-solid fa-circle-user"></i>
                                                        <p>'.$all_users[$index]['username'].'</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="inf-user-report">
                                                        <p>'.$all_users[$index]['email'].'</p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="control-action">';
                                                        if($all_users[$index]['username'] != 'admin' && $all_users[$index]['username'] != $_SESSION['user_username']){
                                                            if($all_users[$index]['status'] == 1){
                                                                echo '<button style="width: 75px;" onclick="ban_'.$all_users[$index]['username'].'()">BAN</button>';
                                                                echo '
                                                                <script>
                                                                function ban_'.$all_users[$index]['username'].'(){
                                                                    var form = document.getElementById("form_ban_'.$all_users[$index]['username'].'");
                                                                    Swal.fire({
                                                                        title: "Ban '.$all_users[$index]['username'].'?",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#3085D6",
                                                                        cancelButtonColor: "#D33",
                                                                        confirmButtonText: "Yes"
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            form.submit();
                                                                        }
                                                                    });
                                                                }
                                                                </script>
                                                                <form id="form_ban_'.$all_users[$index]['username'].'" action="'._DEFAULT_PATH.'/admin/ban" method="POST">
                                                                    <input type="hidden" name="username" value="'.$all_users[$index]['username'].'">
                                                                    <input type="hidden" name="redirect_path" value="'.$_SERVER['PATH_INFO'].'">
                                                                </form>
                                                                ';
                                                            }else{
                                                                echo '<button style="background-color: blue;" onclick="unban_'.$all_users[$index]['username'].'()">UNBAN</button>';
                                                                echo '
                                                                <script>
                                                                function unban_'.$all_users[$index]['username'].'(){
                                                                    var form = document.getElementById("form_unban_'.$all_users[$index]['username'].'");
                                                                    Swal.fire({
                                                                        title: "Unban '.$all_users[$index]['username'].'?",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#3085D6",
                                                                        cancelButtonColor: "#D33",
                                                                        confirmButtonText: "Yes"
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            form.submit();
                                                                        }
                                                                    });
                                                                }
                                                                </script>
                                                                <form id="form_unban_'.$all_users[$index]['username'].'" action="'._DEFAULT_PATH.'/admin/unban" method="POST">
                                                                    <input type="hidden" name="username" value="'.$all_users[$index]['username'].'">
                                                                </form>
                                                                ';
                                                            }
                                                        }
                                                    echo '</div>
                                                </div>
                                            </div>
                                            ';
                                        }
                                    }
                                }

                                if($page_num > 1){
                                    if(!empty($_GET['page'])){
                                        $page = $_GET['page'];
                                    }else{
                                        $page = 1;
                                    }
                                    echo '
                                    <div class="next-page">
                                        <div class="next-page-control">';

                                        if($page > 1 && $page <= $page_num){
                                            echo '<a href="?page='.($page - 1).'"><i class="fa-solid fa-backward-step"></i></a>';
                                        }

                                        for($i = 1; $i <= $page_num; $i++){
                                            if($i == $page){
                                            echo '<a href=""><div class="number-page current-page">'.$i.'</div></a>';
                                            }else{
                                            echo '<a href="?page='.$i.'"><div class="number-page">'.$i.'</div></a>';
                                            }
                                        }

                                        if($page < $page_num && $page >= 1){
                                            echo '<a href="?page='.($page + 1).'"><i class="fa-solid fa-forward-step"></i></a>';
                                        }

                                        echo '</div>
                                    </div>
                                    ';
                                }
                            }
                            ?>
                            
                        </div>
                    </div>

                    <?php
                    if($_SESSION['user_username'] == 'admin'){
                        echo '
                        <h3>General notification:</h3>
                        <form action="'._DEFAULT_PATH.'/admin/send_announcement" method="POST" class="form-gene-noty" style="margin-right: 150px;">
                            <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none;"></textarea>
                            <button class="submit-gene-noty">Send</button>
                        </form>
                        ';
                    }
                    ?>

                </div>

            </section>
        </article>
    </main>

    <!-- 
    - #FOOTER
  -->

  <footer class="footer">
      <div class="footer-top">
        <div class="container">
          <div class="footer-brand-wrapper">
            <a href="#"><h1 class="logo-index">NetFlop</h1></a>

            <ul class="footer-list">
              <li>
                <a href="<?php echo _DEFAULT_PATH ?>/movies" class="footer-link">Movie</a>
              </li>

              <li>
                <a href="<?php echo _DEFAULT_PATH ?>/tvshows" class="footer-link">TV Show</a>
              </li>

              <li>
                <a href="<?php echo _DEFAULT_PATH ?>/about" class="footer-link">About Us</a>
              </li>

              <li>
                <a href="<?php echo _DEFAULT_PATH ?>/chatgpt" class="footer-link">AI Chat</a>
              </li>
            </ul>
          </div>

          <div class="divider"></div>

          <div class="quicklink-wrapper">
            <ul class="quicklink-list">
              <li>
                <a href="<?php echo _DEFAULT_PATH ?>/about" class="quicklink-link">Faq</a>
              </li>

              <li>
                <a href="<?php echo _DEFAULT_PATH ?>/about" class="quicklink-link">Help center</a>
              </li>

              <li>
                <a href="<?php echo _DEFAULT_PATH ?>/about" class="quicklink-link">Terms of use</a>
              </li>

              <li>
                <a href="<?php echo _DEFAULT_PATH ?>/about" class="quicklink-link">Privacy</a>
              </li>
            </ul>

            <ul class="social-list">
              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-pinterest"></ion-icon>
                </a>
              </li>

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-linkedin"></ion-icon>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <div class="container">
          <p class="copyright">
            &copy; 2023 <a href="<?php echo _DEFAULT_PATH ?>">NetFlop</a> - By Group 58 ACTVN - API from <a href="https://www.themoviedb.org/">The Movie Database (TMDB)</a>
          </p>

          <img
            src="<?php echo _DEFAULT_PATH ?>/assets/images/tmdb_p_long.svg"
            alt="Online banking companies logo"
            class="footer-bottom-img"
            style="width: 250px;"
          />
        </div>
      </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <!-- GO TO TOP -->
    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up"></ion-icon>
    </a>
    <!-- library of pupup -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- custom js link-->
    <script src="<?php echo _DEFAULT_PATH ?>/assets/js/admin-page.js"></script>
    <!--icon with ionicon link-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- boostrap -->
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function announcement(){
            Swal.fire({
            title: "<?php if(!empty($msg['announcement'])){ echo $msg['announcement']; } ?>",
            icon: "info"
        });}

        function user_ban(){
            Swal.fire({
            title: "<?php if(!empty($msg['user_ban'])){ echo $msg['user_ban']; } ?>",
            icon: "info"
        });}

        function user_unban(){
            Swal.fire({
            title: "<?php if(!empty($msg['user_unban'])){ echo $msg['user_unban']; } ?>",
            icon: "info"
        });}
    </script>
</body>

</html>