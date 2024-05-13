<?php
	class shop_bll {
		private $dao;
		private $db;
		static $_instance;

		function __construct() {
			$this -> dao = shop_dao::getInstance();
			$this -> db = db::getInstance();
		}

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_LoadJump_BLL($args) {
            // return $args[0];
            $select = "";

            if (!empty($args[0][0]['ID_Type'])){
				$prueba = $args[0][0]['ID_Type'][0];
				$select = " AND th.ID_Type = '$prueba'";
			}
			if(!empty($args[0][0]['Ciudad'])) {
				$prueba = $args[0][0]['Ciudad'][0];
				$select = " AND ch.Ciudad = '$prueba'";

			}
			if(!empty($args[0][0]['ID_Operation'])) {
				$prueba = $args[0][0]['ID_Operation'][0];
				$select = " AND oh.ID_Operation = '$prueba'";
			}
			if(!empty($args[0][0]['ID_Category'])) {
				$prueba = $args[0][0]['ID_Category'][0];
				$select = " AND chd.ID_Category = '$prueba'";
			}

            
            // return $args[0][0]['Ciudad'];

			$select .= " GROUP BY vh.ID_HomeDrop";
			
			$select .= " LIMIT $args[1], $args[2]";

            // return $select;

			return $this -> dao -> RedirectDAO($this->db, $select);//$args[0], $args[1], $args[2]
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_ajaxForSearch_BLL($args) {
			// return $this -> dao -> select_details_images($this->db, $args);
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_clicks_BLL($id) {
			return $this -> dao -> VisitasViviendas($this->db, $id);
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_loadDetails_BLL($id) {
			return $this -> dao -> SelectImagesHomes($this->db, $id);
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		// public function get_most_visit_BLL($args) {
		// 	return $this -> dao -> update_view($this->db, $args[0]);
		// }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//		
		// public function get_count_BLL() {
		// 	return $this -> dao -> select_count($this->db);
		// }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		// public function get_count_filters_BLL($args) {
		// 	return $this -> dao -> select_count_filters($this->db, json_decode($args));
		// }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		// public function get_cars_BLL($args) {
		// 	return $this -> dao -> select_cars($this->db, $args[0], $args[1], $args[2], $args[3], $args[4]);
		// }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		// public function get_load_likes_BLL($args) {

		// 	$token = explode('"', $args);
		// 	$decode = middleware::decode_username($token[1]);
		// 	return $this -> dao -> select_load_likes($this->db, $decode);
		// }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		// public function get_control_likes_BLL($args) {

		// 	$token = explode('"', $args[1]);
		// 	$decode = middleware::decode_username($token[1]);

		// 	if ($this -> dao -> select_likes($this->db, $args[0], $decode)) {
		// 		return $this -> dao -> delete_likes($this->db, $args[0], $decode);
		// 	}
		// 	return $this -> dao -> insert_likes($this->db, $args[0], $decode);
		// }
	}
?>