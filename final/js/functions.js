//ajax
$(document).ready( function(){
    $("#loginBtn").click( function(){
        $('#loginModal').modal("show");
        $("#login").html("<div class='text-center'><img src='img/loading.gif'></div>");
        
        $.ajax({
            success: function(data,status) {
                $("#login").html("<div class='form' id='signinForm'><div class='form-group'><span class='userPrompt'>Username:</span><div class='input-group'><span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span><input type='text' id='loginUsername' name='loginUsername' class='form-control' placeholder='Username'/><br /></div></div><div class='form-group'><span class='userPrompt'>Password: </span><div class='input-group'><span class='input-group-addon'><i class='glyphicon glyphicon-lock' aria-hidden='true'></i></span><input type='password' id='loginPassword' name='loginPassword' placeholder='Password' class='form-control'/><br /></div></div></div>"); 
                $("#login").append("<div class='btn-group'><button type='button' id='loginSubmit' class='btn btn-default' aria-label='Login'>Login</button></div>");
                $("#loginModalLabel").html("<span class='modalTitle text-center'>Login</div>");                   
            },
            complete: function(data,status) { // Used for debugging purposes
            }
        });
    }); 
        
    $("#signupBtn").click( function(){
        $('#signupModal').modal("show");
        $("#signup").html("<div class='text-center'><img src='img/loading.gif'></div>");
        
        $.ajax({
            success: function(data,status) {
                $("#signup").html("<div class='form' id='signupForm'><div class='form-group'><span class='userPrompt'>Username:</span><div class='input-group'><span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span><input type='text' name='username' placeholder='Username' class='form-control'/><br /></div></div><div class='form-group'><span class='userPrompt'>Password: </span><div class='input-group'><span class='input-group-addon'><i class='glyphicon glyphicon-lock' aria-hidden='true'></i></span><input type='password' name='password' placeholder='Password' class='form-control'/><br /></div>");   
                $("#signup").append("<label for='stateSelect'>Select State</label><select class='form-control' id='stateSelect'><?php getStateCodes(); ?></select></div></div>");
                $("#signup").append("<br /><div class='btn-group'><button type='button' class='btn btn-default' class='close' data-dismiss='modal' aria-label='Sign Up'>Sign Up</button></div>");
                $("#signupModalLabel").html("<span class='modalTitle text-center'>Sign Up</span>");                   
            },
            complete: function(data,status) { // Used for debugging purposes
            }
        });
    }); 
});

//listeners
$(document).on("click", "#loginSubmit", function(event){
    $(".error").remove();
    
    if(!$('#loginUsername').val() && !$('#loginPassword').val()){
        $('#signinForm .glyphicon-user').after(' <span class="error">*</span>');
        $('.glyphicon-lock').after(' <span class="error">*</span>');
        $(".btn-group").after('<span class="error">&nbsp;&nbsp;Incorrect Username or Password</span>') //move this to validation
    }else if(!$('#loginUsername').val()){
        $('#signinForm .glyphicon-user').after(' <span class="error">*</span>');
    }else if(!$('#loginPassword').val()){
        $('.glyphicon-lock').after(' <span class="error">*</span>');
    }
    
    if($('#loginUsername').val() && $('#loginPassword').val()){
        var username = $('#loginUsername').val();
        var password= $('#loginPassword').val();
        console.log(username + " " + password); 
        $('#loginModal').modal('toggle');
    }
});