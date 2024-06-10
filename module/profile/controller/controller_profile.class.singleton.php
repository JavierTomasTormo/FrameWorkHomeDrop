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

        function getUserOrders() {
            $user_id = $_SESSION['ID_User'];
            $orders = common::load_model('profile_model', 'get_user_orders', $user_id);
            echo json_encode($orders);
        }

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function generateQR() {
            $order_id = $_POST['order_id'];
            $pdf_url = "http://localhost/FrameWorkHomeDrop/uploads/factura_orden_" . $order_id . ".pdf";

            require_once UTILS . 'generate_qr.inc.php';
            $qr_generator = new QRCodeGenerator();

            $qr_file_path = RESOURCES . "qr_codes/qr_order_" . $order_id . ".png";

            if (!is_writable(dirname($qr_file_path))) {
                $response = array(
                    'success' => false,
                    'error' => 'El directorio de destino no tiene permisos de escritura.'
                );
                echo json_encode($response);
                return;
            }

            $qr_file = $qr_generator->generate($pdf_url, $qr_file_path);

            if ($qr_file === false) {
                $response = array(
                    'success' => false,
                    'error' => 'Error al generar la imagen QR. Verifique los registros de errores para más detalles.'
                );
                echo json_encode($response);
                return;
            }

            $response = array(
                'success' => true,
                'qr_url' => SITE_PATH . "resources/qr_codes/qr_order_" . $order_id . ".png"
            );
            echo json_encode($response);
        }

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