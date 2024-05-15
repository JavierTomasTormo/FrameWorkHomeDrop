<?php
    class search_dao{
        static $_instance;

        private function __construct() {
        }
    
        public static function getInstance() {
            if(!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        


    //##########################################################################//
        function SearchCity($db) {
            // return "El DAO esta activo";
            $sql = "SELECT ch.ID_City, ch.Ciudad, vh.Calle, ch.Img FROM cityhomedrop ch 
                INNER JOIN viviendashomedrop vh ON vh.ID_City = ch.ID_City 
                GROUP BY Ciudad";

            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }

        function SearchOperationNull($db){

            $sql = "SELECT * FROM `operationhomedrop`";

			$stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }

        function SearchOperation($db, $CiudadPropo){
            
            $ciudad = $CiudadPropo['Ciudad'];
            // return $ciudad;

            $sql = "SELECT * FROM operationhomedrop oh
                        INNER JOIN viviendasoperation vo ON vo.ID_Operation = oh.ID_Operation 
                        INNER JOIN viviendashomedrop vh ON vh.ID_HomeDrop = vo.ID_HomeDrop
                        INNER JOIN cityhomedrop ch ON ch.ID_City = vh.ID_City 
                    WHERE ch.ID_City = $ciudad
                    GROUP BY oh.ID_Operation";
			
            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }

        function AutocompleteSearch($db, $select){

            $sql = "SELECT vh.ID_HomeDrop, vh.Precio, vh.Superficie, ch.ID_City ,ch.Ciudad, vh.Calle, th.ID_Type ,th.Type, oh.ID_Operation ,oh.Operation, 
                        ih.ID_Imagen, ih.ID_HomeDrop, ih.Img, chd.Category, chd.ID_Category
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


            $sql .= $select;

            // $sql .= " GROUP BY th.Type ";

            // return $sql;

			$stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }

        
    }

?>