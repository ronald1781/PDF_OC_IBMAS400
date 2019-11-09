<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */

class Login_control extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index($msg = NULL) {

        $data['msg'] = $msg;
        $this->load->view('login/login_view', $data);
    }

    public function process21() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $datos['titulo'] = 'Login_User';
            $datos['contenido'] = 'login_view';
            $this->load->view('includes/plantillalogin', $datos);
        } else {

            $username = $this->security->xss_clean($this->input->post('username'));
            $pass = $this->security->xss_clean($this->input->post('password'));
            $password = md5($pass);

            $this->load->model('login/login_model');

            $result = $this->login_model->validate($username, $password);

            if (!$result) {

                $msg = '<font color=red>Invalid username and/or password!.</font><br />';
                $this->index($msg);
            } else {
                $usercod = $this->session->userdata('userid');
                $userper = $this->session->userdata('usuap');
                $userap = $this->session->userdata('apep');
                $userpre = $this->session->userdata('previ');
                $valid = $this->session->userdata('validated');
                if ($valid == TRUE) {
                    $codiper = $usercod;
                    $username = $userper;
                    $userape = $userap;
                    $previ = $userpre;
                    $datos['username'] = $username;
                    $datos['codiper'] = $codiper;
                    $datos['userape'] = $userape;
                    $datos['previ'] = $previ;
                    $datos['titulo'] = 'Administrador';
                    $datos['contenido'] = 'home_admin_view';
                    $this->load->view('/includes/plantilla', $datos);
                }
            }
        }
    }


    function do_logout() {
        $this->session->sess_destroy();
        redirect('login_control');
    }

}
?>


