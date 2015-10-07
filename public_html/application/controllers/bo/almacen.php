<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class almacen extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model('bo/modelo_dashboard');
		$this->load->model('bo/modelo_almacen');
		$this->load->model('bo/general');
	}
	
	function index() {
		if (!$this->tank_auth->is_logged_in())
		{																		// logged in
		redirect('/auth');
		}
		
		$id=$this->tank_auth->get_user_id();
		$usuario=$this->general->get_username($id);
		
		if($this->general->isAValidUser($id,"comercial")||$this->general->isAValidUser($id,"logistica"))
		{
		}else{
			redirect('/auth/logout');
		}
		
		$style=$this->modelo_dashboard->get_style(1);
		
		$this->template->set("usuario",$usuario);
		$this->template->set("style",$style);
		$this->template->set("type",$usuario[0]->id_tipo_usuario);
		
		$this->template->set_theme('desktop');
		$this->template->set_layout('website/main');
		$this->template->set_partial('header', 'website/bo/header');
		$this->template->set_partial('footer', 'website/bo/footer');
		$this->template->build('website/bo/logistico2/almacen/index');
	}
	
	function alta() {
		if (!$this->tank_auth->is_logged_in())
		{																		// logged in
		redirect('/auth');
		}
		
		$id=$this->tank_auth->get_user_id();
		$usuario=$this->general->get_username($id);
		
		if(!$this->general->isAValidUser($id,"logistica"))
		{
			redirect('/auth/logout');
		}
		
		$style=$this->modelo_dashboard->get_style(1);
		
		$this->template->set("usuario",$usuario);
		$this->template->set("style",$style);
		$this->template->set("type",$usuario[0]->id_tipo_usuario);
		
		$this->template->set_theme('desktop');
		$this->template->set_layout('website/main');
		$this->template->set_partial('header', 'website/bo/header');
		$this->template->set_partial('footer', 'website/bo/footer');
		$this->template->build('website/bo/logistico2/almacen/alta');
	}
	
	function crear_almacen() {
		$almacen = array(
				'nombre' => $_POST['nombre'],
				'descripcion' => $_POST['descripcion'],
				'ciudad' => $_POST['ciudad'],
				'direccion' => $_POST['direccion'],
				'telefono' => $_POST['telefono'],
		);
		
		if($this->validar_almacen($almacen)){
			
			$this->modelo_almacen->crear_almacen($almacen);
		}
		redirect('/bo/almacen/listar');
	}
	
	function validar_almacen($almacen){
		$error = '';
		if($almacen['nombre'] == ''){
			$error = "El nombre del almacen es obligatorio";
		}elseif ($almacen['descripcion'] == ''){
			$error = "La descripción del almacen es obligatoria";
		}elseif ($almacen['ciudad'] == ''){
			$error = "La ciudad del almacen es obligatoria";
		}elseif ($almacen['telefono'] == ''){
			$error = "El telefono del almacen es obligatorio";
		}elseif ($almacen['direccion'] == ''){
			$error = "La dirección del almacen es obligatoria";
		}
		
		if($error == ''){
			return true;
		}else{
			$this->session->set_flashdata('error', $error);
			redirect('/bo/almacen/alta');
		}
	}
	
	function validar_almacen_actualizar($almacen){
		$error = '';
		if($almacen['nombre'] == ''){
			$error = "El nombre del almacen es obligatorio";
		}elseif ($almacen['descripcion'] == ''){
			$error = "La descripción del almacen es obligatoria";
		}elseif ($almacen['ciudad'] == ''){
			$error = "La ciudad del almacen es obligatoria";
		}elseif ($almacen['telefono'] == ''){
			$error = "El telefono del almacen es obligatorio";
		}elseif ($almacen['direccion'] == ''){
			$error = "La dirección del almacen es obligatoria";
		}
	
		if($error == ''){
			return true;
		}else{
			echo $error;
			return false;
		}
	}
	
	function listar() {
		if (!$this->tank_auth->is_logged_in())
		{																		// logged in
			redirect('/auth');
		}
		
		$id=$this->tank_auth->get_user_id();
		$usuario=$this->general->get_username($id);
		
		if(!$this->general->isAValidUser($id,"logistica"))
		{
			redirect('/auth/logout');
		}
		
		$style=$this->modelo_dashboard->get_style(1);
		
		$almacenes = $this->modelo_almacen->obtenerAlmacenes();
		$this->template->set("usuario",$usuario);
		$this->template->set("style",$style);
		$this->template->set("almacenes",$almacenes);
		$this->template->set("type",$usuario[0]->id_tipo_usuario);
		$this->template->set_theme('desktop');
		$this->template->set_layout('website/main');
		$this->template->set_partial('header', 'website/bo/header');
		$this->template->set_partial('footer', 'website/bo/footer');
		$this->template->build('website/bo/logistico2/almacen/listar');
	}
	
	function eliminar_almacen(){
		if (!$this->tank_auth->is_logged_in()){																		// logged in
			redirect('/auth');
		}
		
		$id = $_POST['id'];
		
		$this->modelo_almacen->eliminar_almacen($id);
		echo  'El almacen a sido eliminado corectamente';
	}
	
	function cambiar_estado_almacen(){
		if (!$this->tank_auth->is_logged_in()){																		// logged in
			redirect('/auth');
		}
	
		$id = $_POST['id'];
		$estado = $_POST['estado'];
	
		$this->modelo_almacen->cambiar_estado_almacen($id,$estado);
		
	}
	
	function editar_almacen(){
		if (!$this->tank_auth->is_logged_in()){																		// logged in
			redirect('/auth');
		}
		$almacen = $this->modelo_almacen->consultar_almacen($_POST['id']);
		
		$this->template->set("almacen",$almacen);
		$this->template->build('website/bo/logistico2/almacen/editar');
	}
	
	function actualizar_almacen(){
		
		if(!isset($_POST['web'])){
			$_POST['web'] = 0;
		}
		$almacen = array(
				'nombre' => $_POST['nombre'],
				'descripcion' => $_POST['descripcion'],
				'ciudad' => $_POST['ciudad'],
				'direccion' => $_POST['direccion'],
				'telefono' => $_POST['telefono'],
				'web' => $_POST['web'],
		);
		
		if($this->validar_almacen($almacen)){
				
			$this->modelo_almacen->actualizar_almacen($almacen,$_POST['id']);
			
		}
		redirect('/bo/almacen/listar');
	}
}