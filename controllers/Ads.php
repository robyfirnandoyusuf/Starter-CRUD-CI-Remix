<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends CI_Controller {
	
	public function __construct()
    {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Adsmodel', 'model');
    }
	
	public function index()
	{
		$status	= array('active', 'nonactive');
        $data['success_message'] = $this->session->flashdata('success_message');
		
		$data['styles'] 	= '<link type="text/css" rel="stylesheet" href="'. base_url().'assets/backend/css/libs/DataTables/jquery.dataTables.css">
								<link type="text/css" rel="stylesheet" href="'. base_url().'assets/backend/css/libs/DataTables/extensions/dataTables.colVis.css">
								<link type="text/css" rel="stylesheet" href="'. base_url().'assets/backend/css/libs/DataTables/extensions/dataTables.tableTools.css">
								<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
								<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
								';
		$data['scripts'] 	= '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
								<script src="'. base_url().'assets/backend/js/libs/DataTables/jquery.dataTables.min.js"></script>
								<script src="'. base_url().'assets/backend/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
								<script src="'. base_url().'assets/backend/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
								<script src="'. base_url().'assets/backend/js/core/demo/DemoTableDynamic.js"></script>
								<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
								';
								
  		$ads = Adsmodel::where('status', "active")->get();

		$data['ads']		= $ads;
		$data['title']		= 'Listing Ads';

		$this->blade->view('ads/index', $data);
	}

	public function add()
	{
	$this->form_validation->set_rules('title', 'Title', 'trim|required');

	if ( $this->form_validation->run() == true){

			// $this->model->insert(); //uncomment to use query builder
	$title               = $this->input->post("title");
        $image               = $this->input->post("image");
        $Status              = $this->input->post("status");
        $img    			 = $this->do_upload_image('image', './assets/uploads/ads/');
        
        if ($img['status'] != "error") {
          $client 				= new Adsmodel;
		  $client->title  		= $title;
		  $client->status 		= $Status;
		  $client->image  		= 'assets/uploads/ads/'.$img['message'];
		  $client->created_at  	= date('Y-m-d H:i:s');
		  $client->created_by	= 1;//replace with id session login

		  $result = $client->save();
        }else{
        	echo $img['message']['error']." <font color='red'> Jika anda menggunakan linux mohon change permission 777 , chmod -R 777 uploads pada directory assets/, jika folder <b>uploads</b> tidak ada pada assets, anda bisa membuat folder sendiri </font>";
        	die;
        }

            $this->session->set_flashdata('success_message', "Add Ads success");
            redirect("ads/index", 'refresh');

		}else{
			$data['message'] 	= (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			$data['title']		= 'Add Ads';
			$data['styles'] 	='<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
			$data['scripts']	= '
								<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
								<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
									';
			
			$this->blade->view('ads/add', $data);
		}
	}

	public function edit($id)
	{
		$title               = $this->input->post("title");
        $image               = $this->input->post("image");
        $Status              = $this->input->post("status");


		$status	= array('active', 'nonactive','deleted');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');

		if ( $this->form_validation->run() == true){
			$client  = new Adsmodel;
			// $this->model->update($id); //uncomment to use query builder
	        $img     = $this->do_upload_image('image', './assets/uploads/ads/');
        	if ($img['status'] == 'success'){
				 Adsmodel::find($id)->update([
	                
	            	  "title"  		=> $title,
					  "status" 		=> $Status,
					  "image"  		=> 'assets/uploads/ads/'.$img['message'],
					  "modified_at"	=> date('Y-m-d H:i:s'),
					  "modified_by"	=> 1//replace with id session login

	            ]);
				}else{

					Adsmodel::find($id)->update([
		              "title"  		=> $title,
					  "status" 		=> $Status,
					  "modified_at"	=> date('Y-m-d H:i:s'),
					  "modified_by"	=> 1//replace with id session login

		            ]);
				}
            $this->session->set_flashdata('success_message', "Update Ads success");
            redirect("ads/index", 'refresh');

		}else{
			$data['message'] 	= (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			$data['styles'] 	='<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
			$data['scripts']	= '
								<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
								<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
									';
			// $single 			= $this->model->get_by_id($id);//uncomment to use query builder
	        $single = Adsmodel::find($id);
			$data['single'] 	= $single;
			$data['title']		= 'Edit Ads';

			$this->blade->view('ads/edit', $data);
		}
	}

	public function delete($id)
	{
		// $query = $this->model->delete($id); // uncomment to use query builder
			Adsmodel::find($id)->update([
			  "status" 		=> 'deleted',
            ]);

		$this->session->set_flashdata('success_message', "Delete Ads success");
		redirect("ads/index", 'refresh');
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
	

}
	
