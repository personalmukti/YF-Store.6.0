<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

    public function getCategories(){
        return $this->db->get('categories');
    }

    public function getCategoriesLimit(){
        $this->db->limit(6);
        return $this->db->get('categories');
    }

    public function getCategoryById($id){
        return $this->db->get_where('categories', ['id' => $id])->row_array();
    }

    public function getIdCategoryBySlug($slug){
        $this->db->where('slug', $slug);
        $return = $this->db->get('categories')->row_array();
        return $return['id'];
    }

    public function getNameCategoryBySlug($slug){
        $this->db->where('slug', $slug);
        $return = $this->db->get('categories')->row_array();
        return $return['name'];
    }

    public function uploadIcon(){
        $config['upload_path'] = './assets/images/icon/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['file_name'] = round(microtime(true)*1000);

        $this->load->library('upload', $config);
        if($this->upload->do_upload('icon')){
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        }else{
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    public function insertCategory($upload){
        $name = $this->input->post('name');
        $file = $upload['file']['file_name'];
        $slug =  strtolower($name);
        $slugFix = str_replace(" ", "-", $slug);
        $data = [
            "name" => $name,
            "icon" => $file,
            "slug" => $slugFix
        ];
        $this->db->insert('categories', $data);
    }

    public function updateCategory($icon, $id){
        $name = $this->input->post('name');
        $slug =  strtolower($name);
        $slugFix = str_replace(" ", "-", $slug);
        $data = [
            'name' => $name,
            'icon' => $icon,
            'slug' => $slugFix
        ];
        $this->db->where('id', $id);
        $this->db->update('categories', $data);
    }

}