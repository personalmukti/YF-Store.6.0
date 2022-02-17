<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Main_model extends CI_Model {

    public function __construct() {
		parent::__construct(); 
	}

	// Fetch records
	public function getAllPosts($invocode) {

		// Posts
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->where('id_invoice', $invocode);
		$this->db->order_by("id", "asc");
		$postsquery = $this->db->get();
       	
       	$postResult = $postsquery->result_array();

       	$posts_arr = array();
       	foreach($postResult as $post){
       		$id = $post['id_invoice'];
       		$product_name = $post['product_name'];
       		$price = $post['price'];
       		$img = $post['img'];

       		// User rating
       		$this->db->select('rating');
			$this->db->from('posts_rating');
			$this->db->where("userid", $userid);
			$this->db->where("postid", $id);
			$userRatingquery = $this->db->get();
	       	
	       	$userpostResult = $userRatingquery->result_array();

	       	$userRating = 0;
	       	if(count($userpostResult)>0){
	       		$userRating = $userpostResult[0]['rating'];
	       	}
	     
       		// Average rating
       		$this->db->select('ROUND(AVG(rating),1) as averageRating');
			$this->db->from('posts_rating');
			$this->db->where("postid", $id);
			$ratingquery = $this->db->get();
	       	
	       	$postResult = $ratingquery->result_array();

	       	$rating = $postResult[0]['averageRating'];
	       	
	       	if($rating == ''){
	       		$rating = 0;
	       	}

       		$posts_arr[] = array("id"=>$id,"product_name"=>$product_name,"img"=>$img,"price"=>$price,"rating"=>$userRating,"averagerating"=>$rating);
       	}
     
		return $posts_arr;
	}


	// Save user rating
	public function userRating($userid,$postid,$rating){
		$this->db->select('*');
		$this->db->from('posts_rating');
		$this->db->where("postid", $postid);
		$this->db->where("userid", $userid);
		$userRatingquery = $this->db->get();
       	
       	$userRatingResult = $userRatingquery->result_array();
       	if(count($userRatingResult) > 0){

       		$postRating_id = $userRatingResult[0]['id'];
       		// Update
            $value=array('rating'=>$rating);
            $this->db->where('id',$postRating_id);
            $this->db->update('posts_rating',$value);
       	}else{
       		$userRating = array(
               "postid" => $postid,
               "userid" => $userid,
               "rating" => $rating
            );

            $this->db->insert('posts_rating', $userRating);
       	}

       	// Average rating
       	$this->db->select('ROUND(AVG(rating),1) as averageRating');
		$this->db->from('posts_rating');
		$this->db->where("postid", $postid);
		$ratingquery = $this->db->get();
	       	
	    $postResult = $ratingquery->result_array();

	    $rating = $postResult[0]['averageRating'];
	       	
	    if($rating == ''){
	       	$rating = 0;
	    }

       	return $rating;
	}
	
}