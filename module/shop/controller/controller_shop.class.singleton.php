<?php
    class controller_shop {

        private $dao;
		private $db;
		static $_instance;

		function __construct() {
		}

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}


        function view() {
            // echo "Hola VIEW de controller Shop !!";
            common::load_view('top_page_shop.html', VIEW_PATH_SHOP . 'shop.html');
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function ajaxForSearch() {
            // echo json_encode("✅ ajaxForSearch ✅");
            // echo json_encode($_POST['filter']);
            echo json_encode(common::load_model('shop_model', 'get_ajaxForSearch', $_POST['filter']));  
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
        //
        function updateResultsCount() {
            // echo json_encode("updateResultsCount");
            echo json_encode(common::load_model('shop_model', 'get_updateResultsCount', $_POST['FiltersShopCount']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//     

        function cargarFiltrosShop() {
            // echo json_encode("cargarFiltrosShop");
            echo json_encode(common::load_model('shop_model', 'get_cargarFiltrosShop', $_POST['data']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function LoadSearch() {
            // echo json_encode("✅ LoadSearch ✅");
            echo json_encode(common::load_model('shop_model', 'get_LoadSearch', $_POST['FiltersSearch']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function LoadJump() {
            // echo json_encode("✅ LoadJump ✅");
            echo json_encode(common::load_model('shop_model', 'get_LoadJump',[$_POST['FiltersHome'], $_POST['start'], $_POST['limit']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function UserLikes() {
            // echo json_encode("✅ UserLikes ✅");
            // echo json_encode([$_POST['ID_HomeDropLike'], $_POST['token']]);
            echo json_encode(common::load_model('shop_model', 'get_UserLikes', [$_POST['ID_HomeDropLike'], $_POST['token']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function clicks() {
            // echo json_encode("✅ clicks ✅");
            // echo json_encode($_POST['id']);
            echo json_encode(common::load_model('shop_model', 'get_clicks', $_POST['id']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function loadDetails() {
            // echo json_encode("✅ loadDetails ✅");
            echo json_encode(common::load_model('shop_model', 'get_loadDetails', $_POST['id']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function Pagination() {
            // echo json_encode("✅ Pagination ✅");
            // echo json_encode($_POST['data']);
            echo json_encode(common::load_model('shop_model', 'get_Pagination', $_POST['data']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function MasCasasRelacionadas() {
            // echo json_encode("✅ MasCasasRelacionadas ✅");
            echo json_encode(common::load_model('shop_model', 'get_MasCasasRelacionadas',[$_POST['Category'], $_POST['Ciudad'], $_POST['ID_HomeDrop']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function ViviendasRelacionadas() {
            // echo json_encode("✅ ViviendasRelacionadas ✅");
            echo json_encode(common::load_model('shop_model', 'get_ViviendasRelacionadas',[$_POST['CategoryVivRel'], $_POST['CiudadVivRel'], $_POST['ID_HomeDrop'], $_POST['loaded'], $_POST['items']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function CountLikes() {
            // echo json_encode("✅ CountLikes ✅");
            // echo json_encode($_POST['ID_HomeDropLike']);
            
            echo json_encode(common::load_model('shop_model', 'get_CountLikes', $_POST['ID_HomeDropLike']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function Like() {
            // echo json_encode("✅ CountLikes ✅");
            // echo json_encode($_POST['ID_HomeDropLike']);
            
            echo json_encode(common::load_model('shop_model', 'get_Like', [$_POST['ID_HomeDropLike'], $_POST['token']]));
        }
        function DisLike() {
            // echo json_encode("✅ CountLikes ✅");
            // echo json_encode($_POST['ID_HomeDropLike']);
            
            echo json_encode(common::load_model('shop_model', 'get_DisLike', [$_POST['ID_HomeDropLike'], $_POST['token']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
    }
?>