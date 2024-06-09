<?php
    class controller_cart {

        private $dao;
		private $db;
		static $_instance;
        
		function __construct() {
            $this->dao = cart_dao::getInstance();
            $this->db = db::getInstance();
		}

		public static function getInstance() {
            // echo self::$_instance;
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}


        function view() {
            // echo "Hola VIEW de controller_cart";
            common::load_view('top_page_cart.html', VIEW_PATH_CART . 'cart.html');
        }
// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function ListCart() {
            echo json_encode(common::load_model('cart_model', 'get_ListCart'));
        }

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function incrementarcantidad() {
            $ID_HomeDrop = $_POST['ID_HomeDrop'];
            echo json_encode(common::load_model('cart_model', 'incrementarCantidad', $ID_HomeDrop));
        }

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//     

        function disminuircantidad() {
            $ID_HomeDrop = $_POST['ID_HomeDrop'];
            echo json_encode(common::load_model('cart_model', 'get_disminuircantidad', $ID_HomeDrop));
        }

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function removefromcart() {
            $ID_HomeDrop = $_POST['ID_HomeDrop'];
            echo json_encode(common::load_model('cart_model', 'get_removefromcart', $ID_HomeDrop));
        }

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function processOrder() {
            $user_id = $_SESSION['ID_User'];
            $cart_items = common::load_model('cart_model', 'get_ListCart');

            if ($cart_items != 'NoHay') {
                $total_amount = 0;
                $order_items = array();

                foreach ($cart_items['UserCart'] as $item) {
                    $product_id = $item['ID_HomeDrop'];
                    $quantity = $item['Quantity'];
                    $price = $this->dao->getProductPrice($this->db, $product_id);

                    $total_amount += $price * $quantity;
                    $order_items[] = array(
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                        'price' => $price
                    );
                }

                $order_id = $this->dao->insertOrder($this->db, $user_id, $total_amount);

                foreach ($order_items as $item) {
                    $this->dao->insertOrderItem($this->db, $order_id, $item['product_id'], $item['quantity'], $item['price']);
                }

                $this->dao->clearCart($this->db, $user_id);

                echo json_encode(['success' => true, 'message' => 'Orden procesada correctamente', 'order_id' => $order_id]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No hay artículos en el carrito']);
            }
        }






// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

//         function MostVisited() {
//             echo json_encode(common::load_model('cart_model', 'get_MostVisited'));//✅✅✅
//         }
        
// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
    }
?>