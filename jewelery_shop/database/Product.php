<?php

class Product{

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // fetch product data using getData Method
    public function getData($table = 'product'){
        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // fetch product data using getVariousData Method with various queries
    public function getVariousData($query){
        $result = $this->db->con->query($query);

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // fetch product by definite ID
    public function getProduct($id){
        $result = $this->db->con->query("SELECT * FROM product WHERE id = {$id}");
        return mysqli_fetch_assoc($result);
    }

    // fetch reviews for specific product
    public function getReviews($id){
        $result = $this->db->con->query("SELECT * FROM review WHERE product_id = {$id}");
        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // count amount of reviews
    public function countReviews($id){
        $result = $this->db->con->query("SELECT COUNT(*) FROM review WHERE product_id = {$id}");
        return mysqli_fetch_row($result)[0];
    }

    // average raiting
    public function averageRaiting($id){
        $result = $this->db->con->query("SELECT AVG(raiting) FROM review WHERE product_id = {$id}");
        return mysqli_fetch_row($result)[0];
    }

    // insert review
    public function insertReview($product_id, $name, $rating, $reviewText, $email){
        if ($this->db->con != null){
            // create sql query
            $query_string = sprintf("INSERT INTO review(product_id, username, raiting, reviewText, email) VALUES(%s, '%s', %s, '%s', '%s')", $product_id, $name, $rating, $reviewText, $email);

            // execute query
            $result = $this->db->con->query($query_string);
            return $result;
        }
    }
}