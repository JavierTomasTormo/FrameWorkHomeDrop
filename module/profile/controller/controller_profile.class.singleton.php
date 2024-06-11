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

// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

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

        function uploadProfileImage() {
            // echo json_encode('Hola desde el controlador de profile');

            if (isset($_FILES['profileImage'])) {
                $file = $_FILES['profileImage'];
                $uploadDir = RESOURCES . 'user_avatars/';
                $fileName = uniqid() . '_' . $file['name'];
                $uploadPath = $uploadDir . $fileName;

                $imgPath = '/FrameWorkHomeDrop/resources/user_avatars/'.$fileName;
                // echo json_encode(['file' => $file, 'upload_path' => $uploadPath]);
        
                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $userId = $_SESSION['ID_User'];
                    $result = common::load_model('profile_model', 'updateUserProfileImage', [$userId, $imgPath]);
                    echo json_encode($result);

                    if ($result) {
                        echo json_encode(['success' => true, 'message' => 'Imagen de perfil actualizada correctamente']);
                    } else {
                        echo json_encode(['error' => 'Error al actualizar la imagen de perfil']);
                    }
                } else {
                    echo json_encode(['error' => 'Error al subir el archivo']);
                }
            } else {
                echo json_encode(['error' => 'No se proporcionó ningún archivo']);
            }
        }
  
        
// //.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function LikedHouses() {
            // echo json_encode($_POST['Username']);
            echo json_encode(common::load_model('login_model', 'get_LikedHouses', $_POST['Username']));
        }









        
    }
?>