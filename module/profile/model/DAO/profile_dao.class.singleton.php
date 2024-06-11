<?php
    class profile_dao {
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

        public function get_UserData($db) {
            $ID_User = $_SESSION['ID_User'];
            // return $_SESSION;
            $sql = "SELECT Username, ID_User, Email, Avatar, 
                    (SELECT COUNT(vh.ID_HomeDrop) FROM likeshomedrop 
                        LEFT JOIN viviendashomedrop vh ON likeshomedrop.ID_HomeDrop = vh.ID_HomeDrop 
                        WHERE likeshomedrop.ID_User =  users.ID_User
                    ) AS Likes 
                    FROM users 
                    WHERE ID_User = $ID_User;";

            // return $sql;

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }

// //##########################################################################//
        public function getOrderDetails($db, $order_id) {
            $sql = "SELECT * FROM orders WHERE ID_Order = $order_id";
            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }

        public function getOrderItems($db, $order_id) {
            $sql = "SELECT oi.Quantity, oi.Price, vh.Calle
                    FROM order_items oi
                    LEFT JOIN viviendashomedrop vh ON oi.ID_HomeDrop = vh.ID_HomeDrop
                    WHERE oi.ID_Order = $order_id";

            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }

        public function get_user_orders($db, $user_id) {
            $sql = "SELECT * FROM orders WHERE ID_User = $user_id";

            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }
        

// //##########################################################################//
                
        public function updateUserProfileImage($db, $userId, $imgPath) {

            // return array('userid' => $userId,'filename' => $uploadPath);

            $sql = "UPDATE users SET Avatar = '$imgPath' WHERE ID_User = $userId";

            // return $sql;

            return $db->ejecutar($sql);
            // return "Success";
        }
  
  
        //##########################################################################//

        public function LikedHouses($db, $username) {

            // return $username;

            $sql = "SELECT 
                        vh.ID_HomeDrop, 
                        vh.Precio, 
                        vh.Superficie, 
                        ch.Ciudad, 
                        vh.Calle, 
                        th.Type, 
                        oh.Operation, 
                        ih.ID_Imagen, 
                        ih.Img,
                        chd.Category, 
                        vh.lat, 
                        vh.lon,
                        ih.Img
                    FROM 
                        viviendashomedrop vh 
                        LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City 
                        LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop 
                        LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type 
                        LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop 
                        LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation 
                        LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop 
                        LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop 
                        LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category 
                    WHERE 
                        vh.ID_HomeDrop IN (SELECT ID_HomeDrop FROM likeshomedrop WHERE ID_User = (SELECT ID_User FROM users WHERE Username = '$username'))
                    GROUP BY 
                        vh.ID_HomeDrop";

            // return $sql;
            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
            // return;
        }
        
        
        

// //##########################################################################//
//         public function SelectOperation($db) {

//             $sql = "SELECT * FROM `operationhomedrop` ORDER BY ID_Operation DESC";

//             $stmt = $db -> ejecutar($sql);
//             return $db -> listar($stmt);
//         }
// //##########################################################################//
//         public function MostVisited($db) {

//             $sql = "SELECT vh.ID_HomeDrop, vh.Precio, vh.Superficie, ch.Ciudad, vh.Calle, th.Type, oh.Operation, ih.ID_Imagen, ih.Img, vh.vivistas,chd.Category
//             		FROM viviendashomedrop vh 
//             		LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City 
//              		LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop 
//              		LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type 
//              		LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop 
//              		LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation 
//              		LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop 
//              		LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop 
//             		LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category
//              		GROUP BY vh.ID_HomeDrop
//              		ORDER BY vivistas DESC LIMIT 5 ;";

//             $stmt = $db -> ejecutar($sql);
//             return $db -> listar($stmt);
//         }
// //##########################################################################//
//         public function SelectLastHouse($db, $lastSelectedHouses) {
            

//             $idsString = implode(',', $lastSelectedHouses);

//             // return $idsString;//(4) [26, 25, 11, 9]

//             $sql = "SELECT vh.ID_HomeDrop, vh.Precio, vh.Superficie, ch.Ciudad, vh.Calle, th.Type, oh.Operation, ih.ID_Imagen, ih.Img, chd.Category
//              					FROM viviendashomedrop vh 
//              					LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City 
//              					LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop 
//              					LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type 
//              					LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop 
//              					LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation 
//              					LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop 
//              					LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop 
//              					LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category 
//              					WHERE vh.ID_HomeDrop IN ($idsString)
//                                 GROUP BY vh.ID_HomeDrop";

//             //return $sql;

//             $stmt = $db -> ejecutar($sql);
//             return $db -> listar($stmt);
//         }
// //##########################################################################//

    }
?>