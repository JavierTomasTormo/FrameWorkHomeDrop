<?php
    class controller_shop {
        function view() {
            // echo "Hola VIEW de controller Shop !!";
            common::load_view('top_page_shop.html', VIEW_PATH_SHOP . 'shop.html');
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function ajaxForSearch() {
            echo json_encode("✅ ajaxForSearch ✅");
            // echo json_encode(common::load_model('shop_model', 'get_ajaxForSearch',[$_POST['url2'], $_POST['type'], $_POST['dataType'], $_POST['filter']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
        //
        function updateResultsCount() {
            echo json_encode("updateResultsCount");
            // echo json_encode(common::load_model('shop_model', 'get_updateResultsCount', [$_POST['FiltersShopCount']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//     

        function cargarFiltrosShop() {
            echo json_encode("cargarFiltrosShop");
            // echo json_encode(common::load_model('shop_model', 'get_cargarFiltrosShop'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function clicks() {
            echo json_encode("✅ clicks ✅");
            // echo json_encode(common::load_model('shop_model', 'get_clicks', $_GET['id']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function LoadSearch() {
            echo json_encode("✅ LoadSearch ✅");
            // echo json_encode(common::load_model('shop_model', 'get_LoadSearch', [$_POST['FiltersSearch']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function LoadJump() {
            echo json_encode("✅ LoadJump ✅");
            // echo json_encode(common::load_model('shop_model', 'get_LoadJump',[$_POST['FiltersHome'], $_POST['start'], $_POST['limit']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        // function CountLikes() {
        //     echo json_encode("✅ CountLikes ✅");
        //     // echo json_encode(common::load_model('shop_model', 'get_MostVisited'));
        // }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function loadDetails() {
            echo json_encode("✅ loadDetails ✅");
            // echo json_encode(common::load_model('shop_model', 'get_loadDetails', $_GET['id']));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function Pagination() {
            echo json_encode("✅ Pagination ✅");
            // echo json_encode(common::load_model('shop_model', 'get_Pagination'));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function MasCasasRelacionadas() {
            echo json_encode("✅ MasCasasRelacionadas ✅");
            // echo json_encode(common::load_model('shop_model', 'get_MasCasasRelacionadas',[$_POST['Category'], $_POST['Ciudad'], $_POST['ID_HomeDrop']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function ViviendasRelacionadas() {
            echo json_encode("✅ ViviendasRelacionadas ✅");
            // echo json_encode(common::load_model('shop_model', 'get_ViviendasRelacionadas',[$_POST['CategoryVivRel'], $_POST['CiudadVivRel'], $_POST['ID_HomeDrop'], $_POST['loaded'], $_POST['items']]));
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
    }
?>