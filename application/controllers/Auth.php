<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('user')) {
            redirect(base_url("User"));
        }
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Login";
            $this->load->view('auth/header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('auth/footer', $data);
        } else {
            $username = htmlspecialchars($this->input->post('username', true));
            $password = htmlspecialchars($this->input->post('password', true));
            $user = $this->db->get_where('t_user', ['username' => $username])->row_array();
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'user' => $user['username'], 'role_id' => $user['lvl']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['lvl'] == 1) {
                        redirect(base_url('Admin'));
                    } elseif ($user['lvl'] == 2) {
                        redirect(base_url('Petugas'));
                    } else {
                        redirect(base_url('User'));
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        <strong>Password</strong> Salah!!</div>');
                    redirect(base_url('Auth'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <strong>Username</strong> Tidak Terdaftar!</div>');
                redirect(base_url('Auth'));
            }
        }
    }
    public function registrasi()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'trim|required|is_unique[t_user.username]',
            [
                'is_unique' => 'Username sudah dipakai oleh user lain !!!',
                'required' => 'Input Username kosong keneh'
            ]
        );
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[t_user.email]', [
            'is_unique' => 'Email sudah terdaftar !!!',
            'required' => 'Input Email kosong keneh',
            'valid_email' => 'Ieu mah sanes email'
        ]);
        // $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Daftar Anggota";
            $this->load->view('auth/header', $data);
            $this->load->view('auth/daftar_anggota', $data);
            $this->load->view('auth/footer', $data);
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'title' => htmlspecialchars($this->input->post('nama', true)),
                'email' => $this->input->post('email', true),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'image' => 'user.png',
                'lvl' => 3
            ];
            $this->db->insert('t_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <strong>Registrasi berhasil</strong>, Silahkan untuk <strong>Login</strong> !!!</div>');
            redirect(base_url('Auth'));
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Kamu berhasil Logout!</div>');
        redirect(base_url('Auth'));
    }
    public function blocked()
    {
        $data['judul'] = "error 404";
        $this->load->view('auth/404', $data);
    }
}
