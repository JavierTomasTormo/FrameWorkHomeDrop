

/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function LogIn() {
    //console.log('LogIn');

    if (ValidateLogIn() != 0) {
        var formDataArray = $('#login__form').serializeArray();

        var formData = {};
        $.each(formDataArray, function(index, field){
            formData[field.name] = field.value;
        });

        // console.log(formData);
        // console.log(formData['passwd_log']);
        // console.log(formData['username_log']);


        ajaxPromise('Module/RegisterLogIn/ControladorRegLog/ControladorRegLog.php?Option=LogIn', 'POST', 'JSON', {'passwd_log': formData['passwd_log'], 'username_log': formData['username_log'] })
        .then(function(result) {
            console.log(result);

            if (result === "error_user") {
                document.getElementById('error_username_log').innerHTML = "Creemos que tu Usuario esta mal escrito o no existe";
            } else if (result === "error_passwd") {
                document.getElementById('error_passwd_log').innerHTML = "Escribe más despacio, la contraseña es errónea";
            } else {
                localStorage.setItem("token", result.token);
                toastr.success("Logged in successfully");
            
                // console.log(localStorage.getItem('token'));     
                // console.log("Token:", result.token);
                // console.log("Avatar:", result.user['Avatar']);
                // console.log("Username:", result.user['Username']);        
   

                localStorage.setItem("loggedInUser", JSON.stringify({
                    token: result.token,
                    avatar: result.user['Avatar'],
                    username: result.user['Username']
                }));


                setTimeout(function() {
                    window.location.href = "index.php?page=Controller_HomeDrop&Option=List";
                }, 1000);
            }
        })
        .catch(function(error) {
            console.error('Error:', error);
        });

    }
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function ValidateLogIn() {
    //console.log('ValidateLogIn');

    var error = false;

    if (document.getElementById('username_log').value.length === 0) {
        document.getElementById('error_username_log').innerHTML = "Hey, escribe tu nombre de usuario o ni ChatGPT sabrá quien eres!";
        error = true;
    } else {
        if (document.getElementById('username_log').value.length < 5) {
            document.getElementById('error_username_log').innerHTML = "Usuario no encontrado, debe contener 5 caracteres como mínimo";
            error = true;
        } else {
            document.getElementById('error_username_log').innerHTML = "";
        }
    }

    if (document.getElementById('passwd_log').value.length === 0) {
        document.getElementById('error_passwd_log').innerHTML = "Opss, al parecer no has escrito tu contraseña";
        error = true;
    } else {
        document.getElementById('error_passwd_log').innerHTML = "";
    }

    if (error == true) {
        return 0;
    }
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function KeyLogIn() {
    
    $("#login").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        //console.log('KeyLogIn Ready');

        if (code == 13) {
            e.preventDefault();
            LogIn();
        }
    });
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function ButtonLogIn() {
    
    $('#login').on('click', function(e) {
        //console.log('ButtonLogIn Ready');

        e.preventDefault();
        LogIn();
    });
}

/*~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~*/
/*~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~*/

function Register() {

    //console.log('Llego al Register function Register()');

    if (ValidateRegister() != 0) {
        var data = $('#register__form').serialize();

        var datadec = parseUrlEncodedData(data);

        function parseUrlEncodedData(data) {
            const decodedData = decodeURIComponent(data);
            const pairs = decodedData.split('&');
            const result = {};

            pairs.forEach((pair) => {
                const [key, value] = pair.split('=');
                result[key] = decodeURIComponent(value);
            });

            return result;
        }
        // console.log(datadec);
        ajaxPromise(friendlyURL('?module=login&op=register'), 'POST', 'JSON', {'data': datadec })
            .then(function(result) {

                console.log(result);

                if (result == "error_email") {
                    document.getElementById('error_email_reg').innerHTML = "El email ya esta en uso, si es tuyo ponte en contacto con nosotros por telepatía o por bizum ;-)";
                    toastr.error("La solicitud ha fallado: " + result);

                } else if (result == "error_user") {
                    document.getElementById('error_username_reg').innerHTML = "Llegaste tarde, otro usuario ya tiene este Nickname";
                    toastr.error("La solicitud ha fallado: " + result);

                } else if (result == "error") {
                    console.error("La solicitud ha fallado: " + result);
                    toastr.error("La solicitud ha fallado: " + result);
                    
                } else {
                    
                    location.reload();
                    localStorage.setItem('emailReg', 1);
                    
                    
                }


            }).catch(function(textStatus) {
                if (console && console.log) {
                    console.error("La solicitud ha fallado: " + textStatus);
                    toastr.error("La solicitud ha fallado: " + textStatus);
                }
            });
    }
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function showVerificationMessage() {
    console.log("El correo de verificación se ha enviado correctamente");
    toastr.success("El correo de verificación se ha enviado correctamente");
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function ValidateRegister() {

    //console.log('Llego al ValidateRegister');

    var username_exp = /^(?=.{5,}$)(?=.*[a-zA-Z0-9]).*$/;
    var mail_exp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var pssswd_exp = /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
    var error = false;

    if (document.getElementById('username_reg').value.length === 0) {
        document.getElementById('error_username_reg').innerHTML = "Si no escribes el nombre de usuario no sabremos como llamarte";
        error = true;

    } else {
        if (document.getElementById('username_reg').value.length < 5) {
            document.getElementById('error_username_reg').innerHTML = "Como capricho nuestro los usuarios deben tener mínimo 5 carácteres";
            error = true;

        } else {
            if (!username_exp.test(document.getElementById('username_reg').value)) {
                document.getElementById('error_username_reg').innerHTML = "Por la seguridad y la paz mundial no se permiten carácteres especiales";
                error = true;

            } else {
                document.getElementById('error_username_reg').innerHTML = "";
            }
        }
    }

    if (document.getElementById('email_reg').value.length === 0) {
        document.getElementById('error_email_reg').innerHTML = "Si no escribes un correo no podemos mandarte Spam";
        error = true;

    } else {
        if (!mail_exp.test(document.getElementById('email_reg').value)) {
            document.getElementById('error_email_reg').innerHTML = "Tu formato de email es un poco fakemail";
            error = true;

        } else {
            document.getElementById('error_email_reg').innerHTML = "";
        }
    }

    if (document.getElementById('passwd1_reg').value.length === 0) {
        document.getElementById('error_passwd1_reg').innerHTML = "Si no escribes una contraseña dejaremos tus datos al libre albedrío";
        error = true;

    } else {
        if (document.getElementById('passwd1_reg').value.length < 8) {
            document.getElementById('error_passwd1_reg').innerHTML = "Tony Stark dice que 8 carácteres es el mínimo seguro";
            error = true;

        } else {
            if (!pssswd_exp.test(document.getElementById('passwd1_reg').value)) {
                document.getElementById('error_passwd1_reg').innerHTML = "Debe de contener minimo 8 caracteres, mayusculas, minusculas y simbolos especiales y si quieres un Bizum ;-)";
                error = true;

            } else {
                document.getElementById('error_passwd1_reg').innerHTML = "";
            }
        }
    }

    if (document.getElementById('passwd2_reg').value.length === 0) {
        document.getElementById('error_passwd2_reg').innerHTML = "Como buen internauta Repitela muy despacio";
        error = true;

    } else {
        if (document.getElementById('passwd2_reg').value.length < 8) {
            document.getElementById('error_passwd2_reg').innerHTML = "si en una debías tener 8 carácteres que esperabas aquí?";
            error = true;

        } else {
            if (document.getElementById('passwd2_reg').value === document.getElementById('passwd1_reg').value) {
                document.getElementById('error_passwd2_reg').innerHTML = "";
            } else {
                document.getElementById('error_passwd2_reg').innerHTML = "No has escrito suficientemente despacio alguna de las contraseñas";
                error = true;
            }
        }
    }

    if (error == true) {
        return 0;
    }
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function KeyRegister() {

    $("#register").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            e.preventDefault();
            Register();
        }
    });
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function ButtonRegister() {

    $('#register').on('click', function(e) {
        e.preventDefault();
        Register();
    });
}

/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
$(document).ready(function() {
    // console.log('LogIn.js Document Ready');
    var emailReg = localStorage.getItem('emailReg');
    // console.log(emailReg);
    if (emailReg == 1) {
        showVerificationMessage();
        localStorage.setItem('emailReg', 0);
    }
    // console.log(emailReg);

    //LogIn
    KeyLogIn();
    ButtonLogIn();

    //Register
    KeyRegister();
    ButtonRegister();
});
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/