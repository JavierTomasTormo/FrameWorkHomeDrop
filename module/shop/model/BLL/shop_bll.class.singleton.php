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
			// return $args;
			if (array_key_exists('DAORed', $args)) {
				$DAORed = $args['DAORed'];
				$start = $args['start'] ?? 0;
				$limit = $args['limit'] ?? 3;

				if ($DAORed == "FiltersShop") {
					$consulta = "";

					for ($i = 0; $i < count($args['FiltersShop']); $i++) {
						if ($args['FiltersShop'][$i][0] === 'vh.Precio') {
							$consulta .= " AND vh.Precio BETWEEN {$args['FiltersShop'][$i][1]}";
	
						} elseif ($args['FiltersShop'][$i][0] === 'OrderBy') {
							$consulta .= " GROUP BY vh.ID_HomeDrop";
							$consulta .= " ORDER BY vh.Precio {$args['FiltersShop'][$i][1]}";
						} else {
							$consulta .= " AND {$args['FiltersShop'][$i][0]} = {$args['FiltersShop'][$i][1]}";
						}
					}
	
					$consulta .= " LIMIT $start, $limit";

					// return $consulta;

					return $this -> dao -> Filters_Shop($this->db, $consulta);
				} 


				if ($DAORed == "FiltersHome") {
					$consulta = "";

					$filtroArrayhme = json_decode($args['FiltersHome'], true);
					//$filtroArrayhme = $filtrosPag;

					if (!empty($filtroArrayhme[0]['ID_Type'])) {
						$prueba = $filtroArrayhme[0]['ID_Type'][0];
						$consulta .= " AND th.ID_Type = '$prueba'";
					}
					if (!empty($filtroArrayhme[0]['Ciudad'])) {
						$prueba = $filtroArrayhme[0]['Ciudad'][0];
						$consulta .= " AND ch.Ciudad = '$prueba'";
					}
					if (!empty($filtroArrayhme[0]['ID_Operation'])) {
						$prueba = $filtroArrayhme[0]['ID_Operation'][0];
						$consulta .= " AND oh.ID_Operation = '$prueba'";
					}
					if (!empty($filtroArrayhme[0]['ID_Category'])) {
						$prueba = $filtroArrayhme[0]['ID_Category'][0];
						$consulta .= " AND chd.ID_Category = '$prueba'";
					}
		
					$consulta .= " LIMIT $start, $limit";

					return $this -> dao -> Filters_Home($this->db, $consulta);
				} 


				if ($DAORed == "AllHomes") {

					return $this -> dao -> SelectAllHomes($this->db, $args['OrderBy'],$start, $limit);

				}


				if ($DAORed == "RedirectSearch") {
					$consulta = "";

					$filtroArray = json_decode($args['FiltersSearch'], true); 

					//return $filtroArray[0]['complete'][0];

						foreach ($filtroArray as $filtro) {

							if (isset($filtro['Ciudad']) && $filtro['Ciudad'][0] != 0) {
								$consulta .= " AND ch.ID_City = '" . $filtro['Ciudad'][0] . "'";
							}

							if (isset($filtro['Operacion']) && $filtro['Operacion'][0] != 0) {
								$consulta .= " AND oh.ID_Operation = '" . $filtro['Operacion'][0] . "'";
							}

							if (isset($filtro['complete']) && $filtro['complete'][0] != 0) {
								$complete = $filtro['complete'][0]; 
								$consulta .= " AND th.Type LIKE '$complete%'";
							}
						}
					

					//return $select;


					$consulta.= " GROUP BY vh.ID_HomeDrop";

					$consulta .= " LIMIT $start, $limit";

					return $this -> dao -> RedirectSearch($this->db, $consulta);
				}
			} else {
				echo "La clave 'DAORed' no existe en el array.";
			}
			
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
		public function get_MasCasasRelacionadas_BLL($args) {
			return $this -> dao -> CountRelatedHomes($this->db, $args[0], $args[1], $args[2]);
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//		
		public function get_ViviendasRelacionadas_BLL($args) {
			return $this -> dao -> ViviendasRelacionadas($this->db, $args[0], $args[1], $args[2], $args[3], $args[4]);
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_updateResultsCount_BLL($args) {
			// return $args;

			$consulta = "";
			if ($args['Category'] != 0){
				$consulta .= " AND vc.ID_Category = " . $args['Category'];
			}
			if ($args['City'] != 0){
				$consulta .= " AND ch.ID_City = " . $args['City'];
			}
			if ($args['Operation'] != 0){
				$consulta .= " AND oh.ID_Operation = " . $args['Operation'];
			}
			if ($args['Type'] != 0){
				$consulta .= " AND th.ID_Type = " . $args['Type'];
			}
			if ($args['Pricemax'] != 0 && $args['Pricemin'] != 0){
				$consulta .= " AND vh.Precio BETWEEN {$args['Pricemin']} AND {$args['Pricemax']}";
			}

			// return $consulta;

			return $this -> dao -> CountFilteredQueryShop($this->db, $consulta);
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_cargarFiltrosShop_BLL($data) {

			if ($data === "City") {
				return $this -> dao -> SelectCity($this->db, $data);

			} else if ($data === "Category") {
				return $this -> dao -> SelectCategory($this->db, $data);
			
			} else {
				return "Error en el divisor del BLL";
			}
			
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_LoadSearch_BLL($FiltersSearch) {
			// return $args
		
			$select = "";

			for ($i = 0; $i < count($FiltersSearch); $i++) {
				$filter = $FiltersSearch[$i];
			
				if (!empty($filter)) {
					foreach ($filter as $key => $value) {
						switch ($key) {
							case 'Ciudad':
								$ciudad = $value[0];
								$select .= " AND ch.ID_City = '$ciudad'";
								break;
							case 'Operacion':
								$operacion = $value[0];
								$select .= " AND oh.ID_Operation = '$operacion'";
								break;
							case 'complete':
								$complete = $value[0];
								$select .= " AND th.Type LIKE '$complete%'";
								break;

						}
					}
				}
			}

			$select.= " GROUP BY vh.ID_HomeDrop";

			return $this -> dao -> RedirectSearchDAO($this->db, $select);
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_Pagination_BLL($args) {
			// return $args;

			if (array_key_exists('DisCountSel', $args)) {

				$DisCountSel = $args['DisCountSel'];

				if ($DisCountSel == "CountFiltShop") {
					$consulta = "";

					for ($i = 0; $i < count($args['FiltersShopCount']); $i++) {
						if ($args['FiltersShopCount'][$i][0] === 'vh.Precio') {
							$consulta .= " AND vh.Precio BETWEEN {$args['FiltersShopCount'][$i][1]}";
		
						} elseif ($args['FiltersShopCount'][$i][0] === 'OrderBy') {
		
							$consulta .= " ORDER BY vh.Precio {$args['FiltersShopCount'][$i][1]}";
		
						} else {
							$consulta .= " AND {$args['FiltersShopCount'][$i][0]} = {$args['FiltersShopCount'][$i][1]}";
						}
					}

					return $this -> dao -> CountFiltShop($this->db, $consulta);
				} 
				if ($DisCountSel == "CountHomeFilt") {
					$consulta = "";
					
					$filtroArrayhme = json_decode($args['filtrosPag'], true);
					// return $filtroArrayhme;

					if (!empty($filtroArrayhme[0]['ID_Type'])) {
						$prueba = $filtroArrayhme[0]['ID_Type'][0];
						$consulta .= " AND th.ID_Type = '$prueba'";
					}
					if (!empty($filtroArrayhme[0]['Ciudad'])) {
						$prueba = $filtroArrayhme[0]['Ciudad'][0];
						$consulta .= " AND ch.Ciudad = '$prueba'";
					}
					if (!empty($filtroArrayhme[0]['ID_Operation'])) {
						$prueba = $filtroArrayhme[0]['ID_Operation'][0];
						$consulta .= " AND oh.ID_Operation = '$prueba'";
					}
					if (!empty($filtroArrayhme[0]['ID_Category'])) {
						$prueba = $filtroArrayhme[0]['ID_Category'][0];
						$consulta .= " AND chd.ID_Category = '$prueba'";
					}
				
					return $this->dao->CountHomeFilt($this->db, $consulta);
				}				
				if ($DisCountSel == "CountSearchFilt") {
					$consulta = "";

					$filtroArray = json_decode($args['flitroSearchPag'], true); 

					//return $filtroArray[0]['complete'][0];

					foreach ($filtroArray as $filtro) {

						if (isset($filtro['Ciudad']) && $filtro['Ciudad'][0] != 0) {
							$consulta .= " AND ch.ID_City = '" . $filtro['Ciudad'][0] . "'";
						}

						if (isset($filtro['Operacion']) && $filtro['Operacion'][0] != 0) {
							$consulta .= " AND oh.ID_Operation = '" . $filtro['Operacion'][0] . "'";
						}

						if (isset($filtro['complete']) && $filtro['complete'][0] != 0) {
							$complete = $filtro['complete'][0]; 
							$consulta .= " AND th.Type LIKE '$complete%'";
						}
					}

					return $this -> dao -> CountSearchFilt($this->db, $consulta);

				}
				if ($DisCountSel == "CountGeneral") {
					return $this -> dao -> CountGeneral($this->db);

				}
			} else {
				echo "La clave 'DAORed' no existe en el array.";
			}
			
			// return $this -> dao -> select_details_images($this->db, $args);
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_CountLikes_BLL($ID_HomeDropLike) {
			return $this -> dao -> CountLikes($this->db, $ID_HomeDropLike);
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_UserLikes_BLL($ID_HomeDropLike, $token) {

			$decode = middleware::decode_username($token);

			
			$count = $this -> dao -> UserLikes($this->db, $ID_HomeDropLike, $decode);

			// return $count;

			if (!empty($count)) {
				return "Like";
			}
			else {
				return "NoLike";
			}
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_Like_BLL($ID_HomeDropLike, $token) {

			$decode = middleware::decode_username($token);

			
			return $this -> dao -> Likes($this->db, $ID_HomeDropLike, $decode);

		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_DisLike_BLL($ID_HomeDropLike, $token) {

			$decode = middleware::decode_username($token);

			
			return $this -> dao -> Dislikes($this->db, $ID_HomeDropLike, $decode);

		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
		public function get_addToCart_BLL($ID_HomeDrop) {

			$ID_User = $_SESSION['ID_User'];

			$existingRecord = $this->dao->checkCartRecord($this->db, $ID_HomeDrop, $ID_User);

			if ($existingRecord) {
				$this->dao->incrementCartQuantity($this->db, $ID_HomeDrop, $ID_User);
			} else {
				$this->dao->addToCart($this->db, $ID_HomeDrop, $ID_User);
			}
		
			return "Producto agregado al carrito correctamente";
		}
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
	}
?>