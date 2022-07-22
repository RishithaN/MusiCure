$(function(){

  $(".themeSongDisplay").on("click" , function(e){


    var themeId = $(this).data('for');
    //alert(themeId);

    if(themeId == "4"){
      urlTheme = "assets/php/discover.php";
    }
    else{
      urlTheme = "assets/php/themeSongs.php";
    }

    $.ajax({
        type: 'post',
        url: urlTheme,
        data: {'themeId' : themeId},
        success: function (res) {
          //alert(res);

                document.getElementById('homeContent').style.display = "none";

                document.getElementById('searchContent').style.display = "none";

                document.getElementById('favoritesContent').style.display = "none";

                document.getElementById('songInfo').style.display = "none";

                document.getElementById('artistInfo').style.display = "none";

                document.getElementById('profileContent').style.display = "none";

                document.getElementById('composerInfo').style.display = "none";

                document.getElementById('albumInfo').style.display = "none";

                $(document).ready(function () {
                    window.scrollTo(0,0);
                });

                globalThis.resultTheme = $.parseJSON(res);

                document.getElementById('themeInfoName').innerHTML = resultTheme[0][0];
                document.getElementById('themeInfoImg').src = resultTheme[0][1];

                
                  var themeTable = document.getElementById('themeSongTable');
                  $("#themeSongTable tr:gt(0)").remove();
                  var newThemeRow;


                  for(i=0;i<resultTheme.length;i++){

                    themeTable = document.getElementById('themeSongTable');

                    newThemeRow = themeTable.insertRow(themeTable.rows.length);

                    cell1 = newThemeRow.insertCell(0);
                    cell2 = newThemeRow.insertCell(1);
                    cell3 = newThemeRow.insertCell(2);
                    cell4 = newThemeRow.insertCell(3);
                    cell5 = newThemeRow.insertCell(4); 
                    cell6 = newThemeRow.insertCell(5);

                    cell1.innerHTML = i+1;
                    cell2.innerHTML = `<img src="${resultTheme[i][2]}" class="themeSongImg">`;
                    cell3.innerHTML = resultTheme[i][3];
                    cell4.innerHTML = resultTheme[i][8].concat(" ...");
                    cell5.innerHTML = resultTheme[i][4];
                    cell6.innerHTML = resultTheme[i][5];


                  }

              document.getElementById('themeContents').style.display = "block";

        }        
     });
    
  })


  $("#themeSongPlay").on("click" , function(e){

    e.preventDefault();

    document.getElementById('ImgPlaying').src = resultTheme[0][2];
    document.getElementById('NamePlaying').innerHTML = resultTheme[0][3];
    document.getElementById('songSrc').src = resultTheme[0][6];

    document.getElementById('likeSongId').innerHTML = resultTheme[0][7];
    checkFav();

    var music = document.getElementById('songSrc');


    document.getElementById('ArtistPlaying').innerHTML = resultTheme[0][8].concat(" ...");
    

    document.getElementById('nextBtn').hidden = false;
    document.getElementById('previousBtn').hidden = false;

    playPause('songSrc');

    $.ajax({
      type: 'post',
      url: "assets/php/lastPlayedSongUpdate.php",
      data: {'songId' : resultTheme[0][7]},
      success: function (res3) {
        //alert(res3);
        
      }
    });

    var loop = 0;

    $("#nextBtn").on("click" , function(e){

      if(loop == resultTheme.length-1){
        loop = 0;
        
      }
      else{
        loop += 1;
      }

      document.getElementById('ImgPlaying').src = resultTheme[loop][2];
      document.getElementById('NamePlaying').innerHTML = resultTheme[loop][3];
      document.getElementById('ArtistPlaying').innerHTML = resultTheme[loop][8].concat(" ...");
    

      document.getElementById('likeSongId').innerHTML = resultTheme[loop][7];
      checkFav();

      document.getElementById('songSrc').src = resultTheme[loop][6];
      playPause('songSrc');

      $.ajax({
        type: 'post',
        url: "assets/php/lastPlayedSongUpdate.php",
        data: {'songId' : resultTheme[loop][7]},
        success: function (res3) {
          //alert(res3);
          
        }
      });

    })

    $("#previousBtn").on("click" , function(e){

      if(loop == 0){
        loop=0
      }
      else{
        loop -= 1;
      }

      document.getElementById('ImgPlaying').src = resultTheme[loop][2];
      document.getElementById('NamePlaying').innerHTML = resultTheme[loop][3];
      document.getElementById('ArtistPlaying').innerHTML = resultTheme[loop][8].concat(" ...");

      document.getElementById('likeSongId').innerHTML = resultTheme[loop][7];
      checkFav();

      document.getElementById('songSrc').src = resultTheme[loop][6];
      playPause('songSrc');

      $.ajax({
        type: 'post',
        url: "assets/php/lastPlayedSongUpdate.php",
        data: {'songId' : resultTheme[loop][7]},
        success: function (res3) {
          //alert(res3);
          
        }
      });

    })



    music.addEventListener('ended',function(){

      //alert(loop);

      loop++;


      if(loop == resultTheme.length){
        loop=0;
      }

      music.pause();
      
      document.getElementById('ImgPlaying').src = resultTheme[loop][2];
      document.getElementById('NamePlaying').innerHTML = resultTheme[loop][3];
      document.getElementById('ArtistPlaying').innerHTML = resultTheme[loop][8].concat(" ...");

      document.getElementById('likeSongId').innerHTML = resultTheme[loop][7];
      checkFav();

      document.getElementById('songSrc').src = resultTheme[loop][6];
      playPause('songSrc');

      $.ajax({
        type: 'post',
        url: "assets/php/lastPlayedSongUpdate.php",
        data: {'songId' : resultTheme[loop][7]},
        success: function (res3) {
          //alert(res3);
          
        }
      });


    });


  })

});