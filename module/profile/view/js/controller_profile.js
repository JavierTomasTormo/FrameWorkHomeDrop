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
        var followingCount = $('<p></p>').text(0);
        followingStats.append($('<h3>Seguidores</h3>'), followingCount);

        profileStats.append(postStats, followerStats, followingStats);

        var lastSelectedHouses = JSON.parse(localStorage.getItem("lastHousesInfo")) || [];

        // console.log(lastSelectedHouses);



        var recentActivities = $('<div class="profile-activities"></div>');
        var activitiesHeading = $('<h3 class="recent-activities-heading">Actividades Recientes</h3>');
        var activitiesList = $('<div class="recent-activities-list"></div>');
        
        lastSelectedHouses.forEach(function (house) {
            var listItem = $('<div class="recent-activity-item"></div>');
            var houseInfo = $('<span></span>').text(`  Casa visitada: #${house.Calle}, ${house.Ciudad}, ${house.Precio} €`);
            var activityIcon = $('<i class="fa-solid fa-house-chimney"></i>');
        
            listItem.append(activityIcon, houseInfo);
            activitiesList.append(listItem);
            activitiesList.append($('<div class="activity-item-spacer"></div>'));
        });
        
        recentActivities.append(activitiesHeading, activitiesList);
        



        var InvoicesUser = $('<div class="profile-Invoices"></div>');
        var InvoicesHeading = $('<h3>Facturas de ' + userData[0].Username + '</h3>');
        var InvoicesList = $('<ul></ul>');
        
            ajaxPromise(friendlyURL('index.php?module=profile&op=getUserOrders'), 'GET', 'JSON')
                .then(function (orders) {

                    // console.log(orders);

                    orders.forEach(function(order) {
                        var listItem = $('<li></li>').text(`Orden #${order.ID_Order},    Total: ${order.Total_Amount} €,    Fecha: ${order.Order_Date}`);
                        
                        var pdfButton = $('<button>', {
                            'class': 'generate-pdf btn btn-primary',
                            'data-order-id': order.ID_Order,
                            'html': '<i class="fa-solid fa-file-pdf" style="color: #ff0000;"></i>'
                        }).css({
                            'float': 'right',
                            'marginLeft': '10px'
                        });

                        var QRButton = $('<button>', {
                            'class': 'generate-qr btn btn-primary',
                            'data-order-id': order.ID_Order,
                            'html': '<i class="fa-solid fa-qrcode" style="color: #000000;"></i>'
                            //<i class="fa-solid fa-qrcode"></i>//<i class="fas fa-qrcode"></i>//<i class="fa fa-qrcode" aria-hidden="true"></i>
                        }).css({
                            'float': 'right',
                            'marginLeft': '10px'
                        });
                    
                        listItem.append(pdfButton,QRButton);
                        InvoicesList.append(listItem);
                    });
            
                    InvoicesUser.append(InvoicesHeading, InvoicesList);

            }).catch(function (error) {
                    console.error('Error al obtener las órdenes del usuario:', error);
            });
            


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


        $('.containerProfile').append(profileHeader, profileStats, InvoicesUser,profileSettingsContainer, recentActivities);//


    })
    .catch(function(error) {
        console.error('Error al obtener los datos del usuario:', error);
    });
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//

//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//

function Buttons() {
/*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
    $(document).on('click', '.generate-pdf', function() {
        var orderId = $(this).data('order-id');
        // console.log(orderId);
        generateInvoicePDF(orderId);
    });
    //  comentario del sistemas (Alejandro)
    $(document).on('click', '.generate-qr', function() {
        var orderId = $(this).data('order-id');
        // console.log('generate-qr  '+ orderId);
        generateQR(orderId);
    });

/*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
}

//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//

function generateInvoicePDF(orderId) {
    // console.log(orderId);
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

function generateQR(orderId) {
    $.ajax({
        url: friendlyURL('?module=profile&op=generateQR'),
        type: 'POST',
        data: { order_id: orderId },
        dataType: 'json',
        success: function(response) {
            console.log(response);

            if (response.success) {
                window.open(response.qr_url, '_blank');
            } else {
                console.error('Error al generar el código QR:', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al generar el código QR:', error);
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
