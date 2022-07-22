<?php

  include 'assets\php\login.php';
  include 'assets\php\lastPlayed.php';
  include 'assets\php\lastPlayedArtist.php';
  include 'assets\php\lastPlayedAlbum.php';
  include 'assets\php\lastPlayedAudio.php';
  include 'assets\php\searchList.php';
  include 'assets\php\artistInfo.php';
  include 'assets\php\favorites.php';
  include 'assets\php\userInfo.php';
  include 'assets\php\themes.php';


  
  if(isset($_SESSION['id'])){
    $id_login = $_SESSION['id'];
  }
  else{
    $id_login = 0;
  }


?>


<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="description" content="Home Page">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <meta name="author" content="Rishitha  N">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>MusiCure</title>

         <!-- CSS -->
         <link rel="stylesheet" href="assets/css/home.css">
         <link rel="stylesheet" href="assets/css/modal.css">
         <link rel="stylesheet" href="assets/css/login.css">
         <link rel="stylesheet" href="assets/css/rightNav.css">
         <link rel="stylesheet" href="assets/css/leftNav.css">
         <link rel="stylesheet" href="assets/css/song.css">
         <link rel="stylesheet" href="assets/css/search.css">
         <link rel="stylesheet" href="assets/css/artist.css">
         <link rel="stylesheet" href="assets/css/album.css">
         <link rel="stylesheet" href="assets/css/favorite.css">
         <link rel="stylesheet" href="assets/css/profile.css">
         <link rel="stylesheet" href="assets/css/composer.css">
         <link rel="stylesheet" href="assets/css/theme.css">

         <!-- Icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
               
        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- JavaScript -->
        <script src="assets/js/user.js"></script>
        <script src="assets/js/songPlayer.js"></script>
        <script src="assets/js/navigation.js"></script>
        <script src="assets/js/favorite.js"></script>
        <script src="assets/js/search.js"></script>
        <script src="assets/js/searchNav.js"></script>
        <script src="assets\js\themes.js"></script>



    </head>

    <body>

        <!-- Nav Bar Open -->

        <section class="navigation">
            <div id="heading">
                <p class="heading">MusiCure</p>
            </div>
            <div class="nav" id="homeNav">
                <p><i class="material-icons">home</i> Home</p>
            </div>
            <br>
            <?php
            
            if($id_login != 0){
            ?>

            <div class="nav" id="profileNav">
                <p><i class="material-icons">person_outline</i> Profile</p>
            </div>
            <br>
            <div class="nav" id="favoriteNav">
                <p><i class="material-icons">favorite_border</i> Favorites</p>
            </div>
            <br>
            <div class="nav" id="searchNav">
                <p><i class="material-icons">search</i> Search</p>
            </div>

            <?php
            }
            ?>

               
        </section>

        <!-- Nav Bar close -->


        <!-- Right Nav Bar Open -->
        <?php 
            if($id_login == 0){
        ?>    

            <section class = "rightNavBar">

                <a id="login" href="#" onclick="document.getElementById('loginModal').style.display='block'" style="width:auto;">LOGIN</a>
    
                <a id="signup" href="#" onclick="document.getElementById('signupModal').style.display='block'" style="width:auto;">SIGN UP</a>
                
            </section>

        <?php
            }
            else{
        ?>

            <section class = "rightNavBar">

                <a id="logout" href="#">LOGOUT</a>

            </section>

        <?php
            }
        ?>

        <!-- Right Nav Bar Close -->

        <br> <br>

        <!-- Secondary Player Open -->

        <?php

        if($id_login != 0 && $checkSong == 1){
        ?>

        <div id="playing">

            <div class="playingInfo">
                <img id="ImgPlaying" class="playingImg" src="<?php echo $songImg ?>">
                <p id="NamePlaying" class="playingName"> <?php echo $songName ?> </p>
                <?php
                    if(sizeof($artists) > 1){
                    ?>
                        <p id="ArtistPlaying" class="playingArtist"> <?php echo $artists[0] ?> ... </p>
                    <?php
                    }
                    else{
                    ?>
                        <p id="ArtistPlaying" class="playingArtist"> <?php echo $artists[0] ?> </p>  
                    <?php
                    }
                    ?>              

            </div>
                
            <div class="controls">
                <button class="control" hidden id="previousBtn"> <i id="previous" class="material-icons previousIcon">skip_previous</i></button>
                <button class="control" id="play" onclick="playPause('songSrc')"> <i class="material-icons playIcon" id="playPauseIcon">play_circle_filled</i></button>
                <button class="control" hidden id="nextBtn"> <i id="next" class="material-icons nextIcon">skip_next</i></button>
                
                
                <?php if( in_array($songFavId , $favoriteSongIdCheckList) ) { ?>
                
                <button class="control" hidden id="likeBtn"> <i id="like" class="material-icons likeIcon" >favorite_border</i></button>
                <button class="control" id="likedBtn"> <i id="liked" class="material-icons likeIcon" >favorite</i></button>
               
               <?php
                }
                else{
               ?>

                <button class="control" id="likeBtn"> <i id="like" class="material-icons likeIcon" >favorite_border</i></button>
                <button class="control" hidden id="likedBtn"> <i id="liked" class="material-icons likeIcon" >favorite</i></button>
               
                <?php
                }
                ?>
               
                <p id="likeSongId" class="playingArtist"><?php echo $songFavId ?></p>
    
    
                <button class="control volume_down" onclick="changeVolume(10, 'down')"> <i class="material-icons volumeIcon">volume_down</i></button>
                <div id="volumeMeter" onclick="setNewVolume(this,event)"><div id="volumeStatus"></div></div>
                <button class="control volume_up" onclick="changeVolume(10, 'up')"> <i class="material-icons volumeIcon">volume_up</i></button>
    
            </div>
    
        </div>
        
        <audio src="<?php echo $audioSrc ?>" id="songSrc" ontimeupdate="updateTime()"></audio>
        
        <div class="song-slider">
            <div id="songSlider" onclick="setSongPosition(this,event)"><div id="trackProgress"></div></div>
            <span class="current-time" id="songTime">0:00</span>
            <span class="song-duration" id="songDuration">0:00</span>
        </div>

        <?php
        }
        else if($id_login != 0 && $checkSong == -1){
        ?>

            <div id="playing">

            <div class="playingInfo">
                <img id="ImgPlaying" class="playingImg" src="">
                <p id="NamePlaying" class="playingName"> <?php echo $songName ?> </p>
                <?php
                    if(sizeof($artists) > 1){
                    ?>
                        <p id="ArtistPlaying" class="playingArtist"> <?php echo $artists[0] ?> ... </p>
                    <?php
                    }
                    else{
                    ?>
                        <p id="ArtistPlaying" class="playingArtist"> <?php echo $artists[0] ?> </p>  
                    <?php
                    }
                    ?>              

            </div>
                
            <div class="controls">
                <button class="control" hidden id="previousBtn"> <i id="previous" class="material-icons previousIcon">skip_previous</i></button>
                <button class="control" id="play" onclick="playPause('songSrc')"> <i class="material-icons playIcon" id="playPauseIcon">play_circle_filled</i></button>
                <button class="control" hidden id="nextBtn"> <i id="next" class="material-icons nextIcon">skip_next</i></button>
                
                
                <?php if( in_array($songFavId , $favoriteSongIdCheckList) ) { ?>
                
                <button class="control" hidden id="likeBtn"> <i id="like" class="material-icons likeIcon" >favorite_border</i></button>
                <button class="control" id="likedBtn"> <i id="liked" class="material-icons likeIcon" >favorite</i></button>
               
               <?php
                }
                else{
               ?>

                <button class="control" id="likeBtn"> <i id="like" class="material-icons likeIcon" >favorite_border</i></button>
                <button class="control" hidden id="likedBtn"> <i id="liked" class="material-icons likeIcon" >favorite</i></button>
               
                <?php
                }
                ?>
               
                <p id="likeSongId" class="playingArtist"><?php echo $songFavId ?></p>
    
    
                <button class="control volume_down" onclick="changeVolume(10, 'down')"> <i class="material-icons volumeIcon">volume_down</i></button>
                <div id="volumeMeter" onclick="setNewVolume(this,event)"><div id="volumeStatus"></div></div>
                <button class="control volume_up" onclick="changeVolume(10, 'up')"> <i class="material-icons volumeIcon">volume_up</i></button>
    
            </div>
    
        </div>
        
        <audio src="<?php echo $audioSrc ?>" id="songSrc" ontimeupdate="updateTime()"></audio>
        
        <div class="song-slider">
            <div id="songSlider" onclick="setSongPosition(this,event)"><div id="trackProgress"></div></div>
            <span class="current-time" id="songTime">0:00</span>
            <span class="song-duration" id="songDuration">0:00</span>
        </div>

        <?php
        }
        ?>
        

        <!-- Secondary Player Close -->

        <!-- Home content Open -->

        <div id="homeContent">

            <div id="greeting">
                <p>Hello there,</p>
            </div>

            <br><br><br>

            <?php
            if($id_login != 0){
            ?>

            <div class="themes">

                <div class="theme">

                    <?php 
                        if($themeNum == 1){

                    ?>

                            <p class="themeName">Preferred Language</p>

                    <?php        
                            for($i = 0 ; $i < count($themeInfo) ; $i++){
                    ?>
                    <div class="themeSongDisplay" data-for="<?php echo $themeInfo[$i][0] ?>">
                        <img class="themeImg" src="<?php echo $themeInfo[$i][1] ?>">
                    </div>
                    <?php
                            }
                        }

                    ?>
         
                </div>

                <div class="theme">
                    <p class="themeName">Hits</p>

                    <?php        
                            for($i = 0 ; $i < count($themeInfoHits) ; $i++){
                    ?>
                    <div class="themeSongDisplay" data-for="<?php echo $themeInfoHits[$i][0] ?>">
                        <img class="themeImg" src="<?php echo $themeInfoHits[$i][1] ?>" >
                    </div>
                    <?php
                            }

                    ?>
                </div>
                
                <div class="theme">
                    <p class="themeName">Others</p>

                    <?php        
                            for($i = 0 ; $i < count($themeInfoOthers) ; $i++){
                    ?>
                    <div class="themeSongDisplay" data-for="<?php echo $themeInfoOthers[$i][0] ?>">
                        <img class="themeImg" src="<?php echo $themeInfoOthers[$i][1] ?>" >
                    </div>
                    <?php
                            }

                    ?>
                    
                </div>
            </div>
            <?php
            }
            else{
            ?>
            <p style="color:white;">Sign Up or Login To enjoy Listening to Thousands of songs from all over the world</p>
            <?php
            }
            ?>
            <br><br><br><br><br><br><br><br>
        </div>

        <!-- Home content Close -->

        <!-- Favorites content Open -->

        <div id="favoritesContent" style="display: none;">
            <img class="favoritesIcon" src="assets/images/liked songs.png">
            <p class="favoritesTitle">Liked Songs</p>
            <p class="favoritesTotal" id="favTotal">8 songs</p>
            <button class="playFavorites" id="favSongPlay"> <i class="material-icons">play_circle_filled</i></button>

            <div class="favoriteSongs">

                <table class="favoriteTable" id="favSongTable">
                    <tr class="favoriteColumns">
                      <th>#</th>
                      <th>TITLE</th>
                      <th class="titleFavorite"></th>
                      <th>ARTIST</th>
                      <th>ALBUM</th>
                      <th class="likeFavorite"></th>
                      <th>TIME</th>
                    </tr>
                    

                </table>
                <br>

            </div>
            
              
        </div>


        <!-- Favorites content Close -->

        <!-- Search content Open -->

        <div id="searchContent" style="display: none;">
            <div class="searchContainer" id="searchBar">

                <div class="search-box">

                    <form class="search-form">
                        <input onkeyup="searchFilter()" type="text" placeholder="Search for Songs, Artists, Albums ..." id="search" autocomplete="off">
                    </form>

                    <div class="cancel-icon" id="cancelSearch" ><i class="material-icons">close</i></div>
                   
                </div>



                <ul id = "nameDiv" hidden>

                <?php

                for($i=0;$i<$length;$i++){

                    if($searchOptions[$i] == 1){

                ?>

                <li data-for="<?php echo $searchOptions[$i]?> <?php echo $searchIds[$i] ?>" class="nameList" id="song_result<?php echo $searchIds[$i] ?>"> <a>  <?php echo $searchValues[$i] ?> - Song  </a> </li>

                <?php
                }
                else if($searchOptions[$i] == 2){
                ?>

                <li data-for="<?php echo $searchOptions[$i]?> <?php echo $searchIds[$i] ?>" class="nameList" id="artist_result<?php echo $searchIds[$i] ?>"> <a>  <?php echo $searchValues[$i] ?> - Artist </a> </li>

                <?php
                }
                else if($searchOptions[$i] == 3){

                ?>

                <li data-for="<?php echo $searchOptions[$i]?> <?php echo $searchIds[$i] ?>" class="nameList" id="album_result<?php echo $searchIds[$id] ?>"> <a>  <?php echo $searchValues[$i] ?> - Album </a> </li>

                <?php
                }

                else if($searchOptions[$i] == 4){
            
                ?>

                <li data-for="<?php echo $searchOptions[$i]?> <?php echo $searchIds[$i] ?>" class="nameList" id="composer_result<?php echo $searchIds[$id] ?>"> <a>  <?php echo $searchValues[$i] ?> - Composer </a> </li>

                <?php
                }
                }
                ?>

                </ul>

            </div>

        </div>

        <!-- Search content Close -->

    

        <!-- Song Info Open -->

        <div class="container" id="songInfo" style = "display:none;">
            <div class="img">
                <img class="songImg" id="songInfoImg" src="">
            </div>
    
            <div class="info">
    
                <h1 class="songTitle" id="songInfoName"></h1>
                <i class="material-icons" id="songInfoPlay">play_circle_filled</i>
                <h2 class="songArtist" id="songInfoArtist"></h2>
                <h2 class="songAlbum" id="songInfoAlbum"></h2>

            </div>
        </div>

        <!-- Song Info Close -->


        <!-- Artist Info Open -->

        <div id="artistInfo" style = "display:none;">
            <div class="img">
                <img class="songImg" id="songInfoImg" src="assets/images/artist image.jpg">
            </div>
    
            <div class="info">
                <h1 class="artistTitle" id="artistInfoName"></h1>
                <p class="artistDesc" id="artistDescription"></p>
                <i class="material-icons" id="artistInfoPlay">play_circle_filled</i>

            </div>


            <div class="artistSongs">

                <table class="artistTable" id="artistSongTable">
                   
                <tr class="artistColumns">
                      <th>#</th>
                      <th>TITLE</th>
                      <th class="titleArtist"></th>
                      <th>ALBUM</th>
                      <th>TIME</th>
                </tr>

                <br>

                </table>

            </div>
              
        </div>

        <!-- Artist Info Close -->

        <!-- Album Info Open -->

        <div class="albumContent" id="albumInfo" style="display:none;">

            <div class="img">
                <img class="albumImg" id="albumInfoImg" src="">
            </div>
    
            <div class="info">
                <h1 class="albumTitle" id="albumInfoName"></h1>
                <i class="material-icons" id="albumInfoPlay">play_circle_filled</i>

            </div>

            <div class="albumSongs">

                <table class="albumTable" id="albumSongTable">
                
                    <tr class="albumColumns">
                    <th>#</th>
                    <th>TITLE</th>
                    <th>ARTIST</th>
                    <th>TIME</th>
                    </tr>

                <br>

                </table>

            </div>
            
        </div>

        <!-- Album Info Close -->


        <!-- Composer Info Open -->

        <div id="composerInfo" style = "display:none;">
            <div class="img">
                <img class="composerImg" id="composerInfoImg" src="assets/images/artist image.jpg">
            </div>
    
            <div class="info">
                <h1 class="composerTitle" id="composerInfoName"></h1>
                <p class="composerDesc" id="composerDescription"></p>
                <i class="material-icons" id="composerInfoPlay">play_circle_filled</i>

            </div>


            <div class="composerSongs">

                <table class="composerTable" id="composerSongTable">
                   
                <tr class="composerColumns">
                      <th>#</th>
                      <th>TITLE</th>
                      <th class="titleComposer"></th>
                      <th>ARTIST</th>
                      <th>ALBUM</th>
                      <th>TIME</th>
                </tr>

                <br>

                </table>

            </div>
              
        </div>
        <!-- Composer Info Close -->

        

        <!-- Profile Content Open  -->

        <div id="profileContent" style="display:none;">

            <p class="profileTitle">Welcome, <p class="profileTitleName"><?php echo $userName ?></p></p>

            <p class="userField">Username : </p>
            <p class="userFieldFill"><?php echo $userName ?></p>

            <p class="userField">Email : </p>
            <p class="userFieldFill"><?php echo $userEmail ?></p>

            <p class="userField">Mobile number : </p>
            <p class="userFieldFill"><?php echo $userMobile ?></p>

            <p class="userField">Password : </p>
            <p class="userFieldFill">*****</p>

            <p class="userField">Country : </p>
            <p class="userFieldFill"><?php echo $userCountry ?></p>

            <p class="userField">State : </p>
            <p class="userFieldFill"><?php echo $userState ?></p>

            <p class="userField">City : </p>
            <p class="userFieldFill"><?php echo $userCity ?></p>
            
            <p class="userField">Language Preference : </p>
            <p class="userFieldFill"><?php echo $userLanguage ?></p>

            <br><br><br><br><br><br><br><br><br>

        </div>

        <!-- Profile Content Close -->

         <!-- Theme content Open -->

         <div id="themeContents" style="display: none;">
            <img class="themeIcon" id="themeInfoImg" src="">
            <p class="themeTitle" id="themeInfoName">Theme name</p>
            <button class="playTheme" id="themeSongPlay"> <i class="material-icons">play_circle_filled</i></button>

            <div class="themeSongs">

                <table class="themeTable" id="themeSongTable">
                    <tr class="themeColumns">
                      <th>#</th>
                      <th>TITLE</th>
                      <th class="titleTheme"></th>
                      <th>ARTIST</th>
                      <th>ALBUM</th>
                      <th>TIME</th>
                    </tr>
                    

                </table>
                <br>

            </div>
            
              
        </div>


        <!-- Theme content Close -->
        
        <!-- Login Modal  -->

        <div id="loginModal" class="modal2">

            <span onclick="document.getElementById('loginModal').style.display='none'" class="close2" title="Close Modal">&times;</span>
    
            <form class="modal-content2 animate2" id="loginForm">

                <div class="modalContainer2 container1">

                    <label><b>Email</b></label>  <br>
                    <input type="text" placeholder="Enter Email" name="useremail" id="loginemail" required>  
                    
                    <br> 

                    <label><b>Password</b></label>   <br>
                    <input type="password" placeholder="Enter Password" name="password" id="loginpsw" required>
                    
                    <br>

                    <button class="btn1" type="submit">Login</button>

                    <button class="btn1" type="button">Forgot Password</button>
                        

                </div>


                <div class="modalContainer2 container2" style="background-color:#f1f1f1">

                    <button type="button" onclick="document.getElementById('loginModal').style.display='none'" class="cancelbtn2 btn1">Cancel</button>
                
                </div>

            </form>

        </div>

        <!-- Login Modal JS -->
        <script>

            var modal = document.getElementById('loginModal');

            window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            }
        </script>


        <!-- SignUp Modal -->
        <div id="signupModal" class="modal1">

            <span onclick="document.getElementById('signupModal').style.display='none'" class="close1" title="Close Modal">&times;</span>
            
            <form class="modal-content1" id="signupForm">
        
                <div class="modalContainer">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <div class="modalcontainer1">

                    <label style="display: inline;" ><b>Username</b>
                    
                        <i class="fas fa-check-circle" style="display: inline;"></i>
                        <i class="fas fa-exclamation-circle" style="display: inline;"></i>
                        <small style="display: inline;">Error message</small>

                    </label> <br>

                    <input type="text" id="uname" placeholder="Enter Username" name="uname" required>


                </div>

                <br>

                <div class="modalcontainer1">

                    
                    <label ><b>Email</b>
                    
                    <i class="fas fa-check-circle" ></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>

                    
                    </label> <br>

                    <input type="text" id="email" placeholder="Enter Email" name="email" required> 


                </div>

                <br>

                <div class="modalcontainer1">

                    <label style="display: inline;"><b>Password</b>
                    
                    <i class="fas fa-check-circle" style="display: inline;"></i>
                    <i class="fas fa-exclamation-circle" style="display: inline;"></i>
                    <small style="display: inline;">Error message</small>

                    </label> <br>

                    <input type="password" id="psw" placeholder="Enter Password" name="psw" required>

                </div>

                <br>


                <div class="modalcontainer1">

                    <label style="display: inline;"><b>Repeat Password</b>
                    
                    <i class="fas fa-check-circle" style="display: inline;"></i>
                    <i class="fas fa-exclamation-circle" style="display: inline;"></i>
                    <small style="display: inline;">Error message</small>

                    
                    </label> <br>

                    <input type="password" id="psw-repeat" placeholder="Repeat Password" name="psw-repeat" required>
        
                </div>

                <br>

                <div class="modalcontainer1">

                    
                    <label ><b>Mobile number</b>
                    
                    <i class="fas fa-check-circle" ></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>

                    
                    </label> <br>

                    <input type="text" id="mobileNo" placeholder="Enter Mobile number" name="mobileNo" required> 


                </div>

                <br>

                <div class="modalcontainer1">

                    
                    <label ><b>Country</b>
                    
                    <i class="fas fa-check-circle" ></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>

                    
                    </label> <br>

                    <input type="text" id="country" placeholder="Enter Country" name="country" required> 


                </div>

                <br>

                <div class="modalcontainer1">

                    
                    <label ><b>State</b>
                    
                    <i class="fas fa-check-circle" ></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>

                    
                    </label> <br>

                    <input type="text" id="state" placeholder="Enter State" name="state" required> 


                </div>

                <br>

                <div class="modalcontainer1">

                    
                    <label ><b>City</b>
                    
                    <i class="fas fa-check-circle" ></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>

                    
                    </label> <br>

                    <input type="text" id="city" placeholder="Enter City" name="city" required> 


                </div>

                <br>

                <div class="modalcontainer1">

                    
                    <label ><b>Language</b>
                    
                    <i class="fas fa-check-circle" ></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>

                    
                    </label> <br>

                    <input type="text" id="language" placeholder="Enter Language Preference" name="language" required> 


                </div>
    

                <br/>

    
                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
    
                <div class="clearfix1">
                    <button type="button" onclick="document.getElementById('signupModal').style.display='none'" class="cancelbtn1 btn2">Cancel</button>
                    <button type="submit" class="signupbtn1 btn2" id="signupSubmit">Sign Up</button>
                </div>
                </div>
            </form>
        </div>

        <!-- Signup Modal JS -->
        <script>

            var modal = document.getElementById('signupModal');

            window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            }
        </script>

    </body>

</html>