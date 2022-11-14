<?php

class Order
{
    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // fetch order by definite ID and email
    public function getOrder($id, $email){
        $result = $this->db->con->query("SELECT * FROM orders 
         WHERE id = '{$id}' AND email = '{$email}'");
        return mysqli_fetch_assoc($result);
    }

    // fetch all orders
    public function getOrders($email){
        $result = $this->db->con->query("SELECT * from orders WHERE email='{$email}'");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // fetch ordered products for specific order id
    public function getProducts($orderID){
        $result = $this->db->con->query(
            "SELECT product.name, product.price, product_order.amount
                    FROM product
                    INNER JOIN product_order ON product.id = product_order.product_id
                    WHERE product_order.order_id = {$orderID}
");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }


    // insert order
    public function insertOrder($first_name,
    $last_name, $company_name, $country, $street,
    $postcode, $city, $phone, $email, $order_notes, $payment, $status="processing"){
        $date_of_order = date("Y.m.d");
        if ($this->db->con != null){
            // create sql query
            $query_string = sprintf("INSERT INTO orders(first_name,
                                        last_name, company_name, country, street,
                                    postcode, city, phone, email, order_notes, payment, date_of_order, status) 
                        VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');" , $first_name,
                $last_name, $company_name, $country, $street,
                $postcode, $city, $phone, $email, $order_notes, $payment, $date_of_order, $status);



            // execute query
            $result = $this->db->con->query($query_string);
            $id_array =  $this->db->con->query( "SELECT id FROM orders ORDER BY ID DESC LIMIT 1");
            $id = mysqli_fetch_array($id_array)[0];
            return intval($id);
        }
    }

    // insert product_order
    public function insertOrderProduct($productID, $orderID, $amount){
        if ($this->db->con != null){
            // create sql query
            $query_string = sprintf("INSERT INTO product_order(product_id, order_id, amount) 
                        VALUES(%f, %f, %f);" , $productID, $orderID, $amount);

            // execute query
            $result = $this->db->con->query($query_string);
            return $result;
        }
    }
}
