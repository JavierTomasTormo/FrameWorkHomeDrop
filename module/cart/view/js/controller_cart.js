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
                console.log('Hay datos');

                const cartContainer = document.getElementById('cart-items');
                const totalPriceElement = document.getElementById('total');
                let totalPrice = 0;

                console.log(data);

                userCart.forEach(cartItem => {
                    const matchedItem = matched.find(item => item.ID_HomeDrop === cartItem.ID_HomeDrop);
                    if (matchedItem) {
                        const itemTotalPrice = parseFloat(matchedItem.Precio) * parseInt(cartItem.Quantity);
                        totalPrice += itemTotalPrice;
            
                        const cartItemElement = document.createElement('div');
                        cartItemElement.classList.add('cart-item');
            
                        cartItemElement.innerHTML = `
                            <div class="cart-item-details">
                                <p><strong>Ciudad:</strong> ${matchedItem.Ciudad}</p>
                                <p><strong>Calle:</strong> ${matchedItem.Calle}</p>
                                <p><strong>Superficie:</strong> ${matchedItem.Superficie} m²</p>
                            </div>
                            <div class="cart-item-price">
                                <p><strong>Precio:</strong> €${parseFloat(matchedItem.Precio).toFixed(2)}</p>
                            </div>
                            <div class="cart-item-quantity">
                                <p><strong>Cantidad:</strong> ${cartItem.Quantity}</p>
                            </div>
                            <div class="cart-item-total">
                                <p><strong>Total:</strong> €${itemTotalPrice.toFixed(2)}</p>
                            </div>
                        `;
            
                        cartContainer.appendChild(cartItemElement);
                    }
                });
            
                totalPriceElement.textContent = `€${totalPrice.toFixed(2)}`;
            
            }


        }).catch(function (error) {
            console.error('Error  '+error);
        });
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//


$(document).ready(function () {
    ListCart();
    // console.info("ready CART");

});