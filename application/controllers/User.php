<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['kendaraan'] = $this->db->get_where('t_kendaraan', ['id' => $data['user']['id']])->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('anggota/index', $data);
        $this->load->view('template/footer');
    }
    public function kendaraanKu()
    {
        $username = $this->session->userdata('user');
        $data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
        $data['judul'] = "Kendaraan";
        $data['kendaraan'] = $this->db->query('SELECT a.*, jenis_kendaraan
								FROM t_kendaraan a, t_jenis_kendaraan b, t_user c 
								WHERE a.id_jenis_kendaraan = b.id_jenis 
                                AND a.id = c.id 
                                AND a.id = "' . $data['user']['id'] . '"')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('anggota/kendaraan', $data);
        $this->load->view('template/footer', $data);
    }
    public function i_kendaraan()   //INPUT KENDARAAN
    {
        $this->form_validation->set_rules('merk', 'Merk', 'trim');
        $this->form_validation->set_rules(
            'plat',
            'Plat Nomor',
            'trim|is_unique[t_kendaraan.plat_nomor]',
            ['in_unique' => 'Plat nomor ini sudah terdaftar']
        );
        $username = $this->session->userdata('user');
        $data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Tambah Kendaraan";
            $data['jns'] = $this->db->get('t_jenis_kendaraan')->result_array();
            $this->load->view('template/header', $data);
            $this->load->view('anggota/i_kendaraan', $data);
            $this->load->view('template/footer', $data);
        } else {
            $plat_nomor = htmlspecialchars($this->input->post('plat', true));   //plat nomor
            $nilai_qr = $plat_nomor;            //nilai_qr
            //CONFIGURASI QRCODE
            $this->load->library('ciqrcode');
            $config['cacheable'] = true;
            $config['cachedir'] = './assets/';
            $config['errorlog'] = './assets/';
            $config['imagedir'] = './assets/images/qrcode/';
            $config['quality'] = true;
            $config['size'] = '1024';
            $config['black'] = array(0, 0, 255);
            $config['white'] = array(70, 130, 180);
            $this->ciqrcode->initialize($config);
            $file_qr = $plat_nomor . '.png';     //nama file image qrcode
            $params['data'] = $nilai_qr;            //nilai qrcode
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $file_qr;
            $this->ciqrcode->generate($params);
            //INPUT DATA
            $data2 = [
                'id_jenis_kendaraan' => htmlspecialchars($this->input->post('jns', true)),
                'merk' => htmlspecialchars($this->input->post('merk', true)),
                'plat_nomor' => $plat_nomor,
                'qrcode' => $file_qr,
                'nilai_qr' => $nilai_qr,
                'id' => $data['user']['id']
            ];
            $this->db->insert('t_kendaraan', $data2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <strong>Kendaraan Anda</strong>, berhasil ditambahkan !!!</div>');
            redirect(base_url('User/kendaraanKu'));
        }
    }
    function del_kendaraan()    //HAPUS KENDARAAN
    {
        $id = $this->uri->segment("3");
        $where = ['id_kendaraan' => $id];
        //Mengecek id_kendaraan terdaftar atau tidak di t_kendaraan
        $kendaraan = $this->db->get_where('t_kendaraan', $where)->row_array();
        if ($kendaraan) { //jika terdaftar, maka :
            //Mengurutkan kendaraan yang terkait dengan user yg akan dihapus
            $parkir = $this->db->get_where('t_parkir', $where)->result_array();
            foreach ($parkir as $p) {
                //Menghapus data parkir berdasarkan id_kendaraan
                $this->db->delete('t_parkir', ['id_kendaraan' => $p['id_kendaraan']]);
            }
            //Menghapus file qrcode yang ada di folder
            unlink('./assets/images/qrcode/' . $kendaraan['qrcode']);
            //Menghapus data kendaraan berdasarkan id user
            $this->db->delete('t_kendaraan', $where);
            //Notifikasi Data User sudah Terhapus
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <strong>Data Kendaraan</strong> berhasil dihapus !!!</div>');
            redirect(base_url('User/kendaraanKu'));
        } else { //Jika tidak terdaftar, maka :
            //Notifikasi Data user tidak ditemukan
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <strong>Data Kendaraan</strong> Tidak Ditemukan !!!</div>');
            redirect(base_url('User/kendaraanKu'));
        }
    }
    function e_kendaraan()  //EDIT KENDARAAN
    {
        $id = $this->uri->segment("3");
        $where = ['id_kendaraan' => $id];
        $kendaraan = $this->db->get_where('t_kendaraan', $where)->row_array();
        if ($kendaraan) {
            $this->form_validation->set_rules('merk', 'Merk', 'trim');
            $this->form_validation->set_rules('plat', 'Plat Nomor', 'trim');
            $username = $this->session->userdata('user');
            $data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
            if ($this->form_validation->run() == false) {
                $data['judul'] = "Edit Kendaraan";
                $data['jns'] = $this->db->get('t_jenis_kendaraan')->result_array();
                $data['kn'] = $kendaraan;
                $this->load->view('template/header', $data);
                $this->load->view('anggota/e_kendaraan', $data);
                $this->load->view('template/footer', $data);
            } else {
                unlink('./assets/images/qrcode/' . $kendaraan['qrcode']);
                $plat_nomor = htmlspecialchars($this->input->post('plat', true));
                //CONFIGURASI QRCODE
                $this->load->library('ciqrcode');
                $config['cacheable'] = true;
                $config['cachedir'] = './assets/';
                $config['errorlog'] = './assets/';
                $config['imagedir'] = './assets/images/qrcode/';
                $config['quality'] = true;
                $config['size'] = '1024';
                $config['black'] = array(0, 0, 255);
                $config['white'] = array(70, 130, 180);
                $this->ciqrcode->initialize($config);
                $file_qr = md5($plat_nomor) . '.png';     //nama file image qrcode
                $params['data'] = $plat_nomor;            //nilai qrcode
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH . $config['imagedir'] . $file_qr;
                $this->ciqrcode->generate($params);
                //INPUT DATA
                $data = [
                    'id_jenis_kendaraan' => htmlspecialchars($this->input->post('jns', true)),
                    'merk' => htmlspecialchars($this->input->post('merk', true)),
                    'plat_nomor' => $plat_nomor,
                    'qrcode' => $file_qr,
                    'id' => $data['user']['id']
                ];
                $this->db->where($where);
                $this->db->update('t_kendaraan', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <strong>Kendaraan Anda</strong>, berhasil diubah !!!</div>');
                redirect(base_url('User/kendaraanKu'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <strong>Data Kendaraan</strong> Tidak Ditemukan !!!</div>');
            redirect(base_url('User/kendaraanKu'));
        }
    }
    public function profile()
    {
        $username = $this->session->userdata('user');
        $data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
        $data['judul'] = "Profile";
        $this->load->view('template/header', $data);
        $this->load->view('anggota/profile', $data);
        $this->load->view('template/footer');
    }
    public function e_profile()
    {
        $username = $this->session->userdata('user');
        $data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
        $this->form_validation->set_rules('nama', 'Nama', 'trim');  //title
        $this->form_validation->set_rules('almt', 'Alamat', 'trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|valid_email',
            ['valid_email' => 'Kabener nulis Email na !!!!']
        );
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Edit Profile";
            $this->load->view('template/header', $data);
            $this->load->view('anggota/e_profile', $data);
            $this->load->view('template/footer', $data);
        } else {
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {    //Mengecek apakah terdapat file yang di upload atau tdk
                $config['upload_path'] = './assets/images/';    //lokasi simpan file
                $config['allowed_types'] = 'jpg|png';   //Type file
                $config['max_size']     = '2048';      //Max.size file

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'user.png') {     //Menghapus file lama
                        unlink(FCPATH . 'assets/images/' . $old_image);
                    }
                    //Update kolom image pada tabel user 
                    $data1 = ['image' => $this->upload->data('file_name')];
                    $where = ['id' => $data['user']['id']];
                    $this->db->set($data1);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        <strong>File</strong>, gagal di Upload !!!</div>');
                    redirect(base_url('User/profile'));
                }
            }
            $data2 = [
                'title' => htmlspecialchars($this->input->post('nama', true)),
                'email' => $this->input->post('email', true),
                'alamat' => htmlspecialchars($this->input->post('almt', true))
            ];
            $where = ['id' => $data['user']['id']];
            //UPDATE DATA
            $this->db->set($data2);
            $this->db->where($where);
            $this->db->update('t_user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <strong>Profile Anda</strong>, berhasil diubah !!!</div>');
            redirect(base_url('User/profile'));
        }
    }
    function p_e_profile()
    {
        $username = $this->session->userdata('user');
        $data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
    }
    function e_password()
    {
        $username = $this->session->userdata('user');
        $data['user'] = $this->db->get_where('t_user', ['username' => $username])->row_array();
        //RULES INPUT PASSWORD
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim');
        $this->form_validation->set_rules(
            'new_password1',
            'New Password',
            'trim|min_length[6]|max_length[10]',
            [
                'min_length' => 'Password nu tengah Pondok teuing !!!',
                'max_length' => 'Password nu tengah Panjang teuing !!!'
            ]
        );
        $this->form_validation->set_rules(
            'new_password2',
            'Confirm New Password',
            'trim|min_length[6]|max_length[10]|matches[new_password1]',
            [
                'min_length' => 'Password nu tengah Pondok teuing !!!',
                'max_length' => 'Password nu tengah Panjang teuing !!!',
                'matches' => 'New Password jng Confirm Password Henteu Sami !!!'
            ]
        );
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Ubah Password";
            $this->load->view('template/header', $data);
            $this->load->view('anggota/e_password', $data);
            $this->load->view('template/footer', $data);
        } else {
            $current = $this->input->post('current_password');
            $new = $this->input->post('new_password1');
            //Memeriksa keseuaian password lama
            if (!password_verify($current, $data['user']['password'])) { //jika tidak sesuai, maka :
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <strong>Current Password</strong>, salah !!!</div>');
                redirect(base_url('User/e_password'));
            } else { //jika sesuai, maka :
                $data2 = [
                    'password' => password_hash($new, PASSWORD_DEFAULT)
                ];
                $where = ['id' => $data['user']['id']];
                $this->db->set($data2);
                $this->db->where($where);
                $this->db->update('t_user');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <strong>Password</strong>, berhasil diubah !!!</div>');
                redirect(base_url('User/profile'));
            }
        }
    }
}
