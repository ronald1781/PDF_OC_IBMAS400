<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Home controller class
 * This is only viewable to those members that are logged in
 */

class Home_control extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_isvalidated();
    }

    public function index() {
//        // If the user is validated, then this function will run
//        echo 'Congratulations, you are logged in.';
//        // Add a link to logout
//        echo '<br /><a href=' . base_url() . 'login/home_control/do_logout' . '>Logout Fool!</a>';
    }

    private function check_isvalidated1() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $username = $session_data['username'];
            $codiper = $session_data['codiper'];
            $previ = $session_data['previper'];
            $datos['username'] = $username;
            $datos['codiper'] = $codiper;
            $datos['$previ'] = $previ;
            $datos['titulo'] = 'Principal';
            $datos['contenido'] = 'home_admin_view';
            $this->load->view('/includes/plantilla', $datos);
        } else {
            redirect('login/login_control', 'refresh');
        }
    }

    private function check_isvalidated() {
        if (!$this->session->userdata('validated')) {
            redirect('login/login_control');
        } else {
            $usercod = $this->session->userdata('userid');
            $userper = $this->session->userdata('usuap');
            $userap = $this->session->userdata('apep');
            $userpre = $this->session->userdata('previ');
            if ($userpre == 0) {
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
            }if ($userpre == 1 ||$userpre == 2) {
                $codiper = $usercod;
                $username = $userper;
                $userape = $userap;
                $previ = $userpre;
                $datos['username'] = $username;
                $datos['codiper'] = $codiper;
                $datos['userape'] = $userape;
                $datos['previ'] = $previ;
                $datos['titulo'] = 'Usuario';
                $datos['contenido'] = 'home_user_view';
                $this->load->view('/includes/plantillauser', $datos);
            }
        }
    }

    public function do_logout() {
        $this->session->sess_destroy();
        redirect('login/login_control');
    }

}
?>


