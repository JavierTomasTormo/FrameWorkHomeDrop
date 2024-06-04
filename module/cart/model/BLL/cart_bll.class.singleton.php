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
// 		public function get_CategoryCharger_BLL() {
// 			return $this -> dao -> SelectCategory($this -> db);
// 		}
// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
// 		public function get_CityCharger_BLL() {
// 			return $this -> dao -> SelectCity($this -> db);
// 		}
// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
//         public function get_OperationCharger_BLL() {
//             return $this -> dao -> SelectOperation($this -> db);
//         }
// //,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
//         public function get_MostVisited_BLL() {
//             return $this -> dao -> MostVisited($this -> db);
//         }
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