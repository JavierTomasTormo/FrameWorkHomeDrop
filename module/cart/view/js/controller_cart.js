//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
function ListCart() {
    // console.log('ListCart');
    ajaxPromise(friendlyURL('?module=cart&op=ListCart'), 'POST', 'JSON')
        .then(function (data) {

            // console.log(data);


            if (data == "NoHay") {
                $('.cart-items').empty();

                console.log('No hay datos');

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
function ButtonProcreedToPay() {
    $(document).on('click', '#ProcreedToPay', function () {
        console.log("ProcreedToPay");
    });
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
$(document).ready(function () {
    ListCart();
    ButtonProcreedToPay();
    // console.info("ready CART");

});
