errorMessageActive = 0;
errorTimeout = null;
redirectTimeout = null;
  jQuery(document).ready(function() {

  $('#fm-signup').submit(function(e){
    return false;
  });
  $('#fm-signin').submit(function(e){
    return false;
  });
  



    $("#reg").click(function(){
    var username = $("#username").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var confirm = $("#confirm").val();
    // m = m.replace(":", "");
    $.post("api/signup.php", 
        {
            username:''+username, email:''+email, password:''+password, confirm:''+confirm, reg: "reg"
        },
        function(data)
        {
            if (data != "success")
            {
              showErrorMessage(data);
            }
            if (data == "success")
            {
              showSuccessMessage("Successfully Registered, check your email for verification link");
              
        clearTimeout(errorTimeout);
              redirectTimeout = setTimeout(function () {
                  redirect('index.php');
              }, 4000);
            }
        });

    // alert(c);
    });

    $("#log").click(function(){
    var username = $("#username").val();
    var password = $("#password").val();
    // m = m.replace(":", "");
    $.post("api/signup.php", 
        {
            username:''+username, password:''+password, signin: "signin"
        },
        function(data)
        {
            if (data != "success")
            {
              showErrorMessage(data);
            }
            if (data == "success")
            {
              showLoginMessage("Successfully LoggedIn");
              // showLoginExtra("You will be redirected <a href='map.php'>Home</a>");
              redirectTimeout = setTimeout(function () {
                  redirect('map.php');
              }, 3000);
            }
        });
    });

});


function showErrorMessage(eMessage) {
  eMessage = '<div align="center" class="alert alert-warning alert-dismissable mw800 center-block">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" color="blue">x</button>'+eMessage+
            '</div>';
    $(".error-message").css("visibility", "visible");
    $(".error-message").css("margin", "3% 8%");
    $(".error-message").css("padding", "10px 5px");
    $(".error-message").css("padding", "5px");
    $(".error-message").css("borderRadius", "4px");
    $(".error-message").html(eMessage);
    errorMessageActive = 1;
    errorTimeout = setTimeout(function () {
        hideErrorMessage();
    }, 3000);
}


function showSuccessMessage(eMessage) {
  eMessage = '<div align="center" class="alert alert-success alert-dismissable mw800 center-block">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" color="blue">x</button>'+eMessage+
            '</div>';
    $(".error-message").css("visibility", "visible");
    $(".error-message").css("margin", "3% 8%");
    $(".error-message").css("padding", "10px 5px");
    $(".error-message").css("padding", "5px");
    $(".error-message").css("borderRadius", "4px");
    $(".error-message").html(eMessage);
    errorMessageActive = 1;
    errorTimeout = setTimeout(function () {
        hideErrorMessage();
    }, 3000);
}

function showLoginMessage(eMessage) {
  eMessage = '<div align="center" class="alert alert-success alert-dismissable mw800 center-block">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" color="blue">x</button>'+eMessage+
            '</div>';
    $(".error-message").css("visibility", "visible");
    $(".error-message").css("margin", "3% 8%");
    $(".error-message").css("padding", "10px 5px");
    $(".error-message").css("padding", "5px");
    $(".error-message").css("borderRadius", "4px");
    $(".error-message").html(eMessage);
    errorMessageActive = 1;
    errorTimeout = setTimeout(function () {
        showLoginExtra("Please wait while you are redirected <a href='map.php'><strong>Home</strong></a>");
    }, 2000);
}

function showLoginExtra(eMessage) {
  eMessage = '<div align="center" class="alert alert-success alert-dismissable mw800 center-block">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" color="blue">x</button>'+eMessage+
            '</div>';
    $(".error-message").css("visibility", "visible");
    $(".error-message").css("margin", "3% 8%");
    $(".error-message").css("padding", "10px 5px");
    $(".error-message").css("padding", "5px");
    $(".error-message").css("borderRadius", "4px");
    $(".error-message").html(eMessage);
    // errorMessageActive = 1;
    // errorTimeout = setTimeout(function () {
    //     hideErrorMessage();
    // }, 2000);
}


function hideErrorMessage() {
    if (errorMessageActive === 1) {
        $(".error-message").css("visibility", "hidden");
        $(".error-message").text("");
        $(".error-message").css("margin", "0");
        $(".error-message").css("padding", "0px");
        $(".error-message").css("border", "none");
        errorMessageActive = 0;
        clearTimeout(errorTimeout);
    }
}

function redirect(url) {
  window.location = url;
  clearTimeout(redirectTimeout);
}