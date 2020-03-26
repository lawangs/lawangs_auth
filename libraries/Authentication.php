<?php if (!defined('BASEPATH')) exit('Akses langsung tidak diperbolehkan');

class Authentication
{
    /**
     * @author 		Faisal Efendi
     * @copyright 	Tenggarong, 10 Oct 2019
     * @uses		Library Login
     * @version		20.03.25
     */

    //the array the settings will be stored as
    public $logged = array();

    // SET SUPER GLOBAL
    var $CI = NULL;
    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->library('session');
        //fire the method loading the data
        $this->initUserSession();
    }

    // Fungsi login
    public function login($username, $password)
    {
        // Cek Apakah user ada di database
        $user = $this->CI->db->get_where('tbl_users', array('user_username' => $username))->row_array();

        // Jika Ada Di Database
        if ($user) {

            //Cek User Status Apakah Aktif
            if ($user['user_is_active'] == '1') {

                // Cek Password User
                if (password_verify($password, $user['user_password'])) {
                    $data =
                        [
                            'username'   => $user['user_username'],
                            'level'      => $user['user_level'],
                            'sessionId' => uniqid(rand())
                        ];
                    $this->CI->session->set_userdata($data);
                    // Update Data Session Ke Database
                    $this->CI->db->update('tbl_users', ['user_session' => $data['sessionId']], array('user_username' => $data['username']));
                    redirect('dashboard');

                    //Jika Password Tidak Cocok
                } else {
                    $this->CI->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                <i class="icon fa fa-check"></i> Invalid Username or Password!
		                </div>'
                    );
                    redirect('auth');
                }

                // Jika User Non-Aktif
            } else {
                $this->CI->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fa fa-check"></i> Username is not active!
                    </div>'
                );
                redirect('auth');
            }


            // User Tidak Ada Di Database
        } else {
            $this->CI->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-check"></i> Invalid Username or Password!
                </div>'
            );
            redirect('auth');
        }
    }


    // Fungsi logout
    public function logout()
    {
        $SessionUser = $this->CI->session->userdata('username');
        $this->CI->db->update('tbl_users', ['user_session' => ''], array('user_username' => $SessionUser));

        $this->CI->session->unset_userdata('username');
        $this->CI->session->unset_userdata('sessionId');
        $this->CI->session->unset_userdata('level');

        redirect('auth');
    }


    // Fungsi cek login
    // Taruh di view paling atas agar halaman terproteksi 
    /* <?php $this->authentication->protect(); ?> */
    public function protect()
    {
        $usernameSession = $this->CI->session->userdata('username');
        $levelSession = $this->CI->session->userdata('level');
        $SessionId = $this->CI->session->userdata('sessionId');

        // Cek Apakah user session ada di database
        $user = $this->CI->db->get_where('tbl_users', array('user_username' => $usernameSession))->row_array();

        // Jika tidak ada didatabase atau session tidak sama dengan random id
        if ($usernameSession == '' || $SessionId != $user['user_session']) {
            $this->CI->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-check"></i> Please login!
                </div>'
            );
            redirect('auth');
        }
    }


    // Fungsi Register
    public function register($post)
    {
        $data = array(
            'user_username'     => $post['username'],
            'user_password'     => password_hash($post['password'], PASSWORD_DEFAULT),
            'user_fullname'     => $post['fullname'],
            'user_email'        => $post['email'],
            'user_level'        => '2',
            'user_create_by'    => 'lawangs',
        );

        $this->CI->db->insert('tbl_users', $data);
    }


    // Fungsi Global Variabel
    public function initUserSession()
    {
        $SessionUser = $this->CI->session->userdata('username');

        //retrieve/set the data
        //returns an associative array of config settings
        $this->logged = $this->CI->db->get_where('tbl_users', ['user_username' => $SessionUser])->row_array();
    }
}
