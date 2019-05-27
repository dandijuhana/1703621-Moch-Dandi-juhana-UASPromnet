<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_karyawan extends CI_Controller {

	var $API ="";

	function __construct() {
		parent::__construct();
		$this->API="https://api.akhmad.web.id/";
	}

	// proses yang akan di buka saat pertama masuk ke controller
	public function index()
	{
		// $data['karyawan'] = json_decode($this->curl->simple_get($this->API.'/Karyawan'));
		$this->curl->http_header("X-Nim", "1703621");
		$data['motor'] = json_decode($this->curl->simple_get($this->API.'/motor'));
		//$this->curl->debug();
		$this->load->view('V_karyawan', $data);
		
		// $this->load->view('V_karyawan', $data);
	}

	public function getUser()
	{
		// $data['karyawan'] = json_decode($this->curl->simple_get($this->API.'/Karyawan'));
		$this->curl->http_header("X-Nim", "1703621");
		$data['user'] = json_decode($this->curl->simple_get($this->API.'/user'));
		//$this->curl->debug();
		$this->load->view('V_karyawan', $data);

		// $this->load->view('V_karyawan', $data);
	}

	public function getCicil()
	{
	
		$this->curl->http_header("X-Nim", "1703621");
		$data['cicil'] = json_decode($this->curl->simple_get($this->API.'/cicil'));
		$this->load->view('V_cicil', $data);
	}

	public function getuangMuka()
	{
		
		$this->curl->http_header("X-Nim", "1703621");
		$data['uangmuka'] = json_decode($this->curl->simple_get($this->API.'/V_uangmuka'));
		$this->load->view('V_uangmuka', $data);
	}


	public function getPenjualan()
	{
		$this->curl->http_header("X-Nim", "1703621");
		$data['penjualan'] = json_decode($this->curl->simple_get($this->API.'/penjualan'));
		$this->load->view('V_cicil', $data);

	}

	function add(){

		$data = array(
			'id'      =>  $this->input->post('id'),
			'name'    =>  $this->input->post('name'),
			'email'	  =>  $this->input->post('email'),
			'address' =>  $this->input->post('address'),
			'phone'   =>  $this->input->post('phone'),
            'tgl'   =>  $this->input->post('tgl'),
            'tempat'   =>  $this->input->post('tempat'),
            'gaji'   =>  $this->input->post('gaji'),
            'posisi'   =>  $this->input->post('posisi'));
		$insert =  $this->curl->simple_post($this->API.'/Karyawan', $data, array(CURLOPT_BUFFERSIZE => 0));

		if($insert)
		{
			$this->session->set_flashdata('hasil','Insert Data Berhasil');
		}else
		{
			$this->session->set_flashdata('hasil','Insert Data Gagal');
		}

		redirect('C_karyawan');

	}


	function update($id){

		$data = array(
			'id'      =>  $id,
			'name'    =>  $this->input->post('name'),
			'email'	  =>  $this->input->post('email'),
			'address' =>  $this->input->post('address'),
			'phone'	  =>  $this->input->post('phone'),
			'tgl'   =>  $this->input->post('tgl'),
            'tempat'   =>  $this->input->post('tempat'),
            'gaji'   =>  $this->input->post('gaji'),
            'posisi'   =>  $this->input->post('posisi'));
		$update =  $this->curl->simple_put($this->API.'/Karyawan', $data, array(CURLOPT_BUFFERSIZE => 0));

		if($update)
		{
			$this->session->set_flashdata('hasil','Insert Data Berhasil');
		}else
		{
			$this->session->set_flashdata('hasil','Insert Data Gagal');
		}

		redirect('C_karyawan');

	}





	// proses untuk menghapus data pada database
	function delete($id){
		if(empty($id)){
			redirect('C_karyawan');
		}else{
			$delete =  $this->curl->simple_delete($this->API.'/Karyawan', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10));
			if($delete)
			{
				$this->session->set_flashdata('hasil','Delete Data Berhasil');
			}else
			{
				$this->session->set_flashdata('hasil','Delete Data Gagal');
			}

			redirect('C_karyawan');
		}
	}

	//TUGAS : bikin fungsi update di client menggunakan service
	//
	//
}
