function $(id) {
    return document.getElementById(id);
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var rexD = /^([a-zA-Z0-9.]+@[a-zA-Z]{1,}.[a-z]{2,3})$/;
    return rexD.test(String(email).toLowerCase());
}

$("Email").addEventListener("input", function(){
    if(validateEmail($("Email").value))
    {
        $("span_email").style.visibility = "hidden";
    }
    else
    {
        $("span_email").style.visibility = "visible";
        $("span1").style.backgroundColor = "#F9A5A5";
    }
})

$("jelszo").addEventListener("input", function(){
    var password = $("password").value;
    var confirm_password = $("confirm_password").value;
    if(password.length < 8)
    {
        $("span1").style.visibility = "visible";
        $("span1").style.backgroundColor = "#F9A5A5";
        $("span1").innerHTML = "A jelszó legyen legalább 8 karakter!";
    }
    else if(password.length >= 8)
    {
        $("span1").style.visibility = "hidden";
    }
    if(password == confirm_password && password.length >= 8)
    {
        $("span2").style.visibility = "visible";
        $("span2").style.backgroundColor = "lightgreen";
        $("span2").innerHTML = "Jelszavak egyeznek!";
    }
    else
    {
        $("span2").style.visibility = "visible";
        $("span2").style.backgroundColor = "#F9A5A5";
        $("span2").innerHTML = "Jelszavak nem egyeznek!";
    }
})

$("jelszo2").addEventListener("input", function(){
    var password = $("password").value;
    var confirm_password = $("confirm_password").value;
    if(password == confirm_password && password.length >= 8)
    {
        $("span2").style.visibility = "visible";
        $("span2").style.backgroundColor = "lightgreen";
        $("span2").innerHTML = "Jelszavak egyeznek!";
    }
    else
    {
        $("span2").style.visibility = "visible";
        $("span2").style.backgroundColor = "#F9A5A5";
        $("span2").innerHTML = "Jelszavak nem egyeznek!";
    }
})