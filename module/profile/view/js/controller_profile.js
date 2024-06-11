//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
    function UserProfile() {
        ajaxPromise(friendlyURL('?module=profile&op=getUserData'), 'GET', 'JSON')
        .then(function(userData) {
            // console.log(userData);

            var userData3 = JSON.parse(localStorage.getItem("loggedInUser"));
            // console.log(userData3);
            userData3.Avatar = userData[0].Avatar;
            localStorage.setItem("loggedInUser", JSON.stringify(userData3));

            var profileHeader = $('<div class="profile-header"></div>');
            var profilePic = $('<img>').attr('src', userData[0].Avatar).attr('alt', 'Foto de Perfil');
            var userInfo = $('<div class="user-info"></div>');
            var userName = $('<h2></h2>').text(userData[0].Username);
            var userUsername = $('<p></p>').text('@' + userData[0].Username);
            var userEmail = $('<p></p>').text(userData[0].Email);



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

            userInfo.append(userName, userUsername, userEmail);
            profileHeader.append(profilePic, userInfo);







            var lastSelectedHouses = JSON.parse(localStorage.getItem("lastHousesInfo")) || [];

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
                


                var TitleSettings = $('<h3>DropZone Profile Img</h3>');
                var SettingsButton = $('<div id="dropzone-container" class="dropzone"></div>');
            
                // Create containers for different settings
                var profileSettingsContainer = $('<div class="profile-settings"></div>');
                var passwordSettingsContainer = $('<div></div>');
                var privacySettingsContainer = $('<div></div>');
            
                passwordSettingsContainer.append(TitleSettings, SettingsButton);
                privacySettingsContainer.append($('<h3>Tu lista de Deseos</h3><br/>'), $('<button class="'+userData[0].Username+'" id="LikeListButton">Likes</button>'));
            
                profileSettingsContainer.append(passwordSettingsContainer, privacySettingsContainer);
            
                $('.containerProfile').append(profileHeader, profileSettingsContainer,profileStats, InvoicesUser,  recentActivities);
            
                Dropzone.autoDiscover = false;

            var dropzone = new Dropzone('#dropzone-container', {
                url: friendlyURL('?module=profile&op=uploadProfileImage'),
                maxFiles: 1,
                acceptedFiles: 'image/*',
                dictDefaultMessage: 'Arrastra y suelta tu imagen de perfil aquí',
                addRemoveLinks: true, 
            });

            dropzone.on('success', function(file, response) {
                // console.log(file);
                if (file) {
                uploadProfileImage(file);
                }
            });
            dropzone.on('error', function(file, errorMessage) {
                console.error(errorMessage);
            });
            dropzone.on('removedfile', function(file) {
                console.log('Archivo eliminado:', file.name);
            });

        }).catch(function(error) {
            console.error('Error al obtener los datos del usuario:', error);
        });
    }
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
    function uploadProfileImage(file) {
        return new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('profileImage', file);
        
            $.ajax({
                url: friendlyURL('?module=profile&op=uploadProfileImage'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {

                    console.log(response);

                    if (response.success) {
                        console.log(response.message);
                        resolve(response);
                    } else {
                        console.error('Error al subir la imagen de perfil:', response.error);
                        reject(response.error);
                    }
                },error: function(xhr, status, error) {
                    console.error('Error catch:', error);
                    console.error(xhr.responseText);
                    reject(error);
                }
            });
        });
    }
  
  
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
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

    $(document).on('click', '#LikeListButton', function() {
        var data = $(this).attr('class');

        $.ajax({
            url: friendlyURL('?module=profile&op=LikedHouses'),
            type: 'POST',
            dataType: 'JSON',
            data: { Username: data }
        }).done(function(response) {

            console.log(response);

            var modalContent = '';

            if (response.length > 0) {
                $.each(response, function(index, vivienda) {
                    modalContent += '<div class="modal-house">';
                    modalContent += '<h4 class="modal-house-title">' + vivienda.Calle + '</h4>';
                    modalContent += '<div class="modal-house-details">';
                    modalContent += '<p><span class="modal-house-label">Category:</span> ' + vivienda.Category + '</p>';
                    modalContent += '<p><span class="modal-house-label">Ciudad:</span> ' + vivienda.Ciudad + '</p>';
                    modalContent += '<p><span class="modal-house-label">ID_HomeDrop:</span> ' + vivienda.ID_HomeDrop + '</p>';
                    modalContent += '<p><span class="modal-house-label">ID_Imagen:</span> ' + vivienda.ID_Imagen + '</p>';
                    modalContent += '<p><span class="modal-house-label">Operation:</span> ' + vivienda.Operation + '</p>';
                    modalContent += '<p><span class="modal-house-label">Precio:</span> ' + vivienda.Precio + '€</p>';
                    modalContent += '<p><span class="modal-house-label">Superficie:</span> ' + vivienda.Superficie + ' m²</p>';
                    modalContent += '<p><span class="modal-house-label">Type:</span> ' + vivienda.Type + '</p>';
                    modalContent += '</div>';
                    modalContent += '</div>';
                });
            } else {
                modalContent = '<p class="modal-no-houses">Aún no tienes viviendas con Likes</p>';
            }

            // Crear el modal
            var modal = '<div class="modal fade" tabindex="-1" role="dialog">';
            modal += '<div class="modal-dialog modal-lg" role="document">';
            modal += '<div class="modal-content">';
            modal += '<div class="modal-header">';
            modal += '<h5 class="modal-title">Viviendas con Like</h5>';
            modal += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            modal += '<span aria-hidden="true">&times;</span>';
            modal += '</button>';
            modal += '</div>';
            modal += '<div class="modal-body">' + modalContent + '</div>';
            modal += '</div>';
            modal += '</div>';
            modal += '</div>';

            // Agregar el modal al body
            $('body').append(modal);

            // Mostrar el modal
            $('.modal').modal('show');
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('Error al cargar la lista de viviendas:', errorThrown);
        });
    });



//------
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
