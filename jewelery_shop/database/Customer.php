<?php

class Customer{

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function getCustomer($email){
        $result = $this->db->con->query("SELECT * FROM customer WHERE email = '{$email}'");

        $item = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $item;
    }

    public function insertCustomer($first_name, $last_name, $display_name, $email, $password){
        if ($this->db->con != null){
            // create sql query
            $query_string = sprintf("INSERT INTO customer(first_name, last_name, display_name, email, password) 
                                            VALUES('%s', '%s', '%s', '%s', '%s')", $first_name, $last_name, $display_name, $email, $password);

            // execute query
            $result = $this->db->con->query($query_string);
            return $result;
        }
    }

    public function checkIfExist($email): bool
    {
        $result = $this->db->con->query("SELECT email FROM customer WHERE email = '{$email}'");

        $item = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if(is_null($item)){
            return false;
        }
        else{
            return true;
        }
    }

    public function checkPassword($email, $password)
    {
        $result = $this->db->con->query("SELECT password FROM customer WHERE email = '{$email}'");

        $item = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $hashed_password = $item['password'];

        if(password_verify($password, $hashed_password)){
            return true;
        }

        else{
            return false;
        }
    }

    public function updateDetails($first_name, $last_name, $display_name, $email, $new_password = null){
        if($display_name == ""){
            $display_name = $first_name;
        }

        if($new_password == ""){
            $result = $this->db->con->query(
      "UPDATE customer SET first_name='{$first_name}', last_name = '{$last_name}',
            display_name = '{$display_name}', email = '{$email}' 
                WHERE id = {$_SESSION['customer']['id']}");
        }
        else{
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $result = $this->db->con->query(
                "UPDATE customer SET first_name='{$first_name}', last_name = '{$last_name}',
            display_name = '{$display_name}', email = '{$email}', password = '{$new_password}' 
                WHERE id = {$_SESSION['customer']['id']}");
        }
    }

    public function insertAddress($customer_id, $company_name, $country, $street, $postcode, $city){
        if ($this->db->con != null){
            $select_result = $this->db->con->query("SELECT * FROM address WHERE customer_id = {$customer_id}");
            if(mysqli_num_rows($select_result) != 0) {
                $this->db->con->query("DELETE FROM address WHERE customer_id = {$customer_id}");
            }
            // create sql query
            $query_string = sprintf("INSERT INTO address(customer_id, company_name, country, street, postcode, city) 
                                            VALUES(%u, '%s', '%s', '%s', '%s', '%s')", $customer_id, $company_name, $country, $street, $postcode, $city);

            // execute query
            $result = $this->db->con->query($query_string);
            return $result;
        }
    }

    public function getAddress($customer_id){
        if ($this->db->con != null){
            $result = $this->db->con->query("SELECT * FROM address WHERE customer_id = {$customer_id}");

            $item = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return $item;
        }
    }

    public function checkIfExistAddress($customer_id){
        if ($this->db->con != null){
            $select_result = $this->db->con->query("SELECT * FROM address WHERE customer_id = {$customer_id}");
            if(mysqli_num_rows($select_result) == 0){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function insertEmail($email){
        $query_string = sprintf("INSERT INTO advertisement(email) 
                                            VALUES('%s')", $email);

        $result = $this->db->con->query($query_string);
    }
}
