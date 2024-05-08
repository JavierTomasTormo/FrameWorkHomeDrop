<?php
    class controller_shop {
        function view() {
            echo "Hola VIEW de controller Shop !!";
            //common::load_view('top_page_shop.html', VIEW_PATH_SHOP . 'shop.html');
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function ButtonFilterShop() {
            echo json_encode("✅ ButtonFilterShop ✅");
            // echo json_encode(common::load_model('home_model', 'get_CarouselImages'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function updateResultsCount() {
            echo json_encode("updateResultsCount");
            // echo json_encode(common::load_model('home_model', 'get_CategoryCharger'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//     

        function cargarFiltrosShop() {
            echo json_encode("cargarFiltrosShop");
            // echo json_encode(common::load_model('home_model', 'get_CityCharger'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function ShopAllHome() {
            echo json_encode("✅ ShopAllHome ✅");
            // echo json_encode(common::load_model('home_model', 'get_OperationCharger'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function LoadSearch() {
            echo json_encode("✅ LoadSearch ✅");
            // echo json_encode(common::load_model('home_model', 'get_showLastSelectedHouseInfo', $_GET['data']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function LoadJump() {
            echo json_encode("✅ LoadJump ✅");
            // echo json_encode(common::load_model('home_model', 'get_MostVisited'));
        }
        
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function LoadHomeDropShop() {
            echo json_encode("✅ LoadHomeDropShop ✅");
            // echo json_encode(common::load_model('home_model', 'get_MostVisited'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function CountLikes() {
            echo json_encode("✅ CountLikes ✅");
            // echo json_encode(common::load_model('home_model', 'get_MostVisited'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function loadDetails() {
            echo json_encode("✅ loadDetails ✅");
            // echo json_encode(common::load_model('home_model', 'get_MostVisited'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function Pagination() {
            echo json_encode("✅ Pagination ✅");
            // echo json_encode(common::load_model('home_model', 'get_MostVisited'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function MasCasasRelacionadas() {
            echo json_encode("✅ MasCasasRelacionadas ✅");
            // echo json_encode(common::load_model('home_model', 'get_MostVisited'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function ViviendasRelacionadas() {
            echo json_encode("✅ ViviendasRelacionadas ✅");
            // echo json_encode(common::load_model('home_model', 'get_MostVisited'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
    }
?>