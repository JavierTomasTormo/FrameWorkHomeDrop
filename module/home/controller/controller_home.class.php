<?php
    class controller_home {
        function view() {
            // echo "Hola VIEW de controller_home";
            common::load_view('top_page_home.html', VIEW_PATH_HOME . 'home.html');
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function CarouselImages() {
            echo json_encode(common::load_model('home_model', 'get_CarouselImages'));//✅✅✅
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function CategoryCharger() {
            echo json_encode(common::load_model('home_model', 'get_CategoryCharger'));//✅✅✅
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//     

        function CityCharger() {
            echo json_encode(common::load_model('home_model', 'get_CityCharger'));//✅✅✅
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function OperationCharger() {
            echo json_encode(common::load_model('home_model', 'get_OperationCharger'));//✅✅✅
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function showLastSelectedHouseInfo() {
            echo json_encode(common::load_model('home_model', 'get_showLastSelectedHouseInfo', $_GET['data'])); //✅✅✅
        }

//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//

        function MostVisited() {
            echo json_encode(common::load_model('home_model', 'get_MostVisited'));//✅✅✅
        }
        
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
    }
?>