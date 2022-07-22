$(document).ready(function(){


  $(".nameList").on("click" , function(e){

    e.preventDefault();

    var id=$(this).data('for');

    let searchOpt = id.slice(0,1);
    let searchId = id.slice(2,id.length);

    if(searchOpt == 1){
      //alert("song");


      $.ajax({
          type: 'post',
          url: "assets/php/songInfo.php",
          data: {'songId' : searchId},
          success: function (res1) {
            //alert(res1);

                    globalThis.result1 = $.parseJSON(res1);

                    document.getElementById('songInfoName').innerHTML = result1[0];
                    document.getElementById('songInfoImg').src = result1[2];
                    document.getElementById('songInfoAlbum').innerHTML = result1[1];

            }        
		});

      $.ajax({
        type: 'post',
        url: "assets/php/songInfoArtist.php",
        data: {'songId' : searchId},
        success: function (res2) {
          //alert(res2);
                  document.getElementById('homeContent').style.display = "none";

                  document.getElementById('searchContent').style.display = "none";

                  document.getElementById('favoritesContent').style.display = "none";

                  document.getElementById('artistInfo').style.display = "none";

                  document.getElementById('profileContent').style.display = "none";

                  document.getElementById('composerInfo').style.display = "none";

                  document.getElementById('themeContents').style.display = "none";

                  $(document).ready(function () {
                      window.scrollTo(0,0);
                  });

                  globalThis.result2 = $.parseJSON(res2);
                  var artists = result2[0];

                  for(i=1;i<result2.length;i++){
                    artists = artists.concat(" , " , result2[i]);
                  }

                  document.getElementById('songInfoArtist').innerHTML = artists;

                  document.getElementById('songInfo').style.display = "block";
          }        
      });


      $("#songInfoPlay").on("click" , function(e){

        e.preventDefault();

        $.ajax({
          type: 'post',
          url: "assets/php/lastPlayedSongUpdate.php",
          data: {'songId' : searchId},
          success: function (res3) {
            //alert(res3);
            
          }
        });

        document.getElementById('likeSongId').innerHTML = searchId;
        checkFav();

        document.getElementById('ImgPlaying').src = result1[2];
        document.getElementById('NamePlaying').innerHTML = result1[0];

        document.getElementById('likeSongId').innerHTML = searchId;

        document.getElementById('songSrc').src = result1[3];
        //alert(result1[3]);

        if(result2.length > 1){

          document.getElementById('ArtistPlaying').innerHTML = result2[0].concat(" ...");

        }
        else{
          document.getElementById('ArtistPlaying').innerHTML = result2[0];
        }


        document.getElementById('nextBtn').hidden = true;
        document.getElementById('previousBtn').hidden = true;
        playPause('songSrc');
        

      })

    

    }
    else if(searchOpt == 2){
        //alert("artist");
        //alert(searchId);
        $.ajax({
            type: 'post',
            url: "assets/php/artistInfo.php",
            data: {'artistId' : searchId},
            success: function (res) {
              //alert(res);

                  document.getElementById('homeContent').style.display = "none";

                  document.getElementById('searchContent').style.display = "none";

                  document.getElementById('favoritesContent').style.display = "none";

                  document.getElementById('songInfo').style.display = "none";

                  document.getElementById('albumInfo').style.display = "none";

                  document.getElementById('profileContent').style.display = "none";

                  document.getElementById('composerInfo').style.display = "none";

                  document.getElementById('themeContents').style.display = "none";

                  $(document).ready(function () {
                      window.scrollTo(0,0);
                  });

                  globalThis.resultArtist = $.parseJSON(res);

                  document.getElementById('artistInfoName').innerHTML = resultArtist[0][0];
                  document.getElementById('artistDescription').innerHTML = resultArtist[0][7];

                  var artistTable = document.getElementById('artistSongTable');
                  $("#artistSongTable tr:gt(0)").remove();
                  var newArtistRow;


                  for(i=0;i<resultArtist.length;i++){

                    artistTable = document.getElementById('artistSongTable');

                    newArtistRow = artistTable.insertRow(artistTable.rows.length);

                    cell1 = newArtistRow.insertCell(0);
                    cell2 = newArtistRow.insertCell(1);
                    cell3 = newArtistRow.insertCell(2);
                    cell4 = newArtistRow.insertCell(3);
                    cell5 = newArtistRow.insertCell(4);

                    cell1.innerHTML = i+1;
                    cell2.innerHTML = `<img src="${resultArtist[i][1]}" class="artistImg">`;
                    cell3.innerHTML = resultArtist[i][2];
                    cell4.innerHTML = resultArtist[i][3];
                    cell5.innerHTML = resultArtist[i][4];


                  }



                  document.getElementById('artistInfo').style.display = "block";

            }     


		    });


        $("#artistInfoPlay").on("click" , function(e){

          e.preventDefault();

          document.getElementById('ImgPlaying').src = resultArtist[0][1];
          document.getElementById('NamePlaying').innerHTML = resultArtist[0][2];
          document.getElementById('songSrc').src = resultArtist[0][5];

          document.getElementById('likeSongId').innerHTML = resultArtist[0][6];
          checkFav();

          var music = document.getElementById('songSrc');


          document.getElementById('ArtistPlaying').innerHTML = resultArtist[0][0].concat(" ...");

          document.getElementById('likeSongId').innerHTML = resultArtist[0][6];
          

          document.getElementById('nextBtn').hidden = false;
          document.getElementById('previousBtn').hidden = false;

          playPause('songSrc');

          $.ajax({
            type: 'post',
            url: "assets/php/lastPlayedSongUpdate.php",
            data: {'songId' : resultArtist[0][6]},
            success: function (res3) {
              //alert(res3);
              
            }
          });

          var loop = 0;

          $("#nextBtn").on("click" , function(e){

            if(loop == resultArtist.length-1){
              loop = 0;
              
            }
            else{
              loop += 1;
            }

            document.getElementById('ImgPlaying').src = resultArtist[loop][1];
            document.getElementById('NamePlaying').innerHTML = resultArtist[loop][2];

            document.getElementById('likeSongId').innerHTML = resultArtist[loop][6];
            checkFav();

            document.getElementById('songSrc').src = resultArtist[loop][5];
            playPause('songSrc');

            $.ajax({
              type: 'post',
              url: "assets/php/lastPlayedSongUpdate.php",
              data: {'songId' : resultArtist[loop][6]},
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

            document.getElementById('ImgPlaying').src = resultArtist[loop][1];
            document.getElementById('NamePlaying').innerHTML = resultArtist[loop][2];

            document.getElementById('likeSongId').innerHTML = resultArtist[loop][6];
            checkFav()

            document.getElementById('songSrc').src = resultArtist[loop][5];
            playPause('songSrc');

            $.ajax({
              type: 'post',
              url: "assets/php/lastPlayedSongUpdate.php",
              data: {'songId' : resultArtist[loop][6]},
              success: function (res3) {
                //alert(res3);
                
              }
            });
          })



          music.addEventListener('ended',function(){

            //alert(loop);

            loop++;


            if(loop == resultArtist.length){
              loop=0;
            }

            music.pause();
            document.getElementById('ImgPlaying').src = resultArtist[loop][1];
            document.getElementById('NamePlaying').innerHTML = resultArtist[loop][2];

            document.getElementById('likeSongId').innerHTML = resultArtist[loop][6];
            checkFav();

            document.getElementById('songSrc').src = resultArtist[loop][5];
            playPause('songSrc');

            $.ajax({
              type: 'post',
              url: "assets/php/lastPlayedSongUpdate.php",
              data: {'songId' : resultArtist[loop][6]},
              success: function (res3) {
                //alert(res3);
                
              }
            });


          });

  
        })



    }
    else if(searchOpt == 3){
        //alert("album");

        $.ajax({
              type: 'post',
              url: "assets/php/albumInfo.php",
              data: {'albumId' : searchId},
              success: function (res) {
                //alert(res);


                document.getElementById('homeContent').style.display = "none";

                document.getElementById('searchContent').style.display = "none";

                document.getElementById('favoritesContent').style.display = "none";

                document.getElementById('songInfo').style.display = "none";

                document.getElementById('artistInfo').style.display = "none";

                document.getElementById('profileContent').style.display = "none";

                document.getElementById('composerInfo').style.display = "none";

                document.getElementById('themeContents').style.display = "none";

                $(document).ready(function () {
                    window.scrollTo(0,0);
                });

                globalThis.resultAlbum = $.parseJSON(res);

                document.getElementById('albumInfoName').innerHTML = resultAlbum[0][0];
                document.getElementById('albumInfoImg').src = resultAlbum[0][1];

                var albumTable = document.getElementById('albumSongTable');
                $("#albumSongTable tr:gt(0)").remove();
                var newAlbumRow;


                for(i=0;i<resultAlbum.length;i++){

                      albumTable = document.getElementById('albumSongTable');

                      newAlbumRow = albumTable.insertRow(albumTable.rows.length);

                      cell1 = newAlbumRow.insertCell(0);
                      cell2 = newAlbumRow.insertCell(1);
                      cell3 = newAlbumRow.insertCell(2);
                      cell4 = newAlbumRow.insertCell(3);

                      cell1.innerHTML = i+1;
                      cell2.innerHTML = resultAlbum[i][2];
                      cell4.innerHTML = resultAlbum[i][3];

                      if(resultAlbum[i][6].length > 1){
                        cell3.innerHTML = resultAlbum[i][6][0] + "...";
                      }
                      else{
                        cell3.innerHTML = resultAlbum[i][6][0];
                      }


                }

              document.getElementById('albumInfo').style.display = "block";




              }        
		  });

      $("#albumInfoPlay").on("click" , function(e){

        e.preventDefault();

        document.getElementById('ImgPlaying').src = resultAlbum[0][1];
        document.getElementById('NamePlaying').innerHTML = resultAlbum[0][2];
        document.getElementById('songSrc').src = resultAlbum[0][4];

        var music = document.getElementById('songSrc');

        document.getElementById('ArtistPlaying').innerHTML = resultAlbum[0][6][0].concat(" ...");

        document.getElementById('likeSongId').innerHTML = resultAlbum[0][5];
        checkFav();

        document.getElementById('nextBtn').hidden = false;
        document.getElementById('previousBtn').hidden = false;

        playPause('songSrc');

        $.ajax({
          type: 'post',
          url: "assets/php/lastPlayedSongUpdate.php",
          data: {'songId' : resultAlbum[0][5]},
          success: function (res3) {
            //alert(res3);
            
          }
        });

        var loop = 0;

        $("#nextBtn").on("click" , function(e){

          if(loop == resultAlbum.length-1){
            loop = 0;
            
          }
          else{
            loop += 1;
          }

          document.getElementById('ImgPlaying').src = resultAlbum[loop][1];
          document.getElementById('NamePlaying').innerHTML = resultAlbum[loop][2];
          document.getElementById('ArtistPlaying').innerHTML = resultAlbum[loop][6][0].concat(" ...");

          document.getElementById('likeSongId').innerHTML = resultAlbum[0][5];

          document.getElementById('songSrc').src = resultAlbum[loop][4];
          playPause('songSrc');

          $.ajax({
            type: 'post',
            url: "assets/php/lastPlayedSongUpdate.php",
            data: {'songId' : resultAlbum[loop][5]},
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

          document.getElementById('ImgPlaying').src = resultAlbum[loop][1];
          document.getElementById('NamePlaying').innerHTML = resultAlbum[loop][2];
          document.getElementById('ArtistPlaying').innerHTML = resultAlbum[loop][6][0].concat(" ...");

          document.getElementById('likeSongId').innerHTML = resultAlbum[0][5];
          checkFav();

          document.getElementById('songSrc').src = resultAlbum[loop][4];
          playPause('songSrc');

          $.ajax({
            type: 'post',
            url: "assets/php/lastPlayedSongUpdate.php",
            data: {'songId' : resultAlbum[loop][5]},
            success: function (res3) {
              //alert(res3);
              
            }
          });
        })



        music.addEventListener('ended',function(){

          //alert(loop);

          loop++;


          if(loop == resultAlbum.length){
            loop=0;
          }

          music.pause();
          document.getElementById('ImgPlaying').src = resultAlbum[loop][1];
          document.getElementById('NamePlaying').innerHTML = resultAlbum[loop][2];
          document.getElementById('ArtistPlaying').innerHTML = resultAlbum[loop][6][0].concat(" ...");

          document.getElementById('likeSongId').innerHTML = resultAlbum[0][5];
          checkFav();

          document.getElementById('songSrc').src = resultAlbum[loop][4];
          playPause('songSrc');

          $.ajax({
            type: 'post',
            url: "assets/php/lastPlayedSongUpdate.php",
            data: {'songId' : resultAlbum[loop][5]},
            success: function (res3) {
              //alert(res3);
              
            }
          });


        });


      })



    }

    else if(searchOpt == 4){
      //alert("composer");

      $.ajax({
        type: 'post',
        url: "assets/php/composerInfo.php",
        data: {'composerId' : searchId},
        success: function (res) {
          //alert(res);

              document.getElementById('homeContent').style.display = "none";

              document.getElementById('searchContent').style.display = "none";

              document.getElementById('favoritesContent').style.display = "none";

              document.getElementById('songInfo').style.display = "none";

              document.getElementById('albumInfo').style.display = "none";

              document.getElementById('profileContent').style.display = "none";

              document.getElementById('artistInfo').style.display = "none";

              document.getElementById('themeContents').style.display = "none";

              $(document).ready(function () {
                  window.scrollTo(0,0);
              });

              globalThis.resultComposer = $.parseJSON(res);

              document.getElementById('composerInfoName').innerHTML = resultComposer[0][0];
              document.getElementById('composerDescription').innerHTML = resultComposer[0][8];

              var composerTable = document.getElementById('composerSongTable');
              $("#composerSongTable tr:gt(0)").remove();
              var newComposerRow;


              for(i=0;i<resultComposer.length;i++){

                artistTable = document.getElementById('composerSongTable');

                newComposerRow = composerTable.insertRow(composerTable.rows.length);

                cell1 = newComposerRow.insertCell(0);
                cell2 = newComposerRow.insertCell(1);
                cell3 = newComposerRow.insertCell(2);
                cell4 = newComposerRow.insertCell(3);
                cell5 = newComposerRow.insertCell(4);
                cell6 = newComposerRow.insertCell(5);

                cell1.innerHTML = i+1;
                cell2.innerHTML = `<img src="${resultComposer[i][1]}" class="composerImg">`;
                cell3.innerHTML = resultComposer[i][2];
                cell4.innerHTML = resultComposer[i][7][0].concat(" ...");
                cell5.innerHTML = resultComposer[i][3];
                cell6.innerHTML = resultComposer[i][4];



              }



              document.getElementById('composerInfo').style.display = "block";

        }     


    });


    $("#composerInfoPlay").on("click" , function(e){

      e.preventDefault();

      document.getElementById('ImgPlaying').src = resultComposer[0][1];
      document.getElementById('NamePlaying').innerHTML = resultComposer[0][2];
      document.getElementById('songSrc').src = resultComposer[0][5];

      var music = document.getElementById('songSrc');

      document.getElementById('ArtistPlaying').innerHTML = resultComposer[0][7][0].concat(" ...");

      document.getElementById('likeSongId').innerHTML = resultComposer[0][6];
      checkFav();

      document.getElementById('nextBtn').hidden = false;
      document.getElementById('previousBtn').hidden = false;

      playPause('songSrc');

      $.ajax({
        type: 'post',
        url: "assets/php/lastPlayedSongUpdate.php",
        data: {'songId' : resultComposer[0][6]},
        success: function (res3) {
          //alert(res3);
          
        }
      });

      var loop = 0;

      $("#nextBtn").on("click" , function(e){

        if(loop == resultComposer.length-1){
          loop = 0;
          
        }
        else{
          loop += 1;
        }

        document.getElementById('ImgPlaying').src = resultComposer[loop][1];
        document.getElementById('NamePlaying').innerHTML = resultComposer[loop][2];
        document.getElementById('ArtistPlaying').innerHTML = resultComposer[loop][7][0].concat(" ...");

        document.getElementById('likeSongId').innerHTML = resultComposer[0][6];

        document.getElementById('songSrc').src = resultComposer[loop][5];
        playPause('songSrc');

        $.ajax({
          type: 'post',
          url: "assets/php/lastPlayedSongUpdate.php",
          data: {'songId' : resultComposer[loop][6]},
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

        document.getElementById('ImgPlaying').src = resultComposer[loop][1];
        document.getElementById('NamePlaying').innerHTML = resultComposer[loop][2];
        document.getElementById('ArtistPlaying').innerHTML = resultComposer[loop][7][0].concat(" ...");

        document.getElementById('likeSongId').innerHTML = resultComposer[0][6];
        checkFav();

        document.getElementById('songSrc').src = resultComposer[loop][5];
        playPause('songSrc');

        $.ajax({
          type: 'post',
          url: "assets/php/lastPlayedSongUpdate.php",
          data: {'songId' : resultComposer[loop][6]},
          success: function (res3) {
            //alert(res3);
            
          }
        });
      })



      music.addEventListener('ended',function(){

        //alert(loop);

        loop++;


        if(loop == resultComposer.length){
          loop=0;
        }

        music.pause();
        document.getElementById('ImgPlaying').src = resultComposer[loop][1];
        document.getElementById('NamePlaying').innerHTML = resultComposer[loop][2];
        document.getElementById('ArtistPlaying').innerHTML = resultComposer[loop][7][0].concat(" ...");

        document.getElementById('likeSongId').innerHTML = resultComposer[0][6];
        checkFav();

        document.getElementById('songSrc').src = resultComposer[loop][5];
        playPause('songSrc');

        $.ajax({
          type: 'post',
          url: "assets/php/lastPlayedSongUpdate.php",
          data: {'songId' : resultComposer[loop][6]},
          success: function (res3) {
            //alert(res3);
            
          }
        });


      });


    })


    }

  
  })

  


});


