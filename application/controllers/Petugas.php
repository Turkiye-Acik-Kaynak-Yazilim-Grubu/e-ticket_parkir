<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user')) {
            redirect(base_url("Auth"));
        }
    }
    public function index()
    {
        $username = $this->session->userdata('user');
        $data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
        $data['judul'] = "Dashboard";
        $data['pk'] = $this->db->query('SELECT a.*, merk, plat_nomor, title 
                        FROM t_parkir a, t_kendaraan b, t_user c 
                        WHERE a.id_kendaraan = b.id_kendaraan 
                        AND b.id = c.id 
                        AND a.tgl_parkir="' . date("Y-m-d") . '"')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('petugas/index', $data);
        $this->load->view('template/footer');
    }
    function hasil_scan()   //INPUT DATA PARKIR
    {
        $nilai_qr = $this->input->post('no_qr');
        //Mengecek kendaraan tersebut terdaftar atau tidak
        $cek_kendaraan = $this->db->get_where('t_kendaraan', ['nilai_qr' => $nilai_qr]);
        $kendaraan = $this->db->get_where('t_kendaraan', ['nilai_qr' => $nilai_qr])->row_array();
        if ($cek_kendaraan->num_rows() > 0) {  //Jika terdaftar, maka :
            //configurasi waktu
            date_default_timezone_set('Asia/Jakarta');
            $tgl = date("Y-m-d");
            $waktu = date("Y-m-d H:i:s");
            //Mengecek Kendaraan pada tabel parkir berdasarkan id_kndaraan dan tgl_parkir
            $id_kendaraan = $kendaraan['id_kendaraan'];
            $where = ['id_kendaraan' => $id_kendaraan, 'tgl_parkir' => $tgl];
            $cek_parkir = $this->db->get_where('t_parkir', $where)->row_array();
            if ($cek_parkir) {  //data parkir ditemukan, maka :
                //Mengecek apakah kendaraan sudah keluar atau belum
                $where2 = ['id_kendaraan' => $id_kendaraan, 'waktu_keluar' => '0000-00-00 00:00:00'];
                $cek_parkir2 = $this->db->get_Where('t_parkir', $where2)->row_array();
                if ($cek_parkir2) { //jika kendaraan belum keluar, maka :
                    //Melakukan update waktu_keluar pada tabel parkir
                    $data = ['waktu_keluar' => $waktu];
                    $this->db->where($where);
                    $this->db->update('t_parkir', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    <h4><strong>Kendaraan</strong> Keluar !!</h4></div>');
                    redirect(base_url('Petugas'));
                } else { //kendaraan sudah keluar, maka :
                    //Melakukan update waktu_masuk dan waktu_keluar kendaraan
                    $data = ['waktu_masuk' => $waktu, 'waktu_keluar' => '0000-00-00 00:00:00',];
                    $this->db->where($where);
                    $this->db->update('t_parkir', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <h4><strong>Kendaraan</strong> Masuk / Terparkir !!</h4></div>');
                    redirect(base_url('Petugas'));
                }
            } else { //data parkir tidak ditemukan, maka :
                //Melakukan input data pada tabel parkir
                $data = [
                    'id_kendaraan' => $id_kendaraan,
                    'tgl_parkir' => $tgl,
                    'waktu_masuk' => $waktu,
                    'waktu_keluar' => '0000-00-00 00:00:00'
                ];
                $this->db->insert('t_parkir', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <h4><strong> Kendaraan </strong> Terparkir !!</h4></div>');
                redirect(base_url('Petugas'));
            }
        } else { //Kendaraan Tidak Terdaftar
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <h4><strong>' . $nilai_qr . '</strong> Tidak Terdaftar !!!</h4></div>');
            redirect(base_url('Petugas'));
        }
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
        $this->load->view('petugas/parkir', $data);
        $this->load->view('template/footer', $data);
    }
    function del_parkir()   //HAPUS DATA PARKIR
    {
        $id = $this->uri->segment("3");
        $where = ['id_parkir' => $id];
        $cek_parkir = $this->db->get_where('t_parkir', $where)->row_array();
        if ($cek_parkir) {
            $this->db->where($where);
            $this->db->delete('t_parkir');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <strong>Data Parkir</strong> berhasil dihapus !!!</div>');
            redirect(base_url('Petugas/parkir'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <strong>Data Parkir</strong> Tidak Ditemukan !!!</div>');
            redirect(base_url('Petugas/parkir'));
        }
    }
}
