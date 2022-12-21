

$("#contentBox").fadeIn(2000);

$("#buttonGoToParkourCreation").click(function(){
    $("#mainMenuContainer").fadeOut(1500);
    //$("#contentBox2").delay(1500).fadeIn(2000);
    $("#createParkourContainer").delay(1500).fadeIn(2000);
});

$("#buttonGoToUserCreation").click(function(){
    $("#mainMenuContainer").fadeOut(1500);
    //$("#contentBox2").delay(1500).fadeIn(2000);
    $("#createUserContainer").delay(1500).fadeIn(2000);
});

$("#startButton").click(function(){
    $("#startButton").fadeOut(1500);
    $("#mainMenuContainer").delay(1500).fadeIn(2000);
    $("#mainNav").delay(1500).fadeIn(2000);
})


$("#buttonBackToMainMenu").click(function(){
    $("#createParkourContainer").fadeOut(1500);
    $("#mainMenuContainer").delay(1500).fadeIn(2000);
})

$("#buttonCreateUserBackToMainMenu").click(function(){
    $("#createUserContainer").fadeOut(1500);
    $("#mainMenuContainer").delay(1500).fadeIn(2000);
})




/*
function ajaxpost () {
    // (A) GET FORM DATA
    var form = document.getElementById("parkourForm");
    var data = new FormData(form);

    // (B) AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "processFormParkour.php");
    // What to do when server responds
    //xhr.onload = function () {
      //  console.log(this.response);
    //};
    xhr.send(data);

    // (C) PREVENT HTML FORM SUBMIT
    return false;
}
*/

$("#buttonCreateParkour").click(function(){
    $('#parkourForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "processFormParkour.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(data){
                $("#postData").html(data);
            },
            error: function(){
                alert("Form submission failed!");
            }
        });
    });
});

$("#buttonCreateUser").click(function(){
    $('#userForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "processFormUser.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(data){
                $("#postData").html(data);
            },
            error: function(){
                alert("Form submission failed!");
            }
        });
    });
});

