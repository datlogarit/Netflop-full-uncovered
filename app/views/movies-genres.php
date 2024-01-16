<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $head_title; ?></title>
    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- icon -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo _DEFAULT_PATH; ?>/assets/images/favicon.svg" type="image/svg+xml" />

    <!-- custom css link-->
    <link rel="stylesheet" href="<?php echo _DEFAULT_PATH; ?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo _DEFAULT_PATH; ?>/assets/css/component-show.css" />
    <!--google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>

  <body id="top">
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
      <h1 class="title"><?php echo $title; if(!empty($title_with_genre_name)){echo ' &mdash; '.$title_with_genre_name;} ?></h1>
      <section>
        <div class="suggest-content">
          <div class="menu-option">
            <i class="fa-solid fa-bars"></i>
            <h6>Genres</h6>
          </div>
          <div class="option">
            <?php
            foreach($genres_list as $obj){
              echo '<a href="'._DEFAULT_PATH.'/movies/genre/'.$obj->getID().'"><h5>'.$obj->getName().'</h5></a>';
            }
            ?>
          </div>
        </div>
        <div class="wrapper-all-show">
        <?php
        if(!empty($movies)){
        foreach($movies as $movie){
          $year = $movie->get('release_date');
          $year = strtok($year, '-');
          echo '
          <div class="show-component">
            <div class="movie-card">
              <a href="'._DEFAULT_PATH.'/detail/m/'.$movie->getID().'">
                <figure class="card-banner">';
                if(!empty($movie->get('poster_path'))){
                  echo '<img src="'._TMDB_IMG.$movie->get('poster_path').'" />';
                }else{
                  echo '<img src="'._DEFAULT_PATH.'/assets/images/no-img-found.png">';
                }
                echo '</figure>
              </a>

              <div class="title-wrapper">
                <a href="'._DEFAULT_PATH.'/detail/m/'.$movie->getID().'">
                  <h3 class="card-title">'.$movie->getTitle().'</h3>
                </a>

                <time datetime="'.$year.'">'.$year.'</time>
              </div>

              <div class="card-meta">
                <div class="badge badge-outline">'.strtoupper($movie->get('original_language')).'</div>

                <div class="duration">
                  <ion-icon name="people"></ion-icon>

                  <time>'.$movie->get('vote_count').'</time>
                </div>

                <div class="rating">
                  <ion-icon name="star"></ion-icon>

                  <data>'.round($movie->get('vote_average'), 1).'</data>
                </div>
              </div>
            </div>
          </div>
          ';
        }
        }else{
          echo '<h5 style="color: white; padding-left: 25px; font-weight: normal; font-style: italic;">Try selecting a genre!</h5>';
        }
        ?>
        </div>
      </section>
      <div class="next-page">
        <div class="next-page-control">
          <?php
          if(!empty($movies)){
          if($page > 1 && $page <= 10){
            echo '<a href="'._DEFAULT_PATH.'/movies/'.$type.'/'.$genreID.'/'.($page - 1).'"><i class="fa-solid fa-backward-step"></i></a>';
          }

          for($i = 1; $i <= 10; $i++){
            if($i == $page){
              echo '<a href=""><div class="number-page current-page">'.$i.'</div></a>';
            }else{
              echo '<a href="'._DEFAULT_PATH.'/movies/'.$type.'/'.$genreID.'/'.$i.'"><div class="number-page">'.$i.'</div></a>';
            }
          }

          if($page < 10 && $page >= 1){
            echo '<a href="'._DEFAULT_PATH.'/movies/'.$type.'/'.$genreID.'/'.($page + 1).'"><i class="fa-solid fa-forward-step"></i></a>';
          }
          }
          ?>
        </div>
      </div>
    </main>
    <!-- 
    - #FOOTER
  -->

  <footer class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="footer-brand-wrapper">
          <a href="<?php echo _DEFAULT_PATH ?>"><h1 class="logo-index">NetFlop</h1></a>

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
    <script src="<?php echo _DEFAULT_PATH; ?>/assets/js/script.js"></script>

    <!--icon with ionicon link-->
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
    <!-- boostrap -->
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
