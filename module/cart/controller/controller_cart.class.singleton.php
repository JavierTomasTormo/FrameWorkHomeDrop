<?php
    class controller_cart {

        private $dao;
		private $db;
		static $_instance;
        
		function __construct() {
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

//         function showLastSelectedHouseInfo() {
//             echo json_encode(common::load_model('cart_model', 'get_showLastSelectedHouseInfo', $_GET['data'])); //✅✅✅
//         }

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

//         function MostVisited() {
//             echo json_encode(common::load_model('cart_model', 'get_MostVisited'));//✅✅✅
//         }
        
// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
    }
?>