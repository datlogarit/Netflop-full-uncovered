<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $page_title; ?></title>
  <!-- link boostrap -->
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <!-- icon -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- favicon -->
  <link rel="shortcut icon" href="<?php echo _DEFAULT_PATH ?>/assets/images/favicon.svg" type="image/svg+xml" />
  <!-- custom css link-->
  <link rel="stylesheet" href="<?php echo _DEFAULT_PATH ?>/assets/css/style.css" />
  <!--google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<!-- 
    - #HEADER
  -->

<body id="top" 
<?php
if(!empty($fav_msg)){
  echo 'onload="fav_msg()"';
}

if(!empty($unfav_msg)){
  echo 'onload="unfav_msg()"';
}

if(!empty($review_submit_info)){
  echo 'onload="success_msg()"';
}
?>
>
  <header class="header" data-header>
    <div class="container">
      <div class="overlay" data-overlay></div>

      <a href="<?php echo _DEFAULT_PATH ?>"><h1 class="logo-index">NetFlop</h1></a>

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
      <!-- 
        - #MOVIE DETAIL
      -->

      <section class="movie-detail" style="background: linear-gradient(rgba(23, 29, 33, 0.9), rgba(23, 29, 33, 0.9)), 
      <?php if(!empty($detail->get('backdrop_path'))){echo "url('"._TMDB_IMG.$detail->get('backdrop_path')."')";} ?> 
      no-repeat; background-size: cover;">
        <div class="container">
          <figure class="movie-detail-banner">
            <img src="
            <?php
            if(!empty($detail->get('poster_path'))){
              echo _TMDB_IMG.$detail->get('poster_path');
            }else{
              echo _DEFAULT_PATH.'/assets/images/no-img-found.png';
            }
            ?>
            " alt="poster" />
          </figure>

          <div class="movie-detail-content">
            <?php
            if(!empty($detail->get('number_of_seasons'))){
              echo '<p class="detail-subtitle">'.$detail->get('number_of_seasons').' Season(s)</p>';
            }
            ?>

            <h1 class="h1 detail-title"><strong><?php echo $detail->getName(); ?></strong></h1>

            <div class="meta-wrapper">
              <div class="badge-wrapper">
                <div class="badge badge-outline"><?php echo strtoupper($detail->get('languages')[0]); ?></div>
              </div>

              <div class="ganre-wrapper">
                <?php
                $movie_genres = $detail->get('genres');

                $final = '';
                foreach($movie_genres as $genre){
                  $final .= $genre['name'].', ';
                }
                $final = rtrim($final, ', ');
                echo '<span>'.$final.'</span>';
                ?>
              </div>

              <div class="date-time">
                <div>
                  <ion-icon name="calendar-outline"></ion-icon>

                  <time><?php echo $detail->get('first_air_date'); ?></time>
                </div>
                <?php
                if(!empty($detail->get('episode_run_time'))){
                  echo '
                  <div>
                    <ion-icon name="time-outline"></ion-icon>
                    <time>'.$detail->get('episode_run_time')[0].' min / ep.</time>
                  </div>
                  ';
                }
                ?>
              </div>
            </div>

            <p class="storyline">
              <?php
              if(!empty($detail->get('overview'))){
                echo $detail->get('overview');
              }else{
                echo 'This movie hasn\'t had an English overview yet.';
              }
              ?>
            </p>

            <div class="details-actions">
              <div class="title-wrapper">
                <p class="title"><ion-icon name="star" style="display: inline-block"></ion-icon>&emsp;<?php echo round($detail->get('vote_average'), 1) ?></p>
                <p class="title"><ion-icon name="people" style="display: inline-block"></ion-icon>&emsp;<?php echo $detail->get('vote_count') ?></p>
              </div>
              <?php
              if(!empty($_SESSION['user_username'])){
                if(!$is_favorited){
                  echo '<form action="'._DEFAULT_PATH.'/detail/favorite" method="post" style="margin-top: 10px;">
                      <input type="hidden" name="type" value="'.$review_type.'">
                      <input type="hidden" name="post_id" value="'.$review_id.'">
                      <button class="btn btn-primary">
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Favorite</span>
                      </button>
                    </form>';
              }else{
                  echo '<form action="'._DEFAULT_PATH.'/detail/unfavorite" method="post" style="margin-top: 10px;">
                      <input type="hidden" name="fav_index" value="'.$fav_index.'">
                      <input type="hidden" name="type" value="'.$review_type.'">
                      <input type="hidden" name="post_id" value="'.$review_id.'">
                      <button class="btn btn-primary">
                        <i class="fa-solid fa-circle-minus fa-2x"></i>
                        <span>Unfavorite</span>
                      </button>
                    </form>';
              }
              }else{
                echo '
                <button class="btn btn-primary" onclick="needLoginFirst()" style="margin-top: 10px; margin-bottom: 20px;">
                  <i class="fa-solid fa-circle-plus"></i>
                  <span>Favorite</span>
                </button>
                ';
              }
              ?>
            </div>

            <div class="inf-creater-actor">
              <div class="actor">
                <h2 class="title-create-actor">Highlight Casts</h2>
                <div class="actors">
                <?php
                $casts = $detail->get('credits')['cast'];
                if(!empty($casts)){
                  if(count($casts) >= 12){
                    for($i = 0; $i < 12; $i++){
                      echo '
                      <div class="control-create-actor control-actor">
                        <img src="';
                        if(!empty($casts[$i]['profile_path'])){
                          echo _TMDB_IMG.$casts[$i]['profile_path'];
                        }else{
                          echo _DEFAULT_PATH.'/assets/images/no-img-found.png';
                        }
                        echo '" />
                        <div class="text-creater-actor">
                          <h6>'.$casts[$i]['name'].'</h6>
                          <p>';
                            if(strlen($casts[$i]['character']) < 90){
                              echo $casts[$i]['character'];
                            }else{
                              $shorten = str_split($casts[$i]['character'], 90)[0].'...';
                              echo $shorten;
                            }
                          echo '</p>
                        </div>
                      </div>
                      ';
                    }
                  }elseif(8 <= count($casts) && count($casts) < 12){
                    for($i = 0; $i < 8; $i++){
                      echo '
                      <div class="control-create-actor control-actor">
                        <img src="';
                        if(!empty($casts[$i]['profile_path'])){
                          echo _TMDB_IMG.$casts[$i]['profile_path'];
                        }else{
                          echo _DEFAULT_PATH.'/assets/images/no-img-found.png';
                        }
                        echo '" />
                        <div class="text-creater-actor">
                          <h6>'.$casts[$i]['name'].'</h6>
                          <p>'.$casts[$i]['character'].'</p>
                        </div>
                      </div>
                      ';
                    }
                  }elseif(4 <= count($casts) && count($casts) < 8){
                    for($i = 0; $i < 4; $i++){
                      echo '
                      <div class="control-create-actor control-actor">
                        <img src="';
                        if(!empty($casts[$i]['profile_path'])){
                          echo _TMDB_IMG.$casts[$i]['profile_path'];
                        }else{
                          echo _DEFAULT_PATH.'/assets/images/no-img-found.png';
                        }
                        echo '" />
                        <div class="text-creater-actor">
                          <h6>'.$casts[$i]['name'].'</h6>
                          <p>'.$casts[$i]['character'].'</p>
                        </div>
                      </div>
                      ';
                    }
                  }else{
                    for($i = 0; $i < count($casts); $i++){
                      echo '
                      <div class="control-create-actor control-actor">
                        <img src="';
                        if(!empty($casts[$i]['profile_path'])){
                          echo _TMDB_IMG.$casts[$i]['profile_path'];
                        }else{
                          echo _DEFAULT_PATH.'/assets/images/no-img-found.png';
                        }
                        echo '" />
                        <div class="text-creater-actor">
                          <h6>'.$casts[$i]['name'].'</h6>
                          <p>'.$casts[$i]['character'].'</p>
                        </div>
                      </div>
                      ';
                    }
                  }
                }
                ?>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

      <section>
        <div class="media-film">
          <p style="padding-top: 20px;">Medias</p>
<?php
if(empty($detail->get('trailers')['youtube']) && empty($detail->get('images')['posters']) && empty($detail->get('images')['backdrops'])){
  echo '<p style="margin-top: auto; margin-bottom: auto; padding-top: 15px; padding-bottom: 15px; text-align: center; font-size: 15px;">There is no medias available</p>';
  echo '<div class="carousel" style="display: none;"><img></div>';
}else{
  echo '
          <div class="wrapper-media">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carousel">';
              $videos = $detail->get('videos')['results'];
              $temp = array();
              foreach($videos as $video){
                if($video['site'] == 'YouTube'){
                  array_push($temp, $video);
                }
              }
              if(!empty($videos)){
                if(count($videos) == 1){
                  echo '<iframe width="560" height="360" src="https://www.youtube.com/embed/'.$videos[0]['key'].'?si=ELU48noR33BJMqwV" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                }else{
                  for($i = 0; $i < 2; $i++){
                    echo '<iframe width="560" height="360" src="https://www.youtube.com/embed/'.$videos[$i]['key'].'?si=ELU48noR33BJMqwV" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="margin-left: 15px;"></iframe>';
                  }
                }
              }

              $posters = $detail->get('images')['posters'];
              if(!empty($posters)){
                if(count($posters) == 1){
                  echo '<img src="'._TMDB_IMG.$posters[0]['file_path'].'" alt="img" draggable="false" />';
                }elseif(count($posters) < 5){
                  for($i = 0; $i < count($posters); $i++){
                    echo '<img src="'._TMDB_IMG.$posters[$i]['file_path'].'" alt="img" draggable="false" />';
                  }
                }else{
                  for($i = 0; $i < 5; $i++){
                    echo '<img src="'._TMDB_IMG.$posters[$i]['file_path'].'" alt="img" draggable="false" />';
                  }
                }
              }

              $backdrops = $detail->get('images')['backdrops'];
              if(!empty($backdrops)){
                if(count($backdrops) == 1){
                  echo '<img src="'._TMDB_IMG.$backdrops[0]['file_path'].'" alt="img" draggable="false" />';
                }elseif(count($backdrops) < 5){
                  for($i = 0; $i < count($backdrops); $i++){
                    echo '<img src="'._TMDB_IMG.$backdrops[$i]['file_path'].'" alt="img" draggable="false" />';
                  }
                }else{
                  for($i = 0; $i < 5; $i++){
                    echo '<img src="'._TMDB_IMG.$backdrops[$i]['file_path'].'" alt="img" draggable="false" />';
                  }
                }
              }
  echo '
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
          </div>';
}
?>
        </div>
      </section>

      <div class="review-of-user">
        <div class="review-of-user-control">
          <div class="review-of-user-title-more">
            <h1>User reviews</h1>
          </div>

          <?php
          if(empty($_SESSION['user_username'])){
            echo '
          <div class="add-cmt">
            <p class="d-inline-flex gap-1" onclick="userNeedLogin()">
              <button class="btn btn-primary">
                + Add review
              </button>
            </p>
          </div>
          <div class="rating" id="rating-container" style="display: none;">
            <!-- Stars will be dynamically added here with JavaScript -->
          </div>
            ';
          }else{
            $isReviewed = false;

            foreach($reviews as $index => $item){
                if($item['username'] == $_SESSION['user_username']){
                    $isReviewed = true;
                    $thisUserReview = $reviews[$index];
                    unset($reviews[$index]);
                    $reviews = array_values($reviews);
                    break;
                }
            }

            if(!$isReviewed){
              echo '
            <div class="add-cmt">
              <p class="d-inline-flex gap-1">
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  + Add review
                </a>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                  <div class="form-popup">
                    <form method="post" action="'._DEFAULT_PATH.'/detail/review_submit" class="form-container">
                      <div class="rating-all">
                        <h5>Your rating</h5>
                        <div class="rating" id="rating-container">
                          <!-- Stars will be dynamically added here with JavaScript -->
                        </div>
                      </div>
                      <div class="your-review">
                        <input type="hidden" name="type" value="'.$review_type.'">
                        <input type="hidden" name="post_id" value="'.$review_id.'">
                        <input type="hidden" name="username" value="'.$_SESSION['user_username'].'">
                        <input type="hidden" name="rating" value="0" id="rating-input">
                        <textarea name="body" id="textarea-cmt" cols="" rows="3" placeholder="Your review..." required></textarea>
                        <button type="submit" class="btn-form-review">
                          Submit
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
              ';
            }else{
              echo '
            <div class="add-cmt">
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                  <div class="form-popup">
                    <form method="post" action="'._DEFAULT_PATH.'/detail/review_submit" class="form-container">
                      <div class="rating-all">
                        <h5>Your rating</h5>

                      </div>
                      <div class="your-review">
                        <input type="hidden" name="type" value="'.$review_type.'">
                        <input type="hidden" name="post_id" value="'.$review_id.'">
                        <input type="hidden" name="username" value="'.$_SESSION['user_username'].'">
                        <textarea name="body" id="textarea-cmt" cols="" rows="3" placeholder="Text your comment "></textarea>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
              ';
            }
          }
          ?>

        </div>

        <div class="cmt-of-users-box">
          <?php
        if(!empty($_SESSION['user_username'])){
          if($isReviewed){
            echo '
          <div class="cmt-of-user-box">
            <div class="cmt-of-user-box-cmt">
              <div class="inf-user">
                <i class="fa-solid fa-user"></i>
                <h4 style="padding-left: 5px;">'.$thisUserReview['username'].' (Your review)</h4>
              </div>
              <p style="padding-left: 24px; padding-top: 10px; padding-bottom: 0px;">'.$thisUserReview['body'].'</p>
              <p style="font-style: italic;"><small>'.$thisUserReview['submit_time'].'</small></p>
            </div>
            <div class="control-inf-rate">
              <div class="control-inf-rate-star" style="font-size: 20px">
                <ion-icon name="star" class="control-inf-rate-star-star"></ion-icon>
                <div> '.$thisUserReview['rating'].' / 10</div>
              </div>
              <div class="btn-group dropend">
                <button type="button" onclick="editForm()" style="padding-right: 20px;">
                  <i class="fa-lg fa-solid fa-pencil" style="color: rgb(227, 216, 3);"></i>
                </button>
                <button type="button" onclick="confirm_delete_cmt()">
                  <i class="fa-lg fa-solid fa-trash" style="color: rgb(227, 216, 3);"></i>
                </button>
              </div>
              <div class="form-popup-report" id="editForm">
                <form action="'._DEFAULT_PATH.'/detail/review_edit" class="form-container-report" method="post">
                  <div class="narbar-report">
                    <i class="fa-solid fa-x" onclick="closeEditForm()"></i>
                  </div>
                  <div class="body-report">
                    <div class="inf-film-report">
                      <img src="';
                      if(!empty($detail->get('poster_path'))){
                        echo _TMDB_IMG.$detail->get('poster_path');
                      }else{
                        echo _DEFAULT_PATH.'/assets/images/no-img-found.png';
                      }
                      echo '" alt="" />
                      <div class="inf-film-report-text">
                        <p>'.$detail->getName().' ('.strtok($detail->get('first_air_date'), '-').')</p>

                        <h5>Edit your review</h5>
                      </div>
                    </div>
                    <div class="title-reason-report">
                      <p>CONTENT</p>
                    </div>
                    <div class="reason-report-and-submit">
                      <input type="hidden" name="rating" id="rating-input" value="">
                      <input type="hidden" name="type" value="'.$review_type.'">
                      <input type="hidden" name="post_id" value="'.$review_id.'">
                      <input type="hidden" name="review_id" value="'.$thisUserReview['review_id'].'">
                      <div class="rating" id="rating-container">
                          <!-- Stars will be dynamically added here with JavaScript -->
                      </div>
                      <textarea class="textarea-report" name="body" cols="" rows="5" style="resize: none;" placeholder="Your edit here..." required></textarea>

                      <button type="submit" class="btn-form">EDIT</button>
                    </div>
                  </div>
                  <div class="footer-report"></div>
                </form>
              </div>
            </div>
          </div>
            ';
          }
        }

          if(!empty($reviews)){
            foreach($reviews as $cmt){
              echo '
          <div class="cmt-of-user-box">
            <div class="cmt-of-user-box-cmt">
              <div class="inf-user">
                <i class="fa-solid fa-user"></i>
                <h4 style="padding-left: 5px;">'.$cmt['username'].'</h4>
              </div>
              <p style="padding-left: 24px; padding-top: 10px; padding-bottom: 0px;">'.$cmt['body'].'</p>
              <p style="font-style: italic;"><small>'.$cmt['submit_time'].'</small></p>
            </div>
            <div class="control-inf-rate">
              <div class="control-inf-rate-star" style="font-size: 20px">
                <ion-icon name="star" class="control-inf-rate-star-star"></ion-icon>
                <div> '.$cmt['rating'].' / 10</div>
              </div>
              <div class="btn-group dropend">';
            if(!empty($_SESSION['user_role'])){
              if($_SESSION['user_role'] == 'normal'){
                echo '<button type="button"><i class="fa-solid fa-flag fa-lg" style="color: rgb(227, 216, 3);" onclick="report_review_'.$cmt['review_id'].'()"></i></button>';
                echo '
                <script>
                function report_review_'.$cmt['review_id'].'() {
                  document.getElementById("report_'.$cmt['review_id'].'").style.display = "block";
                }
                
                function close_report_review_'.$cmt['review_id'].'() {
                  document.getElementById("report_'.$cmt['review_id'].'").style.display = "none";
                }
                </script>
                ';
                echo '
              <div class="form-popup-report" id="report_'.$cmt['review_id'].'">
                <form method="post" action="'._DEFAULT_PATH.'/detail/report" class="form-container-report">
                  <div class="narbar-report">
                    <i class="fa-solid fa-x" onclick="close_report_review_'.$cmt['review_id'].'()"></i>
                  </div>
                  <div class="body-report">
                    <div class="inf-film-report">
                      <img src="';
                      if(!empty($detail->get('poster_path'))){
                        echo _TMDB_IMG.$detail->get('poster_path');
                      }else{
                        echo _DEFAULT_PATH.'/assets/images/no-img-found.png';
                      }
                      echo '" alt="" />
                      <div class="inf-film-report-text">
                        <p>'.$detail->getName().' ('.strtok($detail->get('first_air_date'), '-').')</p>

                        <h5>Report '.$cmt['username'].'\'s review</h5>
                      </div>
                    </div>
                    <div class="title-reason-report">
                      <p>REASON FOR REPORTING ITEM</p>
                    </div>
                    <div class="reason-report-and-submit">
                      <h5>Please explain your reason</h5>
                      <input type="hidden" name="type" value="'.$review_type.'">
                      <input type="hidden" name="post_id" value="'.$review_id.'">
                      <input type="hidden" name="username" value="'.$cmt['username'].'">
                      <input type="hidden" name="review_id" value="'.$cmt['review_id'].'">
                      <input type="hidden" name="review_body" value="'.$cmt['body'].'">
                      <textarea class="textarea-report" name="reason" cols="" rows="5" style="resize: none;" placeholder="Your reason here..." required></textarea>

                      <button type="submit" class="btn-form">REPORT</button>
                    </div>
                  </div>
                  <div class="footer-report"></div>
                </form>
              </div>
                ';
              }else{
                echo '<button type="button"><i class="fa-solid fa-trash fa-lg" style="color: rgb(227, 216, 3);" onclick="delete_review_'.$cmt['review_id'].'()"></i></button>';
                echo '
                <script>
                function delete_review_'.$cmt['review_id'].'(){
                  var form = document.getElementById("delete_'.$cmt['review_id'].'");
                  Swal.fire({
                    title: "Delete '.$cmt['username'].'\'s review?",
                    text: "You won\'t be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085D6",
                    cancelButtonColor: "#D33",
                    confirmButtonText: "Yes, delete it!"
                  }).then((result) => {
                    if (result.isConfirmed) {
                      form.submit();
                    }
                  });
                }
                </script>
                ';
                echo '
                <form id="delete_'.$cmt['review_id'].'" action="'._DEFAULT_PATH.'/detail/review_delete" method="post">
                  <input type="hidden" name="type" value="'.$review_type.'">
                  <input type="hidden" name="post_id" value="'.$review_id.'">
                  <input type="hidden" name="review_id" value="'.$cmt['review_id'].'">
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
            echo '<p style="margin-top: auto; margin-bottom: auto; padding-top: 15px; padding-bottom: 15px; text-align: center;">Other users haven\'t posted any reviews for this movie</p>';
          }
          ?>

    </article>
  </main>

  <!-- 
    - #FOOTER
  -->

  <footer class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="footer-brand-wrapper">
          <a href="<?php echo _DEFAULT_PATH ?>">
            <h1 class="logo-index">Netflop</h1>
          </a>

          <ul class="footer-list">

            <li>
              <a href="<?php echo _DEFAULT_PATH ?>/movies" class="footer-link">Movies</a>
            </li>

            <li>
              <a href="<?php echo _DEFAULT_PATH ?>/tvshows" class="footer-link">TV Shows</a>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  </footer>

  <!-- GO TO TOP -->
  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up"></ion-icon>
  </a>

<form id="delete-form" action="<?php echo _DEFAULT_PATH; ?>/detail/review_delete" method="post">
  <input type="hidden" name="type" value="<?php echo $review_type; ?>">
  <input type="hidden" name="post_id" value="<?php echo $review_id; ?>">
  <input type="hidden" name="review_id" value="<?php echo $thisUserReview['review_id']; ?>">
</form>

  <!-- library of pupup -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- custom js link-->
  <script src="<?php echo _DEFAULT_PATH ?>/assets/js/script.js"></script>

  <!--icon with ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <!-- link boostrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <!-- star lib -->
  <script src="https://cdn.jsdelivr.net/npm/@webcomponents/webcomponentsjs@2.4.1/webcomponents-bundle.min.js"></script>
  <script>
      function needLoginFirst(){
        Swal.fire({
        title: "You need to login first!",
        icon: "error"
      });}

      function fav_msg(){
        Swal.fire({
        title: "<?php if(!empty($fav_msg)){ echo $fav_msg; } ?>",
        icon: "success"
      });}

      function unfav_msg(){
        Swal.fire({
        title: "<?php if(!empty($unfav_msg)){ echo $unfav_msg; } ?>",
        icon: "success"
      });}

      function success_msg(){
        Swal.fire({
        title: "<?php if(!empty($review_submit_info)){ echo $review_submit_info; } ?>",
        icon: "info"
      });}
    </script>
</body>

</html>