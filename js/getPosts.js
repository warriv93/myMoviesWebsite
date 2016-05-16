"use strict"    
$(document).ready(function () {    
        var name;
        var message;
        $.ajax({
            type: "GET",
            url: "postLogic.php?action=getPosts",
            dataType: "JSON",
            beforeSend: function() {
              $('#postList').html('<img src="images/loadersimone.gif"/>');
            },
            success: function(response) {
                //console.log(response);
                $('#postList').html(" ");
                //for each element in each posts array
                $.each(response.posts, function(index, element){
                    name = element.name;
                    console.log("name: "+ name);
                    message = element.message;
                    console.log("message: "+message);
                    $('#postList').append('<li><h2>'+name+'</h3> <p>'+message+'</p></li>'); 
                });  
            }
        });
    });