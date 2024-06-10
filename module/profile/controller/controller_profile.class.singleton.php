<?php
    class controller_profile {

        private $dao;
		private $db;
		static $_instance;
        
		function __construct() {
            $this->dao = profile_dao::getInstance();
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
            // echo "Hola VIEW de controller_profile";
            common::load_view('top_page_profile.html', VIEW_PATH_PROFILE . 'profile.html');
        }
// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function getUserData() {
            echo json_encode(common::load_model('profile_model', 'get_UserData'));
        }

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

function generateInvoicePDF() {
    if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
        $orderId = $_POST['order_id'];
        $order = common::load_model('profile_model', 'getOrderDetails', $orderId);
        $orderItems = common::load_model('profile_model', 'getOrderItems', $orderId);

        if (!empty($order) && !empty($orderItems)) {
            $data = [
                'order' => $order[0],
                'order_items' => $orderItems
            ];

            require_once(SITE_ROOT . 'utils/tcpdf.inc.php');
            $pdf = new PDF();
            $pdfFilePath = $pdf->generatePDF($data);

            if ($pdfFilePath) {
                $pdfUrl = SITE_PATH . str_replace(SITE_ROOT, '', $pdfFilePath);
                echo json_encode(['success' => true, 'pdf_url' => $pdfUrl]);
            } else {
                echo json_encode(['error' => 'Error al generar el PDF']);
            }
        } else {
            echo json_encode(['error' => 'No se encontraron datos de la orden']);
        }
    } else {
        echo json_encode(['error' => 'ID de orden no proporcionado']);
    }
}






// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//     

        // function disminuircantidad() {
        //     $ID_HomeDrop = $_POST['ID_HomeDrop'];
        //     echo json_encode(common::load_model('profile_model', 'get_disminuircantidad', $ID_HomeDrop));
        // }

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        // function removefromprofile() {
        //     $ID_HomeDrop = $_POST['ID_HomeDrop'];
        //     echo json_encode(common::load_model('profile_model', 'get_removefromprofile', $ID_HomeDrop));
        // }

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        // function processOrder() {
        //     $user_id = $_SESSION['ID_User'];
        //     $profile_items = common::load_model('profile_model', 'get_Listprofile');

        //     if ($profile_items != 'NoHay') {
        //         $total_amount = 0;
        //         $order_items = array();

        //         foreach ($profile_items['Userprofile'] as $item) {
        //             $product_id = $item['ID_HomeDrop'];
        //             $quantity = $item['Quantity'];
        //             $price = $this->dao->getProductPrice($this->db, $product_id);

        //             $total_amount += $price * $quantity;
        //             $order_items[] = array(
        //                 'product_id' => $product_id,
        //                 'quantity' => $quantity,
        //                 'price' => $price
        //             );
        //         }

        //         $order_id = $this->dao->insertOrder($this->db, $user_id, $total_amount);

        //         foreach ($order_items as $item) {
        //             $this->dao->insertOrderItem($this->db, $order_id, $item['product_id'], $item['quantity'], $item['price']);
        //         }

        //         $this->dao->clearprofile($this->db, $user_id);

        //         echo json_encode(['success' => true, 'message' => 'Orden procesada correctamente', 'order_id' => $order_id]);
        //     } else {
        //         echo json_encode(['success' => false, 'message' => 'No hay artículos en el carrito']);
        //     }
        // }






// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

//         function MostVisited() {
//             echo json_encode(common::load_model('profile_model', 'get_MostVisited'));//✅✅✅
//         }
        
// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
    }
?>