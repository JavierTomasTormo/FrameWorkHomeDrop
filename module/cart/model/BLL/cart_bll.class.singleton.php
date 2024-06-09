<?php
	class cart_bll {
		private $dao;
		private $db;
		static $_instance;
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//

		function __construct() {
			$this -> dao = cart_dao::getInstance();
			$this -> db = db::getInstance();
		}

//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
        public function get_ListCart_BLL() {
            $user = $_SESSION['ID_User'];

            $casasAlistar = $this->dao->selectCartHomes($this->db, $user);

            if (is_array($casasAlistar) && !empty($casasAlistar)) {
                $casas = array(
                    "UserCart" => $casasAlistar,
                    "Matched" => $this->dao->selectMatchedHomes($this->db, $user),
                );
                return $casas;
            } else {
                return "NoHay";
            }
        }
// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
		public function incrementCartItemQuantity_BLL($ID_HomeDrop) {
			$currentQuantity = $this->dao->getCartItemQuantity($this->db, $ID_HomeDrop, $_SESSION['ID_User']);

			$availableStock = $this->dao->getHomeStock($this->db, $ID_HomeDrop);

			// return $availableStock[0]['stock'];
			// return $currentQuantity[0]['Quantity'];

			if ($currentQuantity[0]['Quantity'] < $availableStock[0]['stock']) {
				$newQuantity = $currentQuantity[0]['Quantity'] + 1;

				$this->dao->updateCartItemQuantity($this->db, $ID_HomeDrop, $_SESSION['ID_User'], $newQuantity);

				return array('success' => true, 'message' => 'Cantidad actualizada correctamente');
			} else {
				return array('success' => false, 'message' => 'No hay suficiente stock disponible');
			}
		}

// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
		public function get_disminuircantidad_BLL($ID_HomeDrop) {
			$currentQuantity = $this->dao->getCartItemQuantity($this->db, $ID_HomeDrop, $_SESSION['ID_User']);
			$newQuantity = $currentQuantity[0]['Quantity'] - 1;

			if ($newQuantity <= 0) {
				$this->dao->deleteCartItem($this->db, $ID_HomeDrop, $_SESSION['ID_User']);

				return array('success' => true, 'message' => '0, Eliminado');
			} else {
			
				$this->dao->updateCartItemQuantity($this->db, $ID_HomeDrop, $_SESSION['ID_User'], $newQuantity);

				return array('success' => true, 'message' => 'Cantidad actualizada correctamente');
			}

		}
// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
        public function get_removefromcart_BLL($ID_HomeDrop) {
			$this->dao->deleteCartItem($this->db, $ID_HomeDrop, $_SESSION['ID_User']);

			return array('success' => true, 'message' => '0, Eliminado');
        }
// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
		public function processOrder_BLL() {
			$controller = controller_cart::getInstance();
			return $controller->processOrder();
		}
// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
//         public function get_showLastSelectedHouseInfo_BLL($lastSelectedHouses) {
//             //return "Hello";
//             //return $lastSelectedHouses;
//             return $this -> dao -> SelectLastHouse($this -> db, $lastSelectedHouses);
//         }
// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//

	}
//----//
?>