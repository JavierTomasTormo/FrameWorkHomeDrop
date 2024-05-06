<?php
    class controller_home {
        function view() {
            // echo "Hola VIEW de controller_home";
            common::load_view('top_page_home.html', VIEW_PATH_HOME . 'home.html');
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
        function CarouselImages() {
            echo "Hola CarouselImages de controller_home";
            // echo json_encode(common::load_model('home_model', 'get_carrusel'));
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
        function CategoryCharger() {
            echo "Hola CategoryCharger de controller_home";
            // echo json_encode(common::load_model('home_model', 'get_category'));
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//       
        function CityCharger() {
            echo "Hola CityCharger de controller_home";
            // echo json_encode(common::load_model('home_model', 'get_type'));
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
        function OperationCharger() {
            echo "Hola OperationCharger de controller_home";
            // echo json_encode(common::load_model('home_model', 'get_type'));
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
        function showLastSelectedHouseInfo() {
            echo "Hola showLastSelectedHouseInfo de controller_home";
            // echo json_encode(common::load_model('home_model', 'get_type'));
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
        function MostVisited() {
            echo "Hola MostVisited de controller_home";
            // echo json_encode(common::load_model('home_model', 'get_type'));
        }
//.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.+.//
    }
?>