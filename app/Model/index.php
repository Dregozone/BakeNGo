<?php

    namespace app\Model;

    Class Index
    {
        private $conn;
        private $page;

        private $users      = array();
        private $products   = array();
        private $orders     = array();
        private $discounts  = array();
        private $messages   = array();

        public function __construct() {
            // Open connection to the DB
            $this->conn = new \mysqli("localhost", "root", "", "BakeNGo");

            // Declare username where not already set
            $_SESSION["userName"] = !array_key_exists("userName", $_SESSION) ? "none" : $_SESSION["userName"];
        }

        public function __destruct() {
            // Close connection to the DB
            $this->conn->close();
        }

        /** Cleanse user inputs
         *
         */
        public function cleanse($dirty) {

            return htmlspecialchars(trim($dirty), ENT_QUOTES);
        }

        // Start DB actions
            // User
            public function findUser($criteria = false) {

                $where = $criteria != false ? "WHERE name='" . $this->cleanse($criteria) . "'" : "";

                $sql    = "SELECT id, name, password, email, phone, memberSince FROM users " . $where;
                $result = $this->conn->query($sql);

                if ( gettype($result) == "object" && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($this->users, $row);
                    }
                }
            }
            public function addUser($entry) {

                $sql = "
                    INSERT INTO users (id, name, password, email, phone, memberSince)
                    VALUES (NULL, '" . $this->cleanse($entry["name"]) . "', '" . $this->cleanse($entry["password"]) . "', '" . $this->cleanse($entry["email"]) . "', '" . $this->cleanse($entry["phone"]) . "', NOW())
                ";

                $this->conn->query($sql);
            }
            public function getUser() {

                return $this->users;
            }

            // Product
            public function findProduct($criteria = false) {

                $where = $criteria != false ? "WHERE name='" . $this->cleanse($criteria) . "'" : "";

                $sql    = "SELECT id, name, qtyAvailable, discountEligible, image, price FROM products " . $where;
                $result = $this->conn->query($sql);

                if ( gettype($result) == "object" && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($this->products, $row);
                    }
                }
            }
            public function addProduct($entry) {

                $sql = "
                    INSERT INTO products (id, name, qtyAvailable, discountEligible, image, price)
                    VALUES (NULL, '" . $this->cleanse($entry["name"]) . "', '" . $this->cleanse($entry["qtyAvailable"]) . "', '" . $this->cleanse($entry["discountEligible"]) . "', '" . $this->cleanse($entry["image"]) . "', '" . $this->cleanse($entry["price"]) . "')
                ";

                $this->conn->query($sql);
            }
            public function getProduct() {

                return $this->products;
            }
            public function resetProducts() {

                $this->products = array();
            }

            // Order
            public function findOrderDateRange($startDate, $endDate) {

                $sql    = "
                    SELECT 
                         O.id
                        ,ROUND(SUM(P.price * O.productQty * 1.2), 2) AS IncVat
                        
                        ,ROUND(SUM(CASE
                            WHEN O.discountUsed = '1' THEN (P.price * O.productQty * 1.2) * 0.85
                            ELSE 0
                        END), 2) AS DiscountAmountTotalIncVat
                        
                        ,COALESCE(U.email, U.phone) AS Contact 
                    
                    FROM orders O
                        INNER JOIN users    U ON O.userId       = U.id 
                        INNER JOIN products P ON O.productId    = P.id
                    
                    WHERE 
                            O.orderPlacedDate >= '" . $startDate . "'
                        AND O.orderPlacedDate <= '" . $endDate   . "'
                        
                    GROUP BY O.id, COALESCE(U.email, U.phone) 
                    ORDER BY O.id 
                ";

                $result = $this->conn->query($sql);

                if ( gettype($result) == "object" && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($this->orders, $row);
                    }
                }
            }

            public function findOrder($type = false, $criteria = false) {

                $where = $criteria != false ? "WHERE " . $type . "='" . $this->cleanse($criteria) . "'" : "";

                $sql    = "
                    SELECT O.id, O.userId, O.productId, O.productQty, O.discountUsed, O.orderPlacedDate, O.orderComplete, O.orderCompleteDate, U.name 
                    
                    FROM orders O
                        LEFT JOIN users U ON O.userId = U.id 
                    
                    " . $where . "
                    
                    ORDER BY O.id 
                    "
                ;

                $result = $this->conn->query($sql);

                if ( gettype($result) == "object" && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($this->orders, $row);
                    }
                }
            }
            public function addOrder($entry) {

                //$this->findOrder(); // Get all records in table
                //$nextId = sizeof($this->orders) + 1;

                $sql = "
                    INSERT INTO orders (id, userId, productId, productQty, discountUsed, orderPlacedDate, orderComplete, orderCompleteDate)
                    VALUES (" . $this->cleanse($entry["orderId"]) . ", '" . $this->cleanse($entry["userId"]) . "', '" . $this->cleanse($entry["productId"]) . "'
                         , '" . $this->cleanse($entry["productQty"]) . "', '" . $this->cleanse($entry["discountUsed"]) . "', NOW(), 0
                         , '1900-01-01 00:00:00.000')
                ";

                $this->conn->query($sql);
            }
            public function getOrder() {

                return $this->orders;
            }

            // Discount
            public function findDiscount($from = false, $to = false) {

                $where = ( $from != false && $to != false ) ? "WHERE dateDiscountApplied >= '" . $this->cleanse($from) . "' AND dateDiscountApplied <= '" . $this->cleanse($to) . "'" : "";

                $sql    = "SELECT id, orderId, totalSavings, totalPayment, dateDiscountApplied FROM discounts " . $where;
                $result = $this->conn->query($sql);

                if ( gettype($result) == "object" && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($this->discounts, $row);
                    }
                }
            }
            public function addDiscount($entry) {

                $sql = "
                    INSERT INTO discounts (id, orderId, totalSavings, totalPayment, dateDiscountApplied)
                    VALUES (NULL, '" . $this->cleanse($entry["orderId"]) . "', '" . $this->cleanse($entry["totalSavings"]) . "', '" . $this->cleanse($entry["totalPayment"]) . "', '" . $this->cleanse($entry["dateDiscountApplied"]) . "')
                ";

                $this->conn->query($sql);
            }
            public function getDiscount() {

                return $this->discounts;
            }

            // Message
            public function findMessage($criteria = false) {

                $where = $criteria != false ? "WHERE name='" . $this->cleanse($criteria) . "'" : "";

                $sql    = "SELECT id, name, email, message, dateAdded, resolved FROM messages " . $where;
                $result = $this->conn->query($sql);

                if ( gettype($result) == "object" && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($this->messages, $row);
                    }
                }
            }
            public function addMessage($entry) {

                $sql = "
                    INSERT INTO messages (id, name, email, message, dateAdded, resolved)
                    VALUES (NULL, '" . $this->cleanse($entry["name"]) . "', '" . $this->cleanse($entry["email"]) . "', '" . $this->cleanse($entry["message"]) . "', NOW(), false)
                ";

                $this->conn->query($sql);
            }
            public function getMessage() {

                return $this->messages;
            }
        // End   DB actions

        // Start Setters
            public function setPage($to) {
                $this->page = $to;
            }
        // End   Setters

        // Start Getters
            public function getConn() {

                return $this->conn;
            }

            public function getPage() {

            return $this->page;
            }
        // End   Getters
    }
