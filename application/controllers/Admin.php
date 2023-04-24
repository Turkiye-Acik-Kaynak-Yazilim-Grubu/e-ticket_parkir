<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user')) {
			redirect(base_url("Auth"));
		}
		if ($this->session->userdata('role_id') != '1') {
			redirect(base_url("Auth/blocked"));
		}
	}
	public function index()
	{
		$username = $this->session->userdata('user');
		$data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
		$data['judul'] = "Dashboard";
		$this->load->view('template/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('template/footer');
	}
	public function daftar_anggota()
	{
		$username = $this->session->userdata('user');
		$data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
		$data['judul'] = "Daftar User";
		$data['users'] = $this->db->get('t_user')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('admin/daftar_user', $data);
		$this->load->view('template/footer', $data);
	}
	public function jenis_kendaraan()
	{
		$username = $this->session->userdata('user');
		$data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
		$data['judul'] = "Jenis Kendaraan";
		$data['jk'] = $this->db->get('t_jenis_kendaraan')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('admin/jenis_kendaraan', $data);
		$this->load->view('template/footer', $data);
	}
	public function kendaraan()
	{
		$username = $this->session->userdata('user');
		$data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
		$data['judul'] = "Kendaraan";
		$data['kendaraan'] = $this->db->query('SELECT a.*, jenis_kendaraan, title 
								FROM t_kendaraan a, t_jenis_kendaraan b, t_user c 
								WHERE a.id_jenis_kendaraan = b.id_jenis 
								AND a.id = c.id ')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('admin/kendaraan', $data);
		$this->load->view('template/footer', $data);
	}
	public function parkir()
	{
		$username = $this->session->userdata('user');
		$data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
		$data['judul'] = "Parkir Kendaraan";
		$data['pk'] = $this->db->query('SELECT a.*, merk, plat_nomor, title 
                        FROM t_parkir a, t_kendaraan b, t_user c 
                        WHERE a.id_kendaraan = b.id_kendaraan 
                        AND b.id = c.id ')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('admin/parkir', $data);
		$this->load->view('template/footer', $data);
	}
	public function i_jenis_kendaraan()	//INPUT JENIS KENDARAAN
	{
		$this->form_validation->set_rules(
			'jns',
			'Jenis Kendaraan',
			'trim|is_unique[t_jenis_kendaraan.jenis_kendaraan]',
			[
				'is_unique' => 'Jenis Kendaraan ini sudah terdaftar!!'
			]
		);

		if ($this->form_validation->run() == false) {
			$username = $this->session->userdata('user');
			$data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
			$data['judul'] = "Tambah Jenis Kendaraan";
			$this->load->view('template/header', $data);
			$this->load->view('admin/i_jenis_kendaraan', $data);
			$this->load->view('template/footer', $data);
		} else {
			$jns = htmlspecialchars($this->input->post('jns', true));
			$data = [
				'jenis_kendaraan' => $jns
			];
			$this->db->insert('t_jenis_kendaraan', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <strong>Jenis Kendaraan</strong>, berhasil ditambahkan !!!</div>');
			redirect(base_url('Admin/jenis_kendaraan'));
		}
	}
	function del_jenis()	//HAPUS JENIS KENDARAAN
	{
		$id = $this->uri->segment("3");
		$where = ['id_jenis' => $id];
		$cek_jenis = $this->db->get_where('t_jenis_kendaraan', $where)->row_array();
		if ($cek_jenis) {
			//Mengubah id_jenis_kendaraan pada t_kendaraan
			$data = ['id_jenis' => '0'];
			$this->db->where($where);
			$this->db->update('t_kendaraan', $data);
			//Menghapus data jenis kendaraan
			$this->db->where($where);
			$this->db->delete('t_jenis_kendaraan');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <strong>Data Parkir</strong> berhasil dihapus !!!</div>');
			redirect(base_url('Admin/jenis_kendaraan'));
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <strong>Data Parkir</strong> Tidak Ditemukan !!!</div>');
			redirect(base_url('Admin/jenis_kendaraan'));
		}
	}
	function del_user()	//HAPUS DATA USER
	{
		$id = $this->uri->segment("3");
		$where = ['id' => $id];
		//Mengecek id terdaftar atau tidak di t_user
		$user = $this->db->get_where('t_user', $where)->row_array();
		if ($user) { //jika terdaftar, maka :
			//Mengurutkan kendaraan yang terkait dengan user yg akan dihapus
			$kendaraan = $this->db->get_where('t_kendaraan', $where)->result_array();
			foreach ($kendaraan as $k) {
				//Menghapus data parkir berdasarkan id_kendaraan
				$this->db->delete('t_parkir', ['id_kendaraan' => $k['id_kendaraan']]);
			}
			//Menghapus data kendaraan berdasarkan id user
			$this->db->delete('t_kendaraan', $where);
			//Menghapus data user
			$this->db->delete('t_user', $where);
			//Notifikasi Data User sudah Terhapus
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <strong>Data User</strong> berhasil dihapus !!!</div>');
			redirect(base_url('Admin/daftar_anggota'));
		} else { //Jika tidak terdaftar, maka :
			//Notifikasi Data user tidak ditemukan
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <strong>Data User</strong> Tidak Ditemukan !!!</div>');
			redirect(base_url('Admin/daftar_anggota'));
		}
	}
	function e_jenis()	//EDIT JENIS KENDARAAN
	{
		$id = $this->uri->segment("3");
		$where = ['id_jenis' => $id];
		$cek_jenis = $this->db->get_where('t_jenis_kendaraan', $where)->row_array();
		if ($cek_jenis) {
			$this->form_validation->set_rules(
				'jns',
				'Jenis Kendaraan',
				'trim|is_unique[t_jenis_kendaraan.jenis_kendaraan]',
				['is_unique' => 'Jenis Kendaraan ini sudah terdaftar!!']
			);
			if ($this->form_validation->run() == false) {
				$username = $this->session->userdata('user');
				$data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
				$data['judul'] = "Edit Jenis Kendaraan";
				$data['jenis'] = $this->db->get_where('t_jenis_kendaraan', ['id_jenis' => $id])->row_array();
				$this->load->view('template/header', $data);
				$this->load->view('admin/e_jenis_kendaraan', $data);
				$this->load->view('template/footer', $data);
			} else {
				$jns = htmlspecialchars($this->input->post('jns', true));
				$data = ['jenis_kendaraan' => $jns];
				$this->db->where($where);
				$this->db->update('t_jenis_kendaraan', $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						<strong>Data Jenis Kendaraan</strong>, berhasil diubah !!!</div>');
				redirect(base_url('Admin/jenis_kendaraan'));
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <strong>Data Jenis Kendaraan</strong> Tidak Ditemukan !!!</div>');
			redirect(base_url('Admin/jenis_kendaraan'));
		}
	}
	//EDIT LEVEL USER
	function e_lvl()
	{
		$id = $this->uri->segment("3");
		$where = ['id' => $id];
		$cek_user = $this->db->get_where('t_user', $where)->row_array();
		if ($cek_user) {
			$username = $this->session->userdata('user');
			$data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
			$data['judul'] = "Edit Level User";
			$data['users'] = $this->db->get_where('t_user', $where)->row_array();
			$this->load->view('template/header', $data);
			$this->load->view('admin/e_lvl', $data);
			$this->load->view('template/footer', $data);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <strong>Data User</strong> Tidak Ditemukan !!!</div>');
			redirect(base_url('Admin/daftar_anggota'));
		}
	}
	function p_e_lvl()
	{
		$id = $this->uri->segment("3");
		$where = ['id' => $id];
		$data = ['lvl' => $this->input->post('lvl')];
		$this->db->where($where);
		$this->db->update('t_user', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						<strong>Level User</strong>, berhasil diubah !!!</div>');
		redirect(base_url('Admin/daftar_anggota'));
	}
}
