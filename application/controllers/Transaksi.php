<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi');
	}

	public function tambah()
	{
		$isi['content'] = 'backend/transaksi/t_transaksi';
        $isi['judul'] = 'Form Tambah Transaksi';
		$isi['konsumen'] = $this->db->get('konsumen')->result();
		$isi['paket'] = $this->db->get('paket')->result();
		$isi['kode_transaksi'] = $this->m_transaksi->generateKode();
		$this->load->view('backend/dashboard', $isi);
	}

    public function getHargaPaket()
    {
        $kode_paket = $this->input->post('kode_paket');
        $data = $this->m_transaksi->getHargaPaket($kode_paket);
        echo json_encode($data);
    }

	public function simpan()
	{
		$data = array(
			'kode_transaksi' 	=> $this->input->post('kode_transaksi'),
			'kode_konsumen' 	=> $this->input->post('kode_konsumen'),
			'kode_paket'	 	=> $this->input->post('kode_paket'),
			'tgl_masuk' 		=> $this->input->post('tgl_masuk'),	
			'tgl_ambil' 		=> '',
			'berat' 			=> $this->input->post('berat'),
			'grand_total'	 	=> $this->input->post('grand_total'),
			'bayar'	 			=> $this->input->post('bayar'),
			'status'		 	=> $this->input->post('status')
		);
		$query = $this->db->insert('transaksi', $data);
		if ($query = true) {
			$this->session->set_flashdata(
				'massage',
				'Data Transaksi Berhasil di Simpan'
			);
			redirect('transaksi/tambah');
		}
	}


	public function riwayat()
	{
		$isi['content'] = 'backend/transaksi/r_transaksi';
        $isi['judul'] 	= 'Riwayat Transaksi';
		$isi['data']	= $this->m_transaksi->getAllRiwayat();
		$this->load->view('backend/dashboard', $isi);
	}
	

	public function update_status()
	{
		$kode_transaksi = $this->input->post('kt');
		$status = $this->input->post('stt');
		$tgl_ambil = date('Y-m-d');
		$status_bayar = 'Lunas';

		if ($status == "Baru" or $status == "Proses") {
			$this->m_transaksi->update_status($kode_transaksi, $status);
		} 
		else {
			$this->m_transaksi->update_status1($kode_transaksi, $status, $tgl_ambil, $status_bayar);
		}
	}

	public function edit_transaksi($kode_transaksi)
	{
		$isi['content'] = 'backend/transaksi/edit_transaksi';
        $isi['judul'] = 'Form Edit Transaksi';
        $isi['transaksi'] = $this->m_transaksi->edit_transaksi($kode_transaksi);
        $isi['konsumen'] = $this->db->get('konsumen')->result();
        $isi['paket'] = $this->db->get('paket')->result();
		$this->load->view('backend/dashboard', $isi);
	}

	public function update()
	{
		$kode_transaksi = $this->input->post('kode_transaksi');
		$data = array(
			'kode_transaksi' 	=> $this->input->post('kode_transaksi'),
			'kode_konsumen' 	=> $this->input->post('kode_konsumen'),
			'kode_paket' 	=> $this->input->post('kode_paket'),
			'tgl_masuk' 	=> $this->input->post('tgl_masuk'),
			'tgl_ambil' 	=> '',
			'berat' 	=> $this->input->post('berat'),
			'grand_total' 	=> $this->input->post('grand_total'),
			'bayar' 	=> $this->input->post('bayar'),
			'status' 	=> $this->input->post('status')
		);

		$query = $this->m_transaksi->update($kode_transaksi, $data);
		if ($query = true) {
			$this->session->set_flashdata(
				'massage',
				'Data Berhasil di Edit'
			);
			redirect('transaksi/riwayat');
		}
	}

	public function detail($kode_transaksi)
	{
		$isi['title'] = 'Detail Transaksi';
		$isi['transaksi'] = $this->m_transaksi->detail($kode_transaksi);
		$this->load->view('bakcend/transaksi/detail', $isi);

	}
}
