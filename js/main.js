"use strict"     
var list = [[]];
 

$(document).ready(function () {
      $("#title").focus();
      $("#title").on("input", checkTitle);
      $("#grade").on("change", checkGrade);
      //$("#save").click(checkFields);
      $("#save").on("click", checkFields);
      $("#newpost").on("click", postComment);
      $("#postName").on("input", checkNamn);
      $("#postComment").on("input", checkComment);
    
    //slideshow logic
      $("#slideshow > div:gt(0)").hide();
        setInterval(function() { 
          $('#slideshow > div:first')
            .fadeOut(2000)
            .next()
            .fadeIn(2000)
            .end()
            .appendTo('#slideshow');
        },  5000);
    
});  
//IF A NEW POST IS SUBMITED
function postComment() {
    if (checkNamn() && checkComment()) {
        
// Variable to hold request
var request;

// Bind to the submit event of our form
$("#guestpostForm").submit(function(event){
    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);
    // Let's select and cache all the fields
    var $inputs = $form.find("input, textarea");
    // Serialize the data in the form
    var serializedData = $form.serialize();

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "postLogic.php",
        type: "POST",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log(response);
        var splitResult=response.split("__");
        $('#postList').prepend('<li><h2>'+splitResult[0]+'</h3> <p>'+splitResult[1]+'</p></li>');
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $form.reset();
        $inputs.prop("disabled", false);
    });

    // Prevent default posting of form
    //event.preventDefault();
});
    } else
        return false;
    $("#postName").val() == "";
    $("#postComment").val() == "";
    
}
  function checkFields() {
      if (checkTitle() && checkGrade() && checkImdb() && checkBild() && checkHandling() ) {
          $("#saveMovies").submit(function(){
              return true;
          });
      }else{
          return false;
      }
  }
  function checkTitle() {
      if ($("#title").val()=="") {
           console.log("1");
          $("#title").css("background-color", "red");
           console.log("1");
         // evt.preventDefault();
          return false;
      } else {
          $("#title").css("background-color", "white");
          return true;
      }
  }
  function checkGrade() {
      if ($("#grade").val() === "0") {
          $("#grade").css("background-color", "red");
         
          return false;
      } else {
          $("#grade").css("background-color", "white");
          return true;
      }
  }
function checkImdb() {
      if ($("#imdb").val() == "") {
          $("#imdb").css("background-color", "red");
         
          return false;
      } else {
          $("#imdb").css("background-color", "white");
          return true;
      }
  } 
function checkBild() {
      if ($("#bild").val() == "") {
          $("#bild").css("background-color", "red");
         
          return false;
      } else {
          $("#bild").css("background-color", "white");
          return true;
      }
  } 
function checkHandling() {
      if ($("#handling").val() == "") {
          $("#handling").css("background-color", "red");
         
          return false;
      } else {
          $("#handling").css("background-color", "white");
          return true;
      }
  }
    function checkNamn() {
      if ($("#postName").val() == "") {
          $("#postName").css("background-color", "red");
         
          return false;
      } else {
          $("#postName").css("background-color", "white");
          return true;
      }
  }
    function checkComment() {
      if ($("#postComment").val() == "") {
          $("#postComment").css("background-color", "red");
         
          return false;
      } else {
          $("#postComment").css("background-color", "white");
          return true;
      }
  }

    

