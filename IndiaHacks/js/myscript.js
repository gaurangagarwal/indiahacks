  function validateF12orm(user) {
    if(document.getElementById("user".concat(user)).value == "") {
      alert("Fill the form");
      return false;
    } 
    return true;
  }
  
  // $("document").ready(function() {
  //   $(document).ajaxStart(function(){
  //       $("#message").css("display","block");
  //       $("#message").text("Logging In");  
  //       console.log("Sending request");
  //   });
  //   $(document).ajaxComplete(function() {
  //       $("#message").text("Logged In");
  //       $("#message").css("display","none");
  //       console.log("Message sned");
  //   }); 
  // });
  var timeShow = 1000;

   $("#logoutBut").on('click', function(e){
      e.preventDefault();   
      $.ajax({
         url: 'ajax/logout.php',  
         type:'GET', 
      }).success(function(data){   
         $("#message").text("Logged Out"); 
          showMessage();
          setTimeout(function () {
            pageReload();    
          }, timeShow);
      }).fail(function(data){
          $("#message").text("Please try again"); 
          showMessage();
      }) 
  });
  
  function notiClick() {
    $("#notiBut").slideToggle();
    $("#notiForm").slideToggle();
  } 

  function showMessage() {
      $("#message").fadeIn(100);
      setTimeout(function() {
        $("#message").fadeOut(100);
      }, timeShow);
  }
  function pageReload() {
    location.reload();
  }