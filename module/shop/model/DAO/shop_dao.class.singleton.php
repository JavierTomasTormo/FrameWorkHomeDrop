<?php
    class shop_dao {
        static $_instance;
        
        private function __construct() {
        }
        
        public static function getInstance() {
            if(!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#//
        
        public function RedirectDAO($db, $select) {
            // return $FiltersHome;

            $sql = "SELECT vh.ID_HomeDrop, vh.Precio, vh.Superficie, ch.ID_City ,ch.Ciudad, vh.Calle, th.ID_Type ,th.Type, oh.ID_Operation ,oh.Operation, ih.ID_Imagen, ih.ID_HomeDrop, ih.Img, chd.Category, chd.ID_Category
                    FROM viviendashomedrop vh
                    LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City
                    LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop
                    LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type
                    LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop
                    LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation
                    LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop
                    LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop 
                    LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category 
                    WHERE vh.ID_HomeDrop IS NOT NULL";

            $sql.= $select;

            // return $sql;

            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#//

        public function VisitasViviendas($db, $id) {//VisitasViviendas
            // return $id;

            $sql = "UPDATE viviendashomedrop SET vivistas = vivistas + 1 WHERE ID_HomeDrop = $id";

            // return $sql;

            $db->ejecutar($sql);
            // return $db->listar($stmt);
        }
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#//

        function SelectOneHome($db, $id){

            $sql = "SELECT vh.ID_HomeDrop, vh.Precio, vh.Superficie, ch.Ciudad, vh.Calle, th.Type, oh.Operation, ih.ID_Imagen, chd.Category, vh.lat, vh.lon
                    FROM viviendashomedrop vh 
                    LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City 
                    LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop 
                    LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type 
                    LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop 
                    LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation 
                    LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop 
                    LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop 
                    LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category 
                    WHERE vh.ID_HomeDrop = $id
                    GROUP BY vh.ID_HomeDrop";

            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }

        public function SelectImagesHomes($db, $id){

            $details = self::SelectOneHome($db, $id);
            $sql = "SELECT vh.ID_HomeDrop, ih.ID_Imagen, ih.Img 
                    FROM viviendashomedrop vh 
                    LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop 
                    WHERE vh.ID_HomeDrop = $id";

            $stmt = $db->ejecutar($sql);
            
            $array = array();
            
            if (mysqli_num_rows($stmt) > 0) {
                foreach ($stmt as $row) {
                    array_push($array, $row);
                }
            }

            $rdo = array();
            $rdo = $details;
            $rdo[1][] = $array;

            return $rdo;
        }
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#//

        public function CountRelatedHomes($db, $Category, $Ciudad, $ID_HomeDrop) {

            $sql = "SELECT COUNT(DISTINCT vh.ID_HomeDrop) AS contador
                    FROM viviendashomedrop vh
                    LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City
                    LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop
                    LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type
                    LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop
                    LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation
                    LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop
                    LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop 
                    LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category 
                    WHERE (chd.Category = '$Category' OR ch.Ciudad = '$Ciudad') AND vh.ID_HomeDrop != $ID_HomeDrop";

            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#//

        public function ViviendasRelacionadas($db, $Category, $Ciudad, $ID_HomeDrop, $loaded, $items) {

            $sql = "SELECT vh.ID_HomeDrop, vh.Precio, vh.Superficie, ch.Ciudad, vh.Calle, th.Type, oh.Operation, ih.ID_Imagen, ih.ID_HomeDrop, ih.Img, chd.Category, vh.lat, vh.lon
                    FROM viviendashomedrop vh
                    LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City
                    LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop
                    LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type
                    LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop
                    LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation
                    LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop
                    LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop 
                    LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category 
                    WHERE (chd.Category = '$Category' OR ch.Ciudad = '$Ciudad') AND vh.ID_HomeDrop != $ID_HomeDrop 
                    GROUP BY vh.ID_HomeDrop 
                    LIMIT $loaded, $items";

            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#//

        // public function CountRelatedHomes($db, $Category, $Ciudad, $ID_HomeDrop) {

        //     $array_filters = array('type_name', 'category_name', 'color', 'extras', 'doors');  // 'brand_name', 
        //     $array_return = array();

        //     foreach ($array_filters as $row) {

        //         $sql = 'SELECT DISTINCT ' . $row . ' FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand AND c.type = t.cod_type AND c.category = ct.cod_category';
                
        //         $stmt = $db->ejecutar($sql);

        //         if (mysqli_num_rows($stmt) > 0) {
        //             while ($row_inner[] = mysqli_fetch_assoc($stmt)) {
        //                 $array_return[$row] = $row_inner;
        //             }
        //             unset($row_inner);
        //         }
        //     }
        //     return $array_return;
        // }

        // function sql_filter($filters){
        //     $continue = "";
        //     $cont = 0;
        //     $cont1 = 0;
        //     $cont2 = 0;
        //     $select = ' WHERE ';
        //     foreach ($filters as $key => $row) {
        //         foreach ( $row as $key => $row_inner) {
        //             if ($cont == 0) {
        //                 foreach ($row_inner as $value) {
        //                     if ($cont1 == 0) {
        //                         $continue = $key . ' IN ("'. $value . '"';
        //                     }else {
        //                         $continue = $continue  . ', "' . $value . '"';
        //                     }
        //                     $cont1++;
        //                 }
        //                 $continue = $continue . ')';
        //             }else {
        //                 foreach ($row_inner as $value)  {
        //                     if ($cont2 == 0) {
        //                         $continue = ' AND ' . $key . ' IN ("' . $value . '"';
        //                     }else {
        //                         $continue = $continue . ', "' . $value . '"';
        //                     }
        //                     $cont2++;
        //                 }
        //                 $continue = $continue . ')';
        //             }
        //         }
        //         $cont++;
        //         $cont2 = 0;
        //         $select = $select . $continue;
        //     }
        //     return $select;
        // }

        // public function filters($db, $orderby, $total_prod, $items_page, $query) {

        //     $sql_filter = self::sql_filter($query);

        //     $sql = "SELECT c.*, b.*, t.*, ct.* FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand "
        //     . "AND c.category = ct.cod_category AND c.type = t.cod_type $sql_filter ORDER BY $orderby visits DESC LIMIT $total_prod, $items_page";
            
        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

        // public function maps_details($db, $id){

        //     $sql = "SELECT id, city, lat, lng FROM cars WHERE id = '$id'";

        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

        // public function update_view($db, $id){

        //     $sql = "UPDATE cars c SET visits = visits + 1 WHERE id = '$id'";

        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

        // public function select_count($db){

        //     $sql = "SELECT COUNT(*) AS num_cars FROM cars";

        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

        // public function select_count_filters($db, $query){

        //     $filters = self::sql_filter($query);

        //     $sql = "SELECT COUNT(*) AS num_cars FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand "
        //     . "AND c.category = ct.cod_category AND c.type = t.cod_type $filters";

        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

        // public function select_cars($db, $category, $type, $id, $loaded, $items){

        //     $sql = "SELECT c.*, b.*, t.*, ct.* FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand "
        //     . "AND c.type = t.cod_type AND c.category = ct.cod_category WHERE c.category = '$category' AND c.id <> $id OR c.type = '$type' AND c.id <> $id LIMIT $loaded, $items";

        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

        // public function select_load_likes($db, $username){

        //     $sql = "SELECT id_car FROM likes WHERE username='$username'";

        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

        // public function select_likes($db, $id, $username){

        //     $sql = "SELECT username, id_car FROM likes WHERE username='$username' AND id_car='$id'";

        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

        // public function insert_likes($db, $id, $username){

        //     $sql = "INSERT INTO likes (username, id_car) VALUES ('$username','$id')";

        //     $stmt = $db->ejecutar($sql);
        //     return "like";
        // }

        // function delete_likes($db, $id, $username){

        //     $sql = "DELETE FROM likes WHERE username='$username' AND id_car='$id'";

        //     $stmt = $db->ejecutar($sql);
        //     return "unlike";
        // }
    }

?>

