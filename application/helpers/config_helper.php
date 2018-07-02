<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function getTitle()
	{
		$ci = & get_instance();
		$ci->load->database();

		$ci->db->where('chave','site_title');
		$dados = $ci->db->get('config')->row();
		return $dados->valor;
	}

	function getConfigValue($chave)
	{
		$ci = & get_instance();
		$ci->load->database();

		$ci->db->where('chave', $chave);
		$dados = $ci->db->get('config')->row();
		return $dados->valor;
	}
