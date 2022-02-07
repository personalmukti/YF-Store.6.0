<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_model extends CI_Model {

    public function getProducts($number,$offset){
        $this->db->select("products.id AS productsId, products.title AS productsTitle, products.price AS productsPrice, products.stock AS productsStock, products.date_submit AS productsDate, products.img AS productsImg, products.publish AS productsPublish, categories.name AS categoriesName");
        $this->db->join("categories", "products.category=categories.id");
        $this->db->order_by("products.id", "desc");
        $this->db->where('products.promo_price= 0');
        return $this->db->get("products",$number,$offset);
    }

    public function getPromo(){
        $this->db->where('promo_price != 0 AND publish = 1');
        return $this->db->get('products');
    }

    public function getPromoLimit(){
        $this->db->where('promo_price != 0 AND publish = 1');
        $this->db->limit('6');
        return $this->db->get('products');
    }

    public function insertPromo(){
        $product = $this->input->post('product');
        $price = $this->input->post('price');
        $this->db->set('promo_price', $price);
        $this->db->where('id', $product);
        $this->db->update('products');
    }

    public function deletePromo($id){
        $this->db->set('promo_price', 0);
        $this->db->where('id', $id);
        $this->db->update('products');
    }

}