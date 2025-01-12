<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
include_once 'connect.php';
$create_users="CREATE TABLE IF NOT EXISTS `users`(`id` INT PRIMARY KEY AUTO_INCREMENT,`user_key` VARCHAR(255),`username` VARCHAR(255),`mail` VARCHAR(255),`mail_verified` VARCHAR(255),`full_name` VARCHAR(255),`mobile` BIGINT,`password` VARCHAR(255),`country` VARCHAR(255),`currency` VARCHAR(255),`balance` BIGINT,`longitude` VARCHAR(255),`latitude` VARCHAR(255),`account_type` VARCHAR(255),`profile` VARCHAR(255),`verified` VARCHAR(255),`validity` INT,`last_login` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,`join_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$users_created=mysqli_query($conn,$create_users);
$create_otp="CREATE TABLE IF NOT EXISTS `otp`(`id` INT PRIMARY KEY AUTO_INCREMENT,`otp_code` INT,`mail` VARCHAR(255),`status` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$otp_created=mysqli_query($conn,$create_otp);
$create_admin="CREATE TABLE IF NOT EXISTS `admins`(`id` INT PRIMARY KEY AUTO_INCREMENT,`mail` VARCHAR(255),`username` VARCHAR(255),`password` VARCHAR(255),`role` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$admin_created=mysqli_query($conn,$create_admin);
$create_account="CREATE TABLE IF NOT EXISTS `accounts`(`id` INT PRIMARY KEY AUTO_INCREMENT,`username` VARCHAR(255),`user_id` INT,`account_type` VARCHAR(255),`business_name` VARCHAR(255),`products` VARCHAR(255),`mail` VARCHAR(255),`mobile` BIGINT,`address` TEXT,`minimum_order` BIGINT,`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

$account_created=mysqli_query($conn,$create_account);
$create_notifications="CREATE TABLE IF  NOT EXISTS `notifications`(`id` INT PRIMARY KEY AUTO_INCREMENT,`user_id` INT,`message` TEXT,`link` VARCHAR(255),`status` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$notifications_created=mysqli_query($conn,$create_notifications);
$create_categories="CREATE TABLE IF NOT EXISTS `categories`(`id` INT PRIMARY KEY AUTO_INCREMENT,`name` VARCHAR(255),`icon` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$categories_created=mysqli_query($conn,$create_categories);
$create_subcategories="CREATE TABLE IF NOT EXISTS `subcategories`(`id` INT PRIMARY KEY AUTO_INCREMENT,`name` VARCHAR(255),`category_id` INT,`icon` VARCHAR(255),`units` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$subcategories_created=mysqli_query($conn,$create_subcategories);
$create_products="CREATE TABLE IF NOT EXISTS `products`(`id` INT PRIMARY KEY AUTO_INCREMENT,`category_id` INT,`subcategory_id` INT,`unit` VARCHAR(255),`weight` VARCHAR(255),`photos` VARCHAR(255),`title` VARCHAR(255),`description` TEXT,`price` VARCHAR(255),`currency` VARCHAR(255),`featured` VARCHAR(255),`feature_validity` INT,`mass_unit` VARCHAR(255),`user_id` INT,`status` VARCHAR(255),`country` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$products_created=mysqli_query($conn,$create_products);
$create_transactions="CREATE TABLE IF NOT EXISTS `transactions`(`id` INT PRIMARY KEY AUTO_INCREMENT,`amount` BIGINT,`currency` VARCHAR(255),`key` VARCHAR(255),`type` VARCHAR(255),`user_id` INT,`status` VARCHAR(255),`gateway` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$transactions_created=mysqli_query($conn,$create_transactions);
$create_cart="CREATE TABLE IF NOT EXISTS `cart`(`id` INT PRIMARY KEY AUTO_INCREMENT,`product_id`INT,`product_title` VARCHAR(255),`product_photo` VARCHAR(255),`product_cost` VARCHAR(255),`currency` VARCHAR(255),`status` VARCHAR(255),`miles` VARCHAR(255),`quantity` INT,`size` INT,`unit` VARCHAR(255),`uniqid` VARCHAR(255),`store_id` INT,`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$cart_created=mysqli_query($conn,$create_cart);
 
$create_discount="CREATE TABLE IF NOT EXISTS `discount`(`id` INT PRIMARY KEY AUTO_INCREMENT,`name` VARCHAR(255),`code` VARCHAR(255),`percentage` INT,`limit` INT,`redeemed` VARCHAR(255),`minimum_checkout` INT,`status` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$discount_created=mysqli_query($conn,$create_discount);
$create_orders="CREATE TABLE IF NOT EXISTS `orders`(`id` INT PRIMARY KEY AUTO_INCREMENT,`uniqid` VARCHAR(255),`photo` VARCHAR(255),`product` VARCHAR(255),`product_id` VARCHAR(255),`user_id` Int,`currency` VARCHAR(255),`cost` BIGINT,`quantity` INT,`status` VARCHAR(255),`delivery_option` VARCHAR(255),`delivery_fee` BIGINT,`store_id` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,`out_for_delivery` TIMESTAMP NULL,`delivered` TIMESTAMP NULL)";
$orders_created=mysqli_query($conn,$create_orders);
$create_dispute="CREATE TABLE IF NOT EXISTS `dispute`(`id` INT PRIMARY KEY AUTO_INCREMENT,`uniqid` VARCHAR(255),`order_id` VARCHAR(255),`dispute_reason` VARCHAR(255),`custom` VARCHAR(255),`details` TEXT,`user_id` INT,`attachment` VARCHAR(255),`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$dispute_created=mysqli_query($conn,$create_dispute);
$create_inbox="CREATE TABLE IF NOT EXISTS `inbox`(`id` INT PRIMARY KEY AUTO_INCREMENT,`sender` INT,`receiver` INT,`dispute_id` VARCHAR(255),`uniqid` VARCHAR(255),`subject` VARCHAR(255),`message` TEXT,`photo` VARCHAR(255),`status` VARCHAR(255),`typing` TIMESTAMP,`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$inbox_created=mysqli_query($conn,$create_inbox);

if($discount_created){
    echo "SUCCESS";
}
else{
    echo mysqli_error($conn);
}



?>