<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function proses_login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $sess = array(
                    'id_user' => $id_user,
                    'username' => $username,
                    'password' => $password
                );
                $this->session->set_userdata($sess);
            }
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('massage',
                '<div class="alert alert-danger" role="alert">Login Gagal, 
                Silahkan Periksa Kembali Username dan Password Anda ! </div>'
                );
            redirect('panel');
        }
	}
}
