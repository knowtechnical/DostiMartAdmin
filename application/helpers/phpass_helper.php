<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('upload_singleimage'))
{
    function upload_singleimage($uploadpath,$image_name)
	{
		$config['upload_path'] = '../davish_images/'.$uploadpath;
		// $config['upload_path'] = $uploadpath;
		$config['allowed_types'] = 'image|gif|jpg|png|jpeg';						
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload($image_name);
		$data =  $this->upload->data();		
		
		$proof = $data['file_ext'];
		$pic = $data['file_name'];

		return $pic;
	} 
}