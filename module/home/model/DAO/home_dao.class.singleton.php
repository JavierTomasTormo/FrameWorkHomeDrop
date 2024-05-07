<?php
    class home_dao {
        static $_instance;
//##########################################################################//
        private function __construct() { 
        }
//##########################################################################//
        public static function getInstance() {
            if(!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }
//##########################################################################//
        public function selectCarouselImages($db) {

            $sql = "SELECT * FROM `typehomedrop` ORDER BY ID_Type ASC LIMIT 25;";

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
//##########################################################################//
        public function SelectCategory($db) {

            $sql = "SELECT * FROM `categoryhomedrop` ORDER BY ID_Category ASC ;";

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
//##########################################################################//
        public function SelectCity($db) {

            $sql = "SELECT ch.ID_City, ch.Ciudad, vh.Calle, ch.Img FROM cityhomedrop ch 
             			INNER JOIN viviendashomedrop vh ON vh.ID_City = ch.ID_City 
             			GROUP BY Ciudad ORDER BY ID_City ASC;";

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
//##########################################################################//
        public function SelectOperation($db) {

            $sql = "SELECT * FROM `operationhomedrop` ORDER BY ID_Operation DESC";

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
//##########################################################################//
        public function MostVisited($db) {

            $sql = "SELECT vh.ID_HomeDrop, vh.Precio, vh.Superficie, ch.Ciudad, vh.Calle, th.Type, oh.Operation, ih.ID_Imagen, ih.Img, vh.vivistas,chd.Category
            		FROM viviendashomedrop vh 
            		LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City 
             		LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop 
             		LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type 
             		LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop 
             		LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation 
             		LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop 
             		LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop 
            		LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category
             		GROUP BY vh.ID_HomeDrop
             		ORDER BY vivistas DESC LIMIT 5 ;";

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
//##########################################################################//
        public function SelectLastHouse($db, $lastSelectedHouses) {
            return $lastSelectedHouses;//(4) [26, 25, 11, 9]

            $sql = "SELECT vh.ID_HomeDrop, vh.Precio, vh.Superficie, ch.Ciudad, vh.Calle, th.Type, oh.Operation, ih.ID_Imagen, ih.Img, chd.Category
             					FROM viviendashomedrop vh 
             					LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City 
             					LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop 
             					LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type 
             					LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop 
             					LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation 
             					LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop 
             					LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop 
             					LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category 
             					WHERE vh.ID_HomeDrop = $lastSelectedHouses";

            return $sql;

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
//##########################################################################//

    }
?>