function validation(){

    var user = document.getElementById('user').value;
    var email = document.getElementById('email').value;
    var pass = document.getElementById('pass').value;
    var conpass = document.getElementById('conpass').value;

    if(user==""){
        document.getElementById('username').innerHTML = "Empty";
        return false;
    }
    if(email==""){
        document.getElementById('mail').innerHTML = "Empty";
        return false;
    }
    if(pass==""){
        document.getElementById('password').innerHTML = "Empty";
        return false;
    }
    if(conpass==""){
        document.getElementById('cpassword').innerHTML = "Empty";
        return false;
    }
}