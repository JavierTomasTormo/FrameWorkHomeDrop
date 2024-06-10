//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
function UserProfile() {
    ajaxPromise(friendlyURL('?module=profile&op=getUserData'), 'GET', 'JSON')
    .then(function(userData) {
        
        // console.log(userData);

        var profileHeader = $('<div class="profile-header"></div>');
        var profilePic = $('<img>').attr('src', userData[0].Avatar).attr('alt', 'Foto de Perfil');
        var userInfo = $('<div class="user-info"></div>');
        var userName = $('<h2></h2>').text(userData[0].Username);
        var userUsername = $('<p></p>').text('@' + userData[0].Username);
        var userEmail = $('<p></p>').text(userData[0].Email);

        userInfo.append(userName, userUsername, userEmail);
        profileHeader.append(profilePic, userInfo);

        var profileStats = $('<div class="profile-stats"></div>');
        var postStats = $('<div></div>');
        var postCount = $('<p></p>').text(0);
        postStats.append($('<h3>Publicaciones</h3>'), postCount);

        var followerStats = $('<div></div>');
        var LikesCount = $('<p></p>').text(userData[0].Likes);
        followerStats.append($('<h3>Likes</h3>'), LikesCount);

        var followingStats = $('<div></div>');
        var followingCount = $('<p></p>').text(userData.followingCount);
        followingStats.append($('<h3>Proximamente...</h3>'), followingCount);

        profileStats.append(postStats, followerStats, followingStats);

        var lastSelectedHouses = JSON.parse(localStorage.getItem("lastHousesInfo")) || [];

        // console.log(lastSelectedHouses);

        var recentActivities = $('<div class="profile-activities"></div>');
        var activitiesHeading = $('<h3>Actividades Recientes</h3>');
        var activitiesList = $('<ul></ul>');

            lastSelectedHouses.forEach(function (house) {
                var listItem = $('<li></li>').text(`Casa visitada: #${house.Calle}, ${house.Ciudad}, ${house.Precio}`);
                activitiesList.append(listItem);
            });

        recentActivities.append(activitiesHeading, activitiesList);


            var TitleSettings = $('<h3>Cambiar Contraseña</h3>');
            var SettingsButton = $('<button>Cambiar</button>');

            var profileSettingsContainer = $('<div class="profile-settings"></div>');
            var passwordSettingsContainer = $('<div></div>');
            var privacySettingsContainer = $('<div></div>');
            var notificationsSettingsContainer = $('<div></div>');

            passwordSettingsContainer.append(TitleSettings, SettingsButton);
            privacySettingsContainer.append($('<h3>Configuración de Privacidad</h3>'), $('<button>Configurar</button>'));
            notificationsSettingsContainer.append($('<h3>Notificaciones</h3>'), $('<button>Configurar</button>'));

            profileSettingsContainer.append(passwordSettingsContainer, privacySettingsContainer, notificationsSettingsContainer);


        $('.containerProfile').append(profileHeader, profileStats, profileSettingsContainer, recentActivities);//


    })
    .catch(function(error) {
        console.error('Error al obtener los datos del usuario:', error);
    });
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//

//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//

function Buttons() {
/*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
$(document).on('click', '#generateInvoicePDF', function() {
    var orderId = $(this).data('order-id');
    generateInvoicePDF(orderId);
});

/*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
//         $(document).on('click', '.remove-item', function () {
//             var ID_HomeDrop = this.id.replace('remove-item-', '');

//             console.log(ID_HomeDrop);

//             $.ajax({
//                 url: 'index.php?module=cart&op=removefromcart',
//                 type: 'POST',
//                 data: { ID_HomeDrop: ID_HomeDrop },
//                 dataType: 'json',
//                 success: function(response) {
//                     // console.log(response);
//                     // console.log(response['success']);

//                     if (response['success'] == true) {
//                         location.reload();
//                     } else {
//                         toastr.error("Error en el proceso");
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     console.error(error);
//                 }
//             });
//         });
//     /*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
//         $(document).on('click', '.Button-min', function () {
//             var ID_HomeDrop = this.id.replace('Button-min-', '');

//             console.log(ID_HomeDrop);

//             $.ajax({
//                 url: 'index.php?module=cart&op=disminuircantidad',
//                 type: 'POST',
//                 data: { ID_HomeDrop: ID_HomeDrop },
//                 dataType: 'json',
//                 success: function(response) {
//                     // console.log(response);
//                     // console.log(response['success']);

//                     if (response['success'] == true) {
//                         location.reload();
//                     } else {
//                         toastr.error("Error en el proceso");
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     console.error(error);
//                 }
//             });
            
//         });
//     /*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
//         $(document).on('click', '.Button-max', function () {
//             var ID_HomeDrop = this.id.replace('Button-max-', '');
//             // console.log(ID_HomeDrop);
//             // console.log("Mas");
//             $.ajax({
//                 url: 'index.php?module=cart&op=incrementarcantidad',
//                 type: 'POST',
//                 data: { ID_HomeDrop: ID_HomeDrop },
//                 dataType: 'json',
//                 success: function(response) {
//                     // console.log(response);
//                     // console.log(response['success']);
//                     if (response['success'] == true) {
//                         location.reload();
//                     } else {
//                         toastr.error("Error,No queda Stock");
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     console.error(error);
//                 }
//             });
//         });
// /*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
function generateInvoicePDF(orderId) {
    $.ajax({
        url: friendlyURL('?module=profile&op=generateInvoicePDF'),
        type: 'POST',
        data: { order_id: orderId },
        dataType: 'json',
        success: function(response) {
            console.log(response);

            if (response.success) {
                window.open(response.pdf_url, '_blank');
            } else {
                console.error('Error al generar la factura response:', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al generar la factura:', error);
            console.error(xhr.responseText);
        }
    });
}


//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
$(document).ready(function () {
    UserProfile();
    Buttons();
    // console.info("ready Profile JS");
});
