<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $_SESSION['user_username'] ?> &mdash; NetFlop account</title>
  <!-- boostrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <!-- icon -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

  <!-- favicon -->
  <link rel="shortcut icon" href="<?php echo _DEFAULT_PATH.'/assets/images'; ?>/favicon.svg" type="image/svg+xml" />

  <!-- custom css link-->
  <link rel="stylesheet" href="<?php echo _DEFAULT_PATH ?>/assets/css/style.css" />
  <link rel="stylesheet" href="<?php echo _DEFAULT_PATH ?>/assets/css/user-page.css">
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
if(!empty($info_valid_msg)){
  echo 'onload="info_valid_msg()"';
}

if(!empty($email_valid_msg)){
  echo 'onload="email_valid_msg()"';
}

if(!empty($repass_valid_msg)){
  echo 'onload="repass_valid_msg()"';
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
        <i class="fa-solid fa-user-pen"></i>
        <h5><?php echo $_SESSION['user_username']; ?></h5>
      </section>
      <section class="body-inf">
        <div class="suggest-content">
          <div class="menu-option">
            <i class="fa-solid fa-bars"></i>
            <h5>NetFlop account</h5>
          </div>

        </div>
        <div class="content" id="myForm">
          <div class="information">
            <hr style="border-color: rgb(227, 216, 3); opacity: 1; margin-right: 25px;">
            <h4>Personal informations:</h4>
            <div class="edit-info">
              <form id="per_info" action="<?php echo _DEFAULT_PATH.'/account/edit_info' ?>" method="post">
                <input type="hidden" name="created_time" value="<?php echo $_SESSION['user_created_at'] ?>">
                <h6>Full name:</h6>
                <input id="fullname" name="fullname" required value="<?php if(!empty($_SESSION['user_fullname'])){ echo $_SESSION['user_fullname'];} ?>">
                <h6 style="margin-top: 10px;">Day of Birth:</h6>
                <input type="date" name="dob" required value="<?php if(!empty($_SESSION['user_dob'])){ echo $_SESSION['user_dob'];} ?>" style="color-scheme: dark;">
              </form>
              <button onclick="per_info_confirm()">Edit</button>
            </div>
            <hr style="border-color: rgb(227, 216, 3); opacity: 1; margin-right: 25px;">
            <h4>Email:</h4>
            <div class="edit-info">
              <form id="email_info" action="<?php echo _DEFAULT_PATH.'/account/edit_email' ?>" method="post">
                <input type="hidden" name="created_time" value="<?php echo $_SESSION['user_created_at'] ?>">
                <input id="email" name="email" required value="<?php if(!empty($_SESSION['user_email'])){ echo $_SESSION['user_email'];} ?>">
              </form>
              <button onclick="email_info_confirm()">Edit</button>
            </div>
            <hr style="border-color: rgb(227, 216, 3); opacity: 1; margin-right: 25px;">
            <h4>Change Password:</h4>
            <div class="edit-info">
              <form id="password_info" action="<?php echo _DEFAULT_PATH.'/account/edit_password' ?>" method="post">
                <input type="hidden" name="created_time" value="<?php echo $_SESSION['user_created_at'] ?>">
                <input type="password" name="old_password" required placeholder="OLD PASSWORD...">
                <input type="password" name="password" required placeholder="NEW PASSWORD...">
                <input type="password" name="cfm_password" required placeholder="CONFIRM NEW PASSWORD...">
              </form>
              <button onclick="password_info_confirm()">Edit</button>
            </div>
            <hr style="border-color: rgb(227, 216, 3); opacity: 1; margin-right: 25px;">
            <div class="control-information">
              <div class="favorite">
                <h4>Favorite movies / TV shows:</h4>
                <div class="wrapper">
                  <i id="left" class="fa-solid fa-angle-left"></i>
                  <div class="carousel">
                  <?php
                  if(count($_SESSION['user_fav']) > 1){
                    global $_TMDB;
                    foreach($_SESSION['user_fav'] as $item){
                      $pair = explode('/', $item);
                      if($pair[0] == 'm'){
                        $title = $_TMDB->getMovie($pair[1])->getTitle();
                        $img = $_TMDB->getMovie($pair[1])->get('poster_path');
                      }elseif($pair[0] == 'tv'){
                        $title = $_TMDB->getTVShow($pair[1])->getName();
                        $img = $_TMDB->getTVShow($pair[1])->get('poster_path');
                      }else{
                        continue;
                      }
                      echo '<img src="';
                      if(!empty($img)){
                        echo _TMDB_IMG.$img;
                      }else{
                        echo _DEFAULT_PATH.'/assets/images/no-img-found.png';
                      }
                      echo '" title="'.$title.'" onclick="location.href=\''._DEFAULT_PATH.'/detail/'.$item.'\'">';
                    }
                  }else{
                    echo '<h6>You haven\'t set anything favorite!</h6>';
                    echo '<img>';
                  }
                  ?>
                  </div>
                  <i id="right" class="fa-solid fa-angle-right"></i>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>
    </article>
    <div class="wrapper-media" style="display: none;">
      <i id="left" class="fa-solid fa-angle-left"></i>
      <div class="carousel" style="display: none;"><img></div>
      <i id="right" class="fa-solid fa-angle-right"></i>
    </div>
  </main>
                        <div class="rating" id="rating-container" style="display: none;">
                          <!-- Stars will be dynamically added here with JavaScript -->
                        </div>

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
  <!-- custom js link-->
  <script src="<?php echo _DEFAULT_PATH ?>/assets/js/script.js"></script>
  <!-- library of pupup -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- custom js link-->
  <script src="<?php echo _DEFAULT_PATH ?>/assets/js/user-page.js"></script>
  <!--icon with ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!-- boostrap -->
  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function info_valid_msg(){
      Swal.fire({
      title: "<?php if(!empty($info_valid_msg)){ echo $info_valid_msg; } ?>",
      icon: "info"
    });}

    function email_valid_msg(){
			Swal.fire({
			title: "<?php if(!empty($valid_err['email'])){
				echo $valid_err['email'];
			}else{
				echo $email_valid_msg;
			} ?>",
			icon: "info"
		});}

    function repass_valid_msg(){
			Swal.fire({
			title: "<?php if(!empty($valid_err['old_password'])){
				echo $valid_err['old_password'];
			}elseif(!empty($valid_err['cfm_password'])){
        echo $valid_err['cfm_password'];
      }elseif(!empty($valid_err['password'])){
        echo $valid_err['password'];
      }else{
				echo $repass_valid_msg;
			} ?>",
			icon: "info"
		});}
  </script>

</body>

</html>