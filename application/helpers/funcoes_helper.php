<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

if(!function_exists('set_msg')):
//seta uma mensagem via session para ser lida posteriormente
function set_msg($msg=NULL){
	$ci = & get_instance();
	$ci->session->set_userdata('aviso', $msg);
}
endif;
if(!function_exists('get_msg')):
//retorna uma mensagem definida pela função set_msg
function get_msg($destroy=TRUE){
	$ci = & get_instance();
	$retorno = $ci->session->userdata('aviso');
	if($destroy) $ci->session->unset_userdata('aviso');
	return $retorno;

}
endif;
if(!function_exists('verifica_login')):
	//verifica se o usuário está logado, caso negativa redireciona
	function verifica_login($redirect='setup/login'){
		$ci = & get_instance();
		if(	$ci->session->userdata('logged') != TRUE):
			set_msg('<p>Acesso restrito! Faça login para continuar.</p>');
			redirect($redirect, 'reflesh');
		endif;
	

	}
endif;

if(!function_exists('config_upload')):
	//define as configurações para upload de imagens/arquivos
	function config_upload($path='./uploads/', $types='jpg|png', $size=512){
		$config['upload_path']= $path;
		$config['allowed_types'] = $types;
		$config['max_size'] = $size;
		return $config;
	}
endif;