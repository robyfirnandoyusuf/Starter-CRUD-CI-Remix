<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Adsmodel extends Eloquent {
    public $timestamps = false;
    protected $table = "ads";
    // protected $fillable = ['title', 'status', 'image','created_at','created_by','modified_at','modified_by'];
    protected $guarded = ['id'];

}
/*
class Adsmodel extends CI_Model
{   
    public function __construct()
    {
        parent::__construct();
    }

    public function insert()
    {
        $title               = $this->input->post("title");
        $image               = $this->input->post("image");
        $status              = $this->input->post("status");

        $img     = $this->do_upload_image('image', './assets/uploads/ads/');
        $this->db->set("title", $title)
                 ->set("status", $status)
                 ->set("image", 'assets/uploads/ads/'.$img['message'])
                 ->set("created_at", date("Y-m-d H:i:s"))
                 ->set("created_by", 1)// id session user login
                 ->insert("ads");
    }


    public function update($id)
    { 
      
        $title               = $this->input->post("title");
        $status              = $this->input->post("status");

        $img     = $this->do_upload_image('image', './assets/uploads/ads/');
    
        if ($img['status'] == 'success'){
           $this->db->where("id",$id)
                     ->set("title", $title)
                     ->set("type", $type)
                     ->set("status", $status)
                     ->set("image", 'assets/uploads/ads/'.$img['message'])
                     ->set("modified_at", date("Y-m-d H:i:s"))
                     ->set("modified_by", 1)// id session user login
                     ->update("ads");
        }else{
             $this->db->where("id",$id)
                     ->set("title", $title)
                     ->set("status", $status)
                     ->set("modified_at", date("Y-m-d H:i:s"))
                     ->set("modified_by", 1)// id session user login
                     ->update("ads");
        }

      
        return true;
    }
    
    public function delete($id)
    {
        $this->db->where("id", $id);
        $this->db->set("status", "deleted");
        $this->db->update("ads");
        return true; 
    }

    public function get_by_id($id)
    {
        $this->db->select("*");
        $this->db->from("ads");
        $this->db->where("id", $id);
        $query  = $this->db->get();
        $data   = array();    
        if ($query->num_rows() > 0)
        {
            foreach (($query->result_array()) as $row) $data[] = $row;
            return $data;
        }
    }

    public function get_all($status)
    {
        $this->db->select("*");
        if(count($status) > 0)
        {
            $i = 1;
            foreach ($status as $st) 
            {
                if($i == 1){
                    $this->db->where("status", $st);
                }else{
                    $this->db->or_where("status", $st);
                }
                $i++;
            }
        }
        $this->db->from("ads");
        $query  = $this->db->get();
        $data   = $query->result();
        return $data;
    }

     private function do_upload_image($input_name,$path)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        // $config['max_width']  = '1024';
        // $config['max_height']  = '1024';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($input_name))
        {
            $error = array('error' => $this->upload->display_errors());
            return array("status" => 'error', 'message' => $error);
        }
        else
        {
            $data = $this->upload->data();
            return array("status" => 'success', 'message' =>$data['file_name']);
        }
    }

   
*/
// }   