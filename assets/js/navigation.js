$(function(){
    
    $("#homeNav").click(function(e){
        document.getElementById('favoritesContent').style.display = "none";
        
        document.getElementById('profileContent').style.display = "none";

        document.getElementById('searchContent').style.display = "none";

        document.getElementById('songInfo').style.display = "none";

        document.getElementById('artistInfo').style.display = "none";

        document.getElementById('albumInfo').style.display = "none";

        document.getElementById('composerInfo').style.display = "none";

        document.getElementById('themeContents').style.display = "none";


        $(document).ready(function () {
            window.scrollTo(0,0);
        });


        document.getElementById('homeContent').style.display = "block";
    });

    $("#favoriteNav").click(function(e){

        $.ajax({
            type: 'post',
            url: "assets/php/userFavorites.php",
            data: {},
            success: function (res) {
                //alert(res);

                document.getElementById('homeContent').style.display = "none";

                document.getElementById('searchContent').style.display = "none";

                document.getElementById('profileContent').style.display = "none";

                document.getElementById('songInfo').style.display = "none";

                document.getElementById('artistInfo').style.display = "none";

                document.getElementById('albumInfo').style.display = "none";

                document.getElementById('composerInfo').style.display = "none";

                document.getElementById('themeContents').style.display = "none";

                $(document).ready(function () {
                    window.scrollTo(0,0);
                });


                globalThis.resultFavorite = $.parseJSON(res);

                document.getElementById('favTotal').innerHTML = resultFavorite.length + " songs";
                
                  var favTable = document.getElementById('favSongTable');
                  $("#favSongTable tr:gt(0)").remove();
                  var newFavRow;


                  for(i=0;i<resultFavorite.length;i++){

                    favTable = document.getElementById('favSongTable');

                    newFavRow = favTable.insertRow(favTable.rows.length);

                    cell1 = newFavRow.insertCell(0);
                    cell2 = newFavRow.insertCell(1);
                    cell3 = newFavRow.insertCell(2);
                    cell4 = newFavRow.insertCell(3);
                    cell5 = newFavRow.insertCell(4); 
                    cell6 = newFavRow.insertCell(5);
                    cell7 = newFavRow.insertCell(6);

                    cell1.innerHTML = i+1;
                    cell2.innerHTML = `<img src="${resultFavorite[i][1]}" class="favoriteImg">`;
                    cell3.innerHTML = resultFavorite[i][0];
                    cell4.innerHTML = resultFavorite[i][6];
                    cell5.innerHTML = resultFavorite[i][2];
                    cell6.innerHTML = '<i class="material-icons">favorite</i>';
                    cell7.innerHTML = resultFavorite[i][3];


                  }

        
                document.getElementById('favoritesContent').style.display = "block";


            }     


		});


        $("#favSongPlay").on("click" , function(e){

            e.preventDefault();
    
            document.getElementById('ImgPlaying').src = resultFavorite[0][1];
            document.getElementById('NamePlaying').innerHTML = resultFavorite[0][0];
            document.getElementById('songSrc').src = resultFavorite[0][4];
    
            var music = document.getElementById('songSrc');
    
            document.getElementById('ArtistPlaying').innerHTML = resultFavorite[0][6].concat(" ...");
    
            document.getElementById('likeSongId').innerHTML = resultFavorite[0][5];
            checkFav();
    
            document.getElementById('nextBtn').hidden = false;
            document.getElementById('previousBtn').hidden = false;
    
            playPause('songSrc');
    
            $.ajax({
              type: 'post',
              url: "assets/php/lastPlayedSongUpdate.php",
              data: {'songId' : resultFavorite[0][5]},
              success: function (res3) {
                //alert(res3);
                
              }
            });
    
            var loop = 0;
    
            $("#nextBtn").on("click" , function(e){
    
              if(loop == resultFavorite.length-1){
                loop = 0;
                
              }
              else{
                loop += 1;
              }
    
                document.getElementById('ImgPlaying').src = resultFavorite[loop][1];
                document.getElementById('NamePlaying').innerHTML = resultFavorite[loop][0];
                document.getElementById('songSrc').src = resultFavorite[loop][4];
        
                var music = document.getElementById('songSrc');
        
                document.getElementById('ArtistPlaying').innerHTML = resultFavorite[loop][6].concat(" ...");
        
                document.getElementById('likeSongId').innerHTML = resultFavorite[loop][5];
                checkFav();
        
                document.getElementById('nextBtn').hidden = false;
                document.getElementById('previousBtn').hidden = false;
        
                playPause('songSrc');
        
                $.ajax({
                type: 'post',
                url: "assets/php/lastPlayedSongUpdate.php",
                data: {'songId' : resultFavorite[loop][5]},
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

                document.getElementById('ImgPlaying').src = resultFavorite[loop][1];
                document.getElementById('NamePlaying').innerHTML = resultFavorite[loop][0];
                document.getElementById('songSrc').src = resultFavorite[loop][4];
        
                var music = document.getElementById('songSrc');
        
                document.getElementById('ArtistPlaying').innerHTML = resultFavorite[loop][6].concat(" ...");
        
                document.getElementById('likeSongId').innerHTML = resultFavorite[loop][5];
                checkFav();
        
                document.getElementById('nextBtn').hidden = false;
                document.getElementById('previousBtn').hidden = false;
        
                playPause('songSrc');
        
                $.ajax({
                    type: 'post',
                    url: "assets/php/lastPlayedSongUpdate.php",
                    data: {'songId' : resultFavorite[loop][5]},
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
              
                document.getElementById('ImgPlaying').src = resultFavorite[loop][1];
                document.getElementById('NamePlaying').innerHTML = resultFavorite[loop][0];
                document.getElementById('songSrc').src = resultFavorite[loop][4];
        
                var music = document.getElementById('songSrc');
        
                document.getElementById('ArtistPlaying').innerHTML = resultFavorite[loop][6].concat(" ...");
        
                document.getElementById('likeSongId').innerHTML = resultFavorite[loop][5];
                checkFav();
        
                document.getElementById('nextBtn').hidden = false;
                document.getElementById('previousBtn').hidden = false;
        
                playPause('songSrc');
        
                $.ajax({
                    type: 'post',
                    url: "assets/php/lastPlayedSongUpdate.php",
                    data: {'songId' : resultFavorite[loop][5]},
                    success: function (res3) {
                        //alert(res3);
                        
                    }
                });
    
    
            });
    
    
          })


    });

    $("#profileNav").click(function(e){
        document.getElementById('homeContent').style.display = "none";

        document.getElementById('favoritesContent').style.display = "none";

        document.getElementById('searchContent').style.display = "none";

        document.getElementById('songInfo').style.display = "none";

        document.getElementById('artistInfo').style.display = "none";

        document.getElementById('albumInfo').style.display = "none";

        document.getElementById('composerInfo').style.display = "none";

        document.getElementById('themeContents').style.display = "none";

        $(document).ready(function () {
            window.scrollTo(0,0);
        });
   
        document.getElementById('profileContent').style.display = "block";

    });

    $("#searchNav").click(function(e){

        document.getElementById('homeContent').style.display = "none";

        document.getElementById('favoritesContent').style.display = "none";

        document.getElementById('profileContent').style.display = "none";

        document.getElementById('songInfo').style.display = "none";

        document.getElementById('artistInfo').style.display = "none";

        document.getElementById('albumInfo').style.display = "none";

        document.getElementById('composerInfo').style.display = "none";

        document.getElementById('themeContents').style.display = "none";

        $(document).ready(function () {
            window.scrollTo(0,0);
        });
   
        document.getElementById('searchContent').style.display = "block";

        $.ajax({
			type: 'post',
			url: "assets/php/searchList.php",
			data: {},
			success: function (res) {
				//alert(res);
			}        
		});


    });



});

