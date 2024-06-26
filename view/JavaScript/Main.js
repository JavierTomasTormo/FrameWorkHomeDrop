// ================AJAX-PROMISE================ //
function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData,
            beforeSend: function() {
                $("#overlay").fadeIn(300);
            }
        }).done((data) => {
            setTimeout(function() {
                $("#overlay").fadeOut(300);
            }, 500);
            resolve(data)

        }).fail((jqXHR, textStatus, errorThrow) => {
            reject(errorThrow);
        });
    });
}
//--------------------------------------------//
//================Friendly-URL================//
function friendlyURL(url) {
    var link = "";
    url = url.replace("?", "");
    url = url.split("&");
    cont = 0;
    for (var i = 0; i < url.length; i++) {
    	cont++;
        var aux = url[i].split("=");
        if (cont == 2) {
        	link += "/" + aux[1] + "/";	
        }else{
        	link += "/" + aux[1];
        }
    }
    return "http://localhost/FrameWorkHomeDrop" + link;
}
//--------------------------------------------//
//================LOAD-HEADER================//
function LoadMenu() {
    var token = localStorage.getItem('token');
    var navbarContenido = `
        <nav class="navbar navbar-inverse navbar-fixed-top navbar-hidden">
            <ul class="inline navbar-header">    
                <li><a href="` + friendlyURL('index.php?module=home') + `" style="text-decoration: none; " class="activate-filter-remove"><h2 class="texto-dorado-nav"> H&#920;M&#926;DR&#920;P</h2></a></li>
                <li class="FiltrosShopFloat" style="padding: 10px;"></li>
            </ul>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav search_container" style="float: right; margin-right: 5%; min-width: 55%;">
                    <li><a href="` + friendlyURL('index.php?module=home') + `" id="home">HOME</a></li>
                    <li><a href="` + friendlyURL('index.php?module=shop') + `" id="shop">SHOP</a></li>
                    <li class="inline"><select class="search_selectCity"></select></li>
                    <li><select class="search_selectOperation"></select></li>
                    <li>
                        <input type="text" id="autocom" autocomplete="off" placeholder="Buscar..." class="search-input">
                        <button class="search-button" id="search-btn"><i class="fa fa-search"></i></button>
                        <div id="search_auto" class="search_auto"></div>
                    </li>
                    <li id="userSection" style="display: none;"></li>
                    <li class="opc_CRUD"></li>
                    <li class="opc_exceptions"></li>
                    <li class="log-icon"></li>
                    <li id="des_inf_user"></li>
                    <li><a href="` + friendlyURL('index.php?module=login&op=view') +`" id="loginBtn">Register/LogIn</a></li>
                </ul>
            </div>
        </nav>
    `;
    document.getElementById("navbarContainer").innerHTML = navbarContenido;


    if (token) {
        ajaxPromise(friendlyURL('?module=login&op=DataUser'), 'POST', 'JSON', { 'token': token })
            .then(function(data) {
                $('#loginBtn').hide();

                // console.log(data);
                // console.log(data[0].Username);

                if (data[0].UserType == "client") {
                    console.log("Client loged");
                    $('.opc_CRUD').empty();
                    $('.opc_exceptions').empty();

                } else if (data[0].UserType == "admin") {
                    console.log("Admin loged");
                    $('.opc_CRUD').show();
                    $('.opc_exceptions').show();
                }

                var userData = JSON.parse(localStorage.getItem("loggedInUser"));

                // console.log(userData);
                

                if (userData) {
                    $('#loginBtn').hide();
                
                    var userAvatar = $("<img>")
                        .attr({
                            id: "userAvatar",
                            src: userData.Avatar,
                            alt: "Avatar",
                            width: 60,
                            height: 60,
                            // maxWidth: 50
                        });
                
                    var usernameSpan = $("<span></span>")
                        .attr("id", "username")
                        .text(userData.username);
                
                    var userMenu = $('<div id="user_menu" style="display: none;">' +
                                        '<button id="close_menu_button"><i class="fa-solid fa-xmark" style="color: #ffffff;"></i></button><br/>' +
                                        '<button id="cart_button"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg></button>' +
                                        
                                        '<button id="logout_button">Logout</button>' +
                                        '<a href="' + friendlyURL('index.php?module=profile') + '"><button id="profile_button"><b> Profile </b></button></a>' +
                                    '</div>');
                
                    var table = $('<table style="width: 100%;"></table>');
                    var trAvatar = $('<tr></tr>').appendTo(table);
                    var trButtons = $('<tr></tr>').appendTo(table);
                
                    var tdAvatar = $('<td style="vertical-align: top;"></td>').appendTo(trAvatar);
                    var tdUserInfo = $('<td style="vertical-align: top; text-align: right;"></td>').appendTo(trAvatar);
                    var tdButtons = $('<td colspan="2" style="text-align: right;"></td>').appendTo(trButtons);
                
                    tdAvatar.append(userAvatar);
                    tdUserInfo.append(usernameSpan);
                    tdButtons.append(userMenu);
                
                    $('#userSection').append(table);
                
                    $('#userSection').css({
                        "display": "flex",
                        "background-color": "#d5b568",
                        "border-radius": "5px",
                        "padding": "10px"
                    });
                
                    $('#username').css({
                        "color": "black",
                        "font-weight": "800"
                    });

                    $('#user_menu button').css({
                        "background-color": "#4d4d4d",
                        "border": "none",
                        "color": "white",
                        "padding": "10px 20px",
                        "text-align": "center",
                        "text-decoration": "none",
                        "display": "inline-block",
                        "font-size": "16px",
                        "margin": "4px 2px",
                        "cursor": "pointer",
                        "border-radius": "5px"
                    });
                    
                    $('#user_menu button:hover').css({
                        "background-color": "#fff"
                    });
                    
                    var menuOpen = 0; 
                    
                    $('#userSection').on('click', function() { 
                        //console.log(menuOpen);

                        if (menuOpen === 0) { 
                            $('#user_menu').show();

                        } if (menuOpen === 1) {
                            $('#user_menu').hide(); 
                            menuOpen = 0;

                        }
                    }); 
                    $('#cart_button').on('click', function() { 
                        window.location.href = friendlyURL('?module=cart');
                    });
                    
                    $('#close_menu_button').on('click', function() {
                        $('#profile_button').html('¡¡ <b> Liked </b>!!'); 
                        $('#profile_button').removeAttr('disabled');
                        $('#profile_button').removeClass('liked'); 
                        
                        
                        menuOpen = 1;
                        // viviendasMenu.empty();
                    });
                    
                    
                } else {
                    $('#userSection').hide();
                }

            }).catch(function() {
                console.log("Error al cargar los datos del usuario");
            });
    }
}
//--------------------------------------------//
//================CLICK-LOGOUT================//
function ClickLogOut() {
    $(document).on('click', '#logout_button', function() {
        

        localStorage.removeItem("loggedInUser");
        localStorage.removeItem('token');

        toastr.success("Logout succesfully");

        setTimeout( 
            LogOut()
        , 1000);
    });
}
//--------------------------------------------//
//================LOG-OUT================//
function LogOut() {
    console.log('logout');
    ajaxPromise(friendlyURL('?module=login&op=LogOut'), 'POST', 'JSON')//LogOut
        .then(function(data) {

            console.log(data);

            localStorage.removeItem('token');
            window.location.href = friendlyURL('?module=home');
        }).catch(function() {
            console.error('Something wrong has occured');
        });
}
//--------------------------------------------//
//================Pagination_DataRemove================//
function ClickShop() {
    $(document).on('click', '#shop', function() {
        localStorage.removeItem('currentPageId');
        localStorage.removeItem('move');
    });
}
//--------------------------------------------//
//================LoadContent================//
function load_content() {
    let path = window.location.pathname.split('/');

    //Para debug de esto entrar en el gmail link creo que es el Path[4]
    // console.log(path);
    // console.log(path[4]);
    
    if (path[4] === 'recover') {
        var token_email = path[5];
        var token_email_recover  = localStorage.getItem('token_email');
        var tokenURL = path[5];
        var email_actual = localStorage.getItem('email_actual');
       

        // console.log(token_email);

        ajaxPromise(friendlyURL("?module=login&op=JWT_Caduco"), 'POST', 'JSON', {email_actual: email_actual})//LogOut
        .then(function(data) {
            // console.log(token_email_recover);
            // console.log(tokenURL);
            // console.log(email_actual);
            // console.log(data);

            if( data == 'token_caducado'){
                toastr.error("Token inválido");
                setTimeout(function() {
                    window.location.href = friendlyURL("?module=login&op=view");
                }, 2000)
            } else {
                if (tokenURL === token_email_recover) {
                    window.location.href = friendlyURL("?module=login&op=recover_view");
                } else {
                    toastr.error("Token inválido");
                    setTimeout(function() {
                        window.location.href = friendlyURL("?module=login&op=view");
                    }, 2000)
                }
            }

        }).catch(function(error) {
            console.log('Error: verify email error'+error);
        });   

    } else if (path[4] === 'verify') {
        // console.log('Path===verify');
        toastr.options.timeOut = 3000;
        var token_email = path[5];
        
        // console.log(token_email);
        ajaxPromise(friendlyURL("?module=login&op=verify_email"), 'POST', 'JSON', {token_email: token_email})
        .then(function(data) {
            // console.log(data);
            if (data == 'token_caducado') {
                window.location.href = '/FrameWorkHomeDrop/view/inc/token_expired.html?token_email=' + token_email;
            } else {
                window.location.href = friendlyURL("?module=home");
                localStorage.setItem('tokenready', 1);
            }
        }).catch(function() {
          console.log('Error: verify email error');
        });
    }else if (path[3] === 'view') {
        $(".login-wrap").show();
        $(".forget_html").hide();
        $(".center-container").hide();

    } else if (path[3] === 'recover_view') {
        // console.log('Path===recover_view');
        load_form_new_password();
    }
}
/*~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~*/
                                // ------------------- Recover Password PASSWORD ------------------------ //
/*~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~*/
function load_form_recover_password(){
    // console.log('load_form_recover_password');
    $(".login-wrap").hide();
    $(".forget_html").show();
    $(".center-container").show();
    $('html, body').animate({scrollTop: $(".forget_html")});
    click_recover_password();
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function click_recover_password(){
    $(".button_recover").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
        	e.preventDefault();
            send_recover_password();
        }
    });

    $('#button_recover').on('click', function(e) {
        e.preventDefault();
        send_recover_password();
    }); 
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function validate_recover_password(){
    var mail_exp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var error = false;

    // console.log('validate_recover_password');

    if (document.getElementById('email_recover_input').value.length === 0) {
        document.getElementById('error_email_forg').innerHTML = "Tienes que escribir un correo";
        error = true;
    } else {
        if (!mail_exp.test(document.getElementById('email_recover_input').value)) {
            document.getElementById('error_email_forg').innerHTML = "El formato del mail es invalido";
            error = true;
        } else {
            document.getElementById('error_email_forg').innerHTML = "";
        }
    }

    if (error == true) {
        return 0;
    }
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function send_recover_password(){
    // console.log('send_recover_password');

    if(validate_recover_password() != 0){
        // console.log('recover_password validado');
    
        const data = document.getElementById('email_recover_input').value;
    
        // console.log('Correo electrónio:', data);
        localStorage.setItem('email_actual', data);

        $.ajax({
            url: friendlyURL('?module=login&op=send_recover_email'),
            dataType: 'JSON',
            type: "POST",
            data: { 'data' : data }
        }).done(function(data) {

            // console.log(data);

            if(data == "error"){		
                $("#error_email_forg").html("The email doesn't exist");
            } else {
                toastr.options.timeOut = 3000;
                toastr.success("Email sended");

                localStorage.setItem('token_email', [data]);

                setTimeout('window.location.href = friendlyURL("?module=login&op=view")', 500);

            }
        }).fail(function( textStatus ) {
            console.log('Error: Recover password error', textStatus);
        });    
    }
}
/*~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~*/
                                // ------------------- Update new PASSWORD ------------------------ //
/*~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~·~*/
function load_form_new_password(){
    token_email = localStorage.getItem('token_email');
    localStorage.removeItem('token_email');

    email_actual = localStorage.getItem('email_actual');
    localStorage.removeItem('email_actual');
    // console.log('token_email', token_email);

    if (email_actual != null) {
        click_new_password(email_actual); 
    } else{
        toastr.error("Token inválido");
        setTimeout(function() {
            window.location.href = friendlyURL("?module=login&op=view");
        }, 2000)
    } 
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function click_new_password(email_actual){
    $(".recover_html").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
        	e.preventDefault();
            send_new_password(email_actual);
        }
    });

    $('#button_set_pass').on('click', function(e) {
        e.preventDefault();
        send_new_password(email_actual);
    }); 
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function validate_new_password(){
    var error = false;

    if(document.getElementById('pass_rec').value.length === 0){
		document.getElementById('error_password_rec').innerHTML = "You have to write a password";
		error = true;
	}else{
        if(document.getElementById('pass_rec').value.length < 8){
            document.getElementById('error_password_rec').innerHTML = "The password must be longer than 8 characters";
            error = true;
        }else{
            document.getElementById('error_password_rec').innerHTML = "";
        }
    }

    if(document.getElementById('pass_rec_2').value != document.getElementById('pass_rec').value){
		document.getElementById('error_password_rec_2').innerHTML = "Passwords don't match";
		error = true;
	}else{
        document.getElementById('error_password_rec_2').innerHTML = "";
    }

    if(error == true){
        return 0;
    }
}
/*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*/
function send_new_password(email_actual){
    // console.log('send_new_password');
    if(validate_new_password() != 0){
        // console.log('new_password validado');

        var data = {email_actual: email_actual, password : $('#pass_rec').val()};
        // var data = { [email_actual]: $('#pass_rec').val() };

        // console.log('data', data);
        
        ajaxPromise(friendlyURL("?module=login&op=new_password"), 'POST', 'JSON', {'data' : data})
            .then(function(data) {
                console.log(data);
        
                if (data === "done") {
                    toastr.options.timeOut = 3000;
                    toastr.success('Contraseña Actualizada');
                    setTimeout(function() {
                        window.location.href = friendlyURL("?module=login&op=view");
                    }, 2000);
                } else {
                    toastr.options.timeOut = 3000;
                    toastr.error('Error al introducir la nueva contraseña');
                }
            })
            .catch(function(error) {
                console.log("Error: New password error" + error);
            });
        
    }
}
//--------------------------------------------//
//================DocReady================//
$(document).ready(function() {

    var tokenready = localStorage.getItem('tokenready');

    if (tokenready == 1) {
        toastr.success('Email verified');
        localStorage.setItem('tokenready', 0);
    }

    LoadMenu();
    ClickLogOut();
    ClickShop();
    load_content();
});
//--------------------------------------------//


