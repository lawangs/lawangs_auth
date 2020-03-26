<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    /**
     * @author 		Faisal Efendi
     * @copyright 	Tenggarong, 10 Oct 2019
     * @uses		Controller Dashboard
     * @version		20.03.25
     */

    public function index()
    {
        $this->load->view('dashboard_view');
    }
}
