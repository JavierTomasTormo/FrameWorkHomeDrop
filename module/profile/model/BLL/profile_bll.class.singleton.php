<?php
	class profile_bll {
		private $dao;
		private $db;
		static $_instance;
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//

		function __construct() {
			$this -> dao = profile_dao::getInstance();
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
		public function get_UserData_BLL() {
			return $this->dao->get_UserData($this->db);
		}

// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
		// public function incrementprofileItemQuantity_BLL($ID_HomeDrop) {
		// 	$currentQuantity = $this->dao->getprofileItemQuantity($this->db, $ID_HomeDrop, $_SESSION['ID_User']);

		// 	$availableStock = $this->dao->getHomeStock($this->db, $ID_HomeDrop);

		// 	// return $availableStock[0]['stock'];
		// 	// return $currentQuantity[0]['Quantity'];

		// 	if ($currentQuantity[0]['Quantity'] < $availableStock[0]['stock']) {
		// 		$newQuantity = $currentQuantity[0]['Quantity'] + 1;

		// 		$this->dao->updateprofileItemQuantity($this->db, $ID_HomeDrop, $_SESSION['ID_User'], $newQuantity);

		// 		return array('success' => true, 'message' => 'Cantidad actualizada correctamente');
		// 	} else {
		// 		return array('success' => false, 'message' => 'No hay suficiente stock disponible');
		// 	}
		// }

// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
		// public function get_disminuircantidad_BLL($ID_HomeDrop) {
		// 	$currentQuantity = $this->dao->getprofileItemQuantity($this->db, $ID_HomeDrop, $_SESSION['ID_User']);
		// 	$newQuantity = $currentQuantity[0]['Quantity'] - 1;

		// 	if ($newQuantity <= 0) {
		// 		$this->dao->deleteprofileItem($this->db, $ID_HomeDrop, $_SESSION['ID_User']);

		// 		return array('success' => true, 'message' => '0, Eliminado');
		// 	} else {
			
		// 		$this->dao->updateprofileItemQuantity($this->db, $ID_HomeDrop, $_SESSION['ID_User'], $newQuantity);

		// 		return array('success' => true, 'message' => 'Cantidad actualizada correctamente');
		// 	}

		// }
// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
        public function get_user_orders_BLL($ID_User) {

			return $this->dao->get_user_orders($this->db, $ID_User);
        }
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
		public function getOrderDetails($order_id) {
			return $this->dao->getOrderDetails($this->db, $order_id);
		}
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
        public function getOrderItems($order_id) {

            return $this->dao->getOrderItems($this->db, $order_id);
        }
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//

	}
//----//
?>