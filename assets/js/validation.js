function validation(){

    var user = document.getElementById('user').value;
    var email = document.getElementById('email').value;
    var pass = document.getElementById('pass').value;
    var conpass = document.getElementById('conpass').value;
    var usertype = document.getElementById('usertype').value;

    if(user == ""){
        document.getElementById('username').innerHTML = "**Please fill the username";
        return false;
    }
     if ((user.length <= 2) || (user.length > 10)){
        document.getElementById('username').innerHTML = "**Username must be between 3-10 characters";
        return false;
    }
     if(!isNaN(user)){
        document.getElementById('username').innerHTML = "**Only Characters are allowed";
        return false;
    }
    if(user.length >= 5){
        document.getElementById('username').innerHTML = "**Sucess";
        // return true;
    }


    if(email == ""){
        document.getElementById('mail').innerHTML = "**Please fill the email";
        return false;
    }
    // if(email.indexof('@') <= 0){
    //     document.getElementById('mail').innerHTML = "**Email cannot start with @";
    //     return false;
    // }
    // if((email.charAt(email.length-4) != '.') && (email.charAt(email.length-3) != '.')){
    //     document.getElementById('mail').innerHTML = "**Please Enter valid Email";
    //     return false;
    // }


    if(pass == ""){
        document.getElementById('password').innerHTML = "**Please fill the password";
        return false;
    }
    if((pass.length < 5) || (pass.length > 20)){
        document.getElementById('password').innerHTML = "**Password atleast should be of 5 characters";
        return false;
    }
    if(conpass == ""){
        document.getElementById('cpassword').innerHTML = "**Please fill the confirm password";
        return false;
    }
    if(pass != conpass){
        document.getElementById('cpassword').innerHTML = "**Password does not match";
        return false;
    }




    if(usertype == "3"){
        document.getElementById('type').innerHTML = "**Select user type";
        return false;
    }
}