<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsumen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_konsumen');
	}

	public function index()
	{
		$isi['content'] = 'backend/konsumen/v_konsumen';
        $isi['judul'] = 'Data konsumen';
		$isi['data'] = $this->m_konsumen->getAllDataKonsumen();
		$this->load->view('backend/dashboard', $isi);
	}

    public function tambah()
	{
		$isi['content'] = 'backend/konsumen/t_konsumen';
        $isi['judul'] = 'Form Tambah konsumen';
        $isi['kode_konsumen'] = $this->m_konsumen->generate_kode_konsumen();
		$this->load->view('backend/dashboard', $isi);
	}

	public function simpan()
	{
		$data = array(
			'kode_konsumen' 	=> $this->input->post('kode_konsumen'),
			'nama_konsumen' 	=> $this->input->post('nama_konsumen'),
			'alamat_konsumen' 	=> $this->input->post('alamat_konsumen'),
			'no_telp'			=> $this->input->post('no_telp')
		);
		$query = $this->db->insert('konsumen', $data);
		if ($query = true) {
			$this->session->set_flashdata(
				'massage',
				'Data Konsumen Berhasil di Simpan'
			);
			redirect('konsumen');
		}
	}

	public function edit($id)
	{
		$isi['content'] = 'backend/konsumen/e_konsumen';
        $isi['judul'] = 'Form Edit konsumen';
        $isi['konsumen'] = $this->m_konsumen->edit($id);
		$this->load->view('backend/dashboard', $isi);
	}

	public function update()
	{
		$kd_konsumen = $this->input->post('kode_konsumen');
		$data = array(
			'kode_konsumen' 	=> $this->input->post('kode_konsumen'),
			'nama_konsumen' 	=> $this->input->post('nama_konsumen'),
			'alamat_konsumen' 	=> $this->input->post('alamat_konsumen'),
			'no_telp'			=> $this->input->post('no_telp')
		);
		$query = $this->m_konsumen->update($kd_konsumen, $data);
		if ($query = true) {
			$this->session->set_flashdata(
				'massage',
				'Data Konsumen Berhasil di Edit'
			);
			redirect('konsumen');
		}
	}

	public function delete($id)
	{
		$query = $this->m_konsumen->delete($id);
		if ($query = true) {
			$this->session->set_flashdata(
				'massage',
				'Data Konsumen Berhasil di Delete'
			);
			redirect('konsumen');
		}
	}
}
