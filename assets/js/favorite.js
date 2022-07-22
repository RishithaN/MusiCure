

function checkFav(){

      songId = document.getElementById('likeSongId').innerHTML;

        $.ajax({
          type: 'post',
          url: "assets/php/checkFav.php",
          data: {'songId' : songId},
          success: function (res) {

            if(res == 1){
              document.getElementById('likeBtn').hidden = true;
              document.getElementById('likedBtn').hidden = false;
            }
            else{
              document.getElementById('likedBtn').hidden = true;
              document.getElementById('likeBtn').hidden = false;
            }

          }        
      });

  }

  $(function(){

    var songId;

    $("#like").on("click" , function(e){

      songId =  document.getElementById('likeSongId').innerHTML;
      //alert(songId);

      $.ajax({
          type: 'post',
          url: "assets/php/addFav.php",
          data: {'songId' : songId},
          success: function (res) {
            //alert(res);

            document.getElementById('likeBtn').hidden = true;
            document.getElementById('likedBtn').hidden = false;


          }        
       });
      
    })


    $("#liked").on("click" , function(e){

      songId =  document.getElementById('likeSongId').innerHTML;

      //alert(songId + " - liked");

      $.ajax({
        type: 'post',
        url: "assets/php/removeFav.php",
        data: {'songId' : songId},
        success: function (res) {
          //alert(res);

          document.getElementById('likedBtn').hidden = true;
          document.getElementById('likeBtn').hidden = false;

        }        
     });
      
      
    })

});