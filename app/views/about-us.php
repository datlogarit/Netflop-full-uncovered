<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us &mdash; NetFlop</title>
    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo _DEFAULT_PATH; ?>/assets/images/favicon.svg" type="image/svg+xml" />

    <!-- custom css link-->
    <link rel="stylesheet" href="<?php echo _DEFAULT_PATH; ?>/assets/css/about-us.css">
    <link rel="stylesheet" href="<?php echo _DEFAULT_PATH; ?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo _DEFAULT_PATH; ?>/assets/css/user-page.css">
    <!--google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <div class="about-dev">
            <h3 class="title-about-us">About Developers</h3>
            <div class="control-card">
                <div class="card">
                    <img class="cover-img" src="https://i.pinimg.com/736x/4b/29/d0/4b29d0a2141f45fcdf85f4c161a5bd7e.jpg"
                        alt="">
                    <img class="avt"
                        src="<?php echo _DEFAULT_PATH ?>/assets/images/_founder_doandat.jpg"
                        alt="">
                    <h4 class="card-name">Minh Dat Doan</h4>
                    <div class="job-position">Frontend-dev</div>
                    <div class="social-conect">
                        <a href="https://www.facebook.com/datlogarit/"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://github.com/datlogarit"><i class="fa-brands fa-github"></i></a>
                        <a href=""><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://www.buymeacoffee.com/datlogarit"><i class="fa-solid fa-hand-holding-dollar"></i></a>
                    </div>
                    <div class="skill">
                        <h6>Skills:</h6>
                        <div class="skill-item-all">
                            <span class="skill-item">UI/UX</span>
                            <span class="skill-item">HTML</span>
                            <span class="skill-item">CSS</span>
                            <span class="skill-item">SCSS</span>
                            <span class="skill-item">Bootstrap</span>
                            <span class="skill-item">Tailwind CSS</span>
                            <span class="skill-item">Angular</span>
                            <span class="skill-item">RxJs</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img class="cover-img"
                        src="https://scontent.fhan5-11.fna.fbcdn.net/v/t1.6435-9/106491905_737471137065032_4077126789011269608_n.jpg?stp=dst-jpg_p960x960&_nc_cat=100&ccb=1-7&_nc_sid=783fdb&_nc_eui2=AeFdEB0zUiEqVizIjhxR3czYGx5NJJPm3Y8bHk0kk-bdjzsKV0f2dPLWjH1dPjfeHVXk_lEOgjAhhhbD3iaa6DRe&_nc_ohc=2-APcweitnAAX8oxzHT&_nc_ht=scontent.fhan5-11.fna&oh=00_AfAjeyb9ajfdb60m0Zg9JGANVi6jlXzIkEI6smPajYgEhQ&oe=65AA9DDB"
                        alt="">
                    <img class="avt"
                        src="<?php echo _DEFAULT_PATH ?>/assets/images/_founder_thanhdat.png"
                        alt="">
                    <h4 class="card-name">Thanh Dat Tran</h4>
                    <div class="job-position">Fullstack-dev</div>
                    <div class="social-conect">
                        <a href="https://www.facebook.com/ambition2002"><i class="fa-brands fa-facebook"></i></a>
                        <a href=""><i class="fa-brands fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/aaronofrod?fbclid=IwAR0nSGsRcbFZnD49qJaptCLJ0enwJMx0LGQjE7RDOdYTepk91AMj64T1FMk"><i class="fa-brands fa-linkedin"></i></a>
                        <a href=""><i class="fa-solid fa-hand-holding-dollar"></i></a>
                    </div>
                    <div class="skill">
                        <h6>Skills:</h6>
                        <div class="skill-item-all">
                            <span class="skill-item">HTML</span>
                            <span class="skill-item">CSS</span>
                            <span class="skill-item">JavaScript</span>
                            <span class="skill-item">Bootstrap</span>
                            <span class="skill-item">Node.js</span>
                            <span class="skill-item">Next.js</span>
                            <span class="skill-item">Nest.js</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img class="cover-img"
                        src="https://scontent.fhan5-8.fna.fbcdn.net/v/t1.6435-9/107102460_700597944127909_8703576815857672183_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=300f58&_nc_eui2=AeG2Yp7zI5uiB1HBHfTzsslvSo6SARCgK6NKjpIBEKAro8KZDLmZIVDrTcntbLeMPHZkCaVkZk19NloTETpAkEtl&_nc_ohc=NTImJ5M58VIAX-7HAbe&_nc_ht=scontent.fhan5-8.fna&oh=00_AfBKKJA5q7HcfiWsdVVSdDFd0nh2n-Qpeda-cQGvWcgu7A&oe=65AA8D6D"
                        alt="">
                    <img class="avt"
                        src="<?php echo _DEFAULT_PATH ?>/assets/images/_founder_hunterdo.png"
                        alt="">
                    <h4 class="card-name">Viet Hung Do</h4>
                    <div class="job-position">Backend-dev</div>
                    <div class="social-conect">
                        <a href="https://fb.com/4zur3.xd"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://x.com/4zur3_xd"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://github.com/4zur3-xd"><i class="fa-brands fa-github"></i></a>
                        <a href="https://www.twitch.tv/4zur3_xd"><i class="fa-brands fa-twitch"></i></a>

                    </div>

                    <div class="skill">
                        <h6>Skills:</h6>
                        <div class="skill-item-all">
                            <span class="skill-item">HTML</span>
                            <span class="skill-item">CSS</span>
                            <span class="skill-item">JavaScript</span>
                            <span class="skill-item">Bootstrap</span>
                            <span class="skill-item">PHP</span>
                            <span class="skill-item">Laravel</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="about-web">
            <h3 class="title-about-web">About Website</h3>
            <div class="control-web">
                <div class="control-about-web">
                    <h4>Purpose</h4>
                    <p>This website was created to help people find the most satisfactory movies without wasting much time
                        by providing users with movie information, trailers, and accompanying images. Hope you have the best
                        experience when using our website. If there are any problems, you can contact us through the
                        information provided.</p>

                    <h4 style="margin-top: 150px;">Big thanks</h4>
                    <p>
                        Big thanks to "TMDB API v3 PHP Library - wrapper to API version 3 of themoviedb.org" by pixelead0 <br>(<a href="https://github.com/pixelead0/tmdb_v3-PHP-API-/" style="display: inline-block; color: rgb(227, 216, 3);">Git</a>)
                    </p>
                </div>
                <div class="control-about-web">
                    <h4>Term and Policies</h4>
                    <div class="control-term">
                        <h6>1. Review and Comment</h6>
                        <p>a. We encourage all forms of review and comment, but we reserve the right to remove or edit any content that we deem inappropriate or in violation of the rules.</p>
                        <p>b. We are not responsible for the content of user comments.</p>
                    </div>
                    <div class="control-term">
                        <h6>2. Privacy</h6>
                        <p>a. We are committed to protecting your privacy and using personal information solely for the purpose of providing services and improving user experience.</p>
                        <p>b. Your personal information will not be shared with any third party without your consent.</p>
                    </div>
                    <div class="control-term">
                        <h6>3. Legal responsibility</h6>
                        <p>a. We are not responsible for any damages arising from use of the website or reliance on the information provided on the website.</p>
                        <p>b. You are responsible for maintaining the safety and security of your account.</p>
                    </div>
                    <div class="control-term">
                        <h6>4. Change Terms</h6>
                        <p>a. We reserve the right to update and change any terms contained herein without prior notice. Use of the website following such changes will constitute your acceptance of those changes.</p>
                    </div>
                    <div class="control-term">
                        <h6>By continuing to use our website, you confirm that you have read, understood and agree to all terms and conditions contained in this document.</h6>
                    </div>
                </div>
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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>