$(document).ready(function(){
    $("#search").focus(function() {

      $(".search-box").addClass("border-searching");
      
      cancel = document.getElementById("cancelSearch");
      cancel.hidden = false;

      nameDiv = document.getElementById('nameDiv');

      nameDiv.hidden = false; 

    })



    $("#search").keyup(function() {

        if($(this).val().length > 0) {
          $(".go-icon").addClass("go-in");
          nameDiv = document.getElementById('nameDiv');
          nameDiv.hidden = false; 
        }
        else {
          $(".go-icon").removeClass("go-in");
          nameDiv = document.getElementById('nameDiv');

          nameDiv.hidden = true; 

        }
    })
   
});


$(function(){

$("#search").on("click" , function(e){
      nameDiv = document.getElementById('nameDiv');
      nameDiv.hidden = false; 

})


$("#cancelSearch").on("click" , function(e){

  $(".search-box").removeClass("border-searching");

  nameDiv = document.getElementById('nameDiv');

  nameDiv.hidden = true; 
  
  cancel = document.getElementById("cancelSearch");
  cancel.hidden = true;

  searchInput = document.getElementById('search');
  searchInput.value = "";

  $(".go-icon").removeClass("go-in");



})




});




function searchFilter() {

  var input, filter, ul, li, a, i, txtValue;

  input = document.getElementById('search');

  filter = input.value.toUpperCase();

  ul = document.getElementById("nameDiv");
  li = ul.getElementsByTagName('li');


  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;

    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }

  }

}