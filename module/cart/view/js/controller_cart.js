//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
function ListCart() {
    // console.log('ListCart');
    ajaxPromise(friendlyURL('?module=cart&op=ListCart'), 'POST', 'JSON')
        .then(function (data) {

            if (data == "NoHay") {
                $('.cart-items').empty();

                // console.log('No hay datos');

                $('<div></div>')
                   .attr('class', 'NoHay')
                   .appendTo('.cart-items')
                   .html(
                        "<div class='overlayCity'>" +
                            "<p>No tienes viviendas en el carrito.</p>" +
                            "<a href='" + friendlyURL('?module=shop') + "'>Ir a la tienda</a>" +
                        "</div>"
                     );

            } else {
                const cartContainer = document.getElementById('cart-items');
                const cartSummaryItemsContainer = document.getElementById('cart-summary-items');
                const totalPriceElement = document.getElementById('total');
                let totalPrice = 0;

                const streetSums = {};

                // console.log(data);

                data['UserCart'].forEach(cartItem => {
                    const matchedItem = data['Matched'].find(item => item.ID_HomeDrop === cartItem.ID_HomeDrop);
                    if (matchedItem) {
                        const itemTotalPrice = parseFloat(matchedItem.Precio) * parseInt(cartItem.Quantity);
                        totalPrice += itemTotalPrice;

                            const street = matchedItem.Calle;
                            if (streetSums[street]) {
                                streetSums[street] += itemTotalPrice;
                            } else {
                                streetSums[street] = itemTotalPrice;
                            }
                
                        const cartItemElement = document.createElement('div');
                        cartItemElement.classList.add('cart-item');
                
                        cartItemElement.innerHTML = `
                                <div class="cart-item-image">
                                    <img src="${matchedItem.Img}" alt="Imagen del producto">
                                    <p><strong>Visitas:</strong> ${matchedItem.vivistas}</p>
                                    
                                </div>
                                
                                <div class="cart-item-general">
                                    <p><strong>Categoría:</strong> ${matchedItem.Category}</p>
                                    <p><strong>Operación:</strong> ${matchedItem.Operation}</p>
                                    <p><strong>Tipo:</strong> ${matchedItem.Type}</p>
                                </div>
                                <div class="cart-item-details">                                 
                                    <p><strong>Ciudad:</strong> ${matchedItem.Ciudad}</p>
                                    <p><strong>Calle:</strong> ${matchedItem.Calle}</p>
                                    <p><strong>Superficie:</strong> ${matchedItem.Superficie} m²</p>
                                    
                                </div>
                                <div class="cart-item-price-container">

                                    <div class="cart-item-price">
                                        <p><strong>Precio:</strong><br>${parseFloat(matchedItem.Precio).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}€</p>
                                    </div>

                                    <div class="cart-item-quantity">
                                        <p><strong>Cantidad:</strong><br>${cartItem.Quantity}</p>
                                    </div>

                                    <div class="cart-item-total">
                                        <p><strong>Total:</strong><br>${itemTotalPrice.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}€</p>
                                    </div>
                                </div>
                                <div class="cart-item-remove">
                                    <p class="remove-item" id="${cartItem.ID_HomeDrop}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                        </svg>
                                    </p>
                                </div>
                                <div class="Button-min" id="${cartItem.ID_HomeDrop}">
                                    <p class="minus-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ff1a1a" d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM152 232H296c13.3 0 24 10.7 24 24s-10.7 24-24 24H152c-13.3 0-24-10.7-24-24s10.7-24 24-24z"/></svg>
                                    </p>
                                </div>
                                <div class="Button-max" id="${cartItem.ID_HomeDrop}">
                                    <p class="plus-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#1aff47" d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
                                    </p>
                                </div>

                        `;
                        // console.log(matchedItem);
                
                        cartContainer.appendChild(cartItemElement);
                    }
                });
    
                // totalPriceElement.textContent = `€${totalPrice.toFixed(2)}`;//suma las cantidades pero lo esta haciendo mal
                Object.entries(streetSums).forEach(([street, sum]) => {
                    const summaryItemElement = document.createElement('div');
                    summaryItemElement.classList.add('summary-item');
                    summaryItemElement.innerHTML = `
                        <span>${street}:</span>
                        <hr>
                        <span>${sum.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}€</span>
                    `;
                    cartSummaryItemsContainer.appendChild(summaryItemElement);
                });

                totalPriceElement.textContent = `${totalPrice.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}€`;
                // totalPriceElement.textContent = `${totalPrice.toFixed(2)}€`;
            }

        }).catch(function (error) {
            console.error('Error  '+error);
        });
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//ProcreedToPay
function Buttons() {
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
        $(document).on('click', '#ProcreedToPay', function () {
            // console.log("ProcreedToPay");
            $.ajax({
                url: friendlyURL('?module=cart&op=processOrder'),
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {

                    // console.log(response);

                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    console.error(xhr.responseText);
                    console.error(status);
                }
            });
        });
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
        $(document).on('click', '.remove-item', function () {
            var ID_HomeDrop = this.id.replace('remove-item-', '');

            console.log(ID_HomeDrop);

            $.ajax({
                url: 'index.php?module=cart&op=removefromcart',
                type: 'POST',
                data: { ID_HomeDrop: ID_HomeDrop },
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    // console.log(response['success']);

                    if (response['success'] == true) {
                        location.reload();
                    } else {
                        toastr.error("Error en el proceso");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
        $(document).on('click', '.Button-min', function () {
            var ID_HomeDrop = this.id.replace('Button-min-', '');

            console.log(ID_HomeDrop);

            $.ajax({
                url: 'index.php?module=cart&op=disminuircantidad',
                type: 'POST',
                data: { ID_HomeDrop: ID_HomeDrop },
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    // console.log(response['success']);

                    if (response['success'] == true) {
                        location.reload();
                    } else {
                        toastr.error("Error en el proceso");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            
        });
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
        $(document).on('click', '.Button-max', function () {
            var ID_HomeDrop = this.id.replace('Button-max-', '');
            // console.log(ID_HomeDrop);
            // console.log("Mas");
            $.ajax({
                url: 'index.php?module=cart&op=incrementarcantidad',
                type: 'POST',
                data: { ID_HomeDrop: ID_HomeDrop },
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    // console.log(response['success']);
                    if (response['success'] == true) {
                        location.reload();
                    } else {
                        toastr.error("Error,No queda Stock");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*/
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
$(document).ready(function () {
    ListCart();
    Buttons();
    // console.info("ready CART");remove-item

});
