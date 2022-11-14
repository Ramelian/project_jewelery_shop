const sign_in = document.querySelector(".section-login__buttons-signin");
const register = document.querySelector(".section-login__buttons-register");
const background = document.querySelector(".section-login__buttons-background");
const slider_line = document.querySelector(".slider-line");

register.onclick = function(){
    background.classList.add("active");
    slider_line.style.transform = "translateX(0)";
}

sign_in.onclick = function(){
    background.classList.remove("active");
    slider_line.style.transform = "translateX(-50%)";
}

// Validating forms 
function validateFormRegister(){
    let submit = true;

    document.querySelectorAll(".error").forEach(function(e){
        e.textContent = "";
    }) 

    if(!validateEmail(document.forms["register_form"]["email"]))
        submit = false;

    if(!validateName(document.forms["register_form"]["first_name"]))
        submit = false;

    if(!validateName(document.forms["register_form"]["last_name"]))
        submit = false;

    if(!validatePassword(document.forms["register_form"]["password"]))
        submit = false;

    if(!validateIfEmpty(register_form))
        submit = false;

    if(submit) return true;
    else return false;
};

function validateFormLogin(){
    let submit = true;

    document.querySelectorAll(".error").forEach(function(e){
        e.textContent = "";
    })

    if(!validateEmail(document.forms["login_form"]["email"]))
        submit = false;

    if(!validateIfEmpty(login_form))
        submit = false;

    if(submit) return true;
    else return false;
};
// !Validating forms

// Create new customer and add to database
$(".register-form__button").click(() =>{
    if(validateFormRegister()){
        $(document).ready(function(){
        var data = {
            first_name: $(".register__first_name").val(),
            last_name: $(".register__last_name").val(),
            display_name: $(".register__first_name").val(),
            email: $(".register__email").val(),
            password: $(".register__password").val(),
            action: "register",
        };

        $.ajax({
            url: 'method__login-register.php',
            type: 'post',
            data: data,
            success:function(response){
            if(response === "Email Has Already Taken")
                $(".error.error_text.email").text(response)

            if(response === "Registration Successful")
                window.location.reload();
            }
        });
        });
    }
  });

$(".login-form__button").click(() =>{
if(validateFormLogin()){
    $(document).ready(function(){
    var data = {
        email: $(".login__email").val(),
        password: $(".login__password").val(),
        action: "login",
    };

    $.ajax({
        url: 'method__login-register.php',
        type: 'post',
        data: data,
        success: function(response){
            if(response === "Customer with this email doesn't exist")
                $(".error.error_text.email_login").text(response)

            if(response === "Incorrect password")
                $(".error.error_text.password").text(response)

            if(response === "Successful login"){
                window.location.href = "index.php";
            }            
        }
    });
    });
}
});
// !Create new customer and add to database