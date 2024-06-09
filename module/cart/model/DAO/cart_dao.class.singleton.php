<?php
    class cart_dao {
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

        public function selectCartHomes($db, $id_user) {

            $sql = "SELECT * FROM `cart` WHERE ID_User = $id_user ORDER BY ID_Cart DESC ;";

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
// //##########################################################################//
        public function selectMatchedHomes($db, $user) {

                $sql = "SELECT vh.ID_HomeDrop, vh.Precio, vh.Superficie, ch.Ciudad, vh.Calle, th.Type, oh.Operation, ih.ID_Imagen, ih.Img, vh.vivistas, chd.Category
                            FROM viviendashomedrop vh
                            LEFT JOIN cityhomedrop ch ON vh.ID_City = ch.ID_City
                            LEFT JOIN viviendastype vht ON vh.ID_HomeDrop = vht.ID_HomeDrop
                            LEFT JOIN typehomedrop th ON vht.ID_Type = th.ID_Type
                            LEFT JOIN viviendasoperation vho ON vh.ID_HomeDrop = vho.ID_HomeDrop
                            LEFT JOIN operationhomedrop oh ON vho.ID_Operation = oh.ID_Operation
                            LEFT JOIN imageneshomedrop ih ON ih.ID_HomeDrop = vh.ID_HomeDrop
                            LEFT JOIN viviendascategory vc ON vc.ID_HomeDrop = vh.ID_HomeDrop
                            LEFT JOIN categoryhomedrop chd ON chd.ID_Category = vc.ID_Category
                            WHERE vh.ID_HomeDrop IN (SELECT ID_HomeDrop FROM cart WHERE ID_User = $user)
                            GROUP BY vh.ID_HomeDrop
                            ORDER BY vivistas DESC;";

            // return $sql;

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
// //##########################################################################//
        public function getCartItemQuantity($db, $ID_HomeDrop, $ID_User) {
            $sql = "SELECT Quantity FROM cart WHERE ID_HomeDrop = $ID_HomeDrop AND ID_User = $ID_User";
            $stmt = $db->ejecutar($sql);
            $result = $db->listar($stmt);
            return $result;
        }

        public function getHomeStock($db, $ID_HomeDrop) {
            $sql = "SELECT stock FROM viviendashomedrop WHERE ID_HomeDrop = $ID_HomeDrop";
            $stmt = $db->ejecutar($sql);
            $result = $db->listar($stmt);
            return $result;
        }

        public function updateCartItemQuantity($db, $ID_HomeDrop, $ID_User, $newQuantity) {
            $sql = "UPDATE cart SET Quantity = $newQuantity WHERE ID_HomeDrop = $ID_HomeDrop AND ID_User = $ID_User";
            $db->ejecutar($sql);
        }

        public function deleteCartItem($db, $ID_HomeDrop, $ID_User) {
            $sql = "DELETE FROM `cart` WHERE ID_HomeDrop = $ID_HomeDrop AND ID_User = $ID_User";
            $db->ejecutar($sql);
        }

        



        //##########################################################################//

        public function insertOrder($db, $user_id, $total_amount) {
            $sql = "INSERT INTO orders (ID_User, Total_Amount) VALUES ($user_id, $total_amount)";
            $db->ejecutar($sql);
            $sql = "SELECT LAST_INSERT_ID() AS order_id";
            $stmt = $db->ejecutar($sql);
            $result = $db->listar($stmt);
            return $result[0]['order_id'];
        }
        
        
        
        public function insertOrderItem($db, $order_id, $product_id, $quantity, $price) {
            $sql = "INSERT INTO order_items (ID_Order, ID_HomeDrop, Quantity, Price) VALUES ($order_id, $product_id, $quantity, $price)";
            $db->ejecutar($sql);
        }
        
        
        public function clearCart($db, $user_id) {
            $sql = "DELETE FROM cart WHERE ID_User = $user_id";
            $db->ejecutar($sql);
        }

        public function getProductPrice($db, $product_id) {
            $sql = "SELECT Precio FROM viviendashomedrop WHERE ID_HomeDrop = $product_id";
            $stmt = $db->ejecutar($sql);
            $result = $db->listar($stmt);
            return $result[0]['Precio'];
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