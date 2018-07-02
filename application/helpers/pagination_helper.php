<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	function paginacao($total, $page_segment, $per_page, $url)
	{
		$ci =& get_instance();
		$ci->load->library('pagination');

		$config['base_url'] 		= base_url( $url );
		$config['uri_segment'] 		= $page_segment;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= $per_page ;
		$config['num_links'] 		= 8;
		$config['first_link'] 		= '&laquo; Primeiro';
		$config['first_tag_open'] 	= '<li class="prev page">';
		$config['first_tag_close'] 	= '</li>';
		$config['last_link'] 		= 'Último &raquo;';
		$config['last_tag_open'] 	= '<li class="next page">';
		$config['last_tag_close'] 	= '</li>';
		$config['next_link'] 		= 'Próximo &rarr;';
		$config['next_tag_open'] 	= '<li class="next page">';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_link'] 		= '&larr; Anterior';
		$config['prev_tag_open'] 	= '<li class="prev page">';
		$config['prev_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="active"><a href="">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li class="page">';
		$config['num_tag_close'] 	= '</li>';
		$query_string 				= $_SERVER['QUERY_STRING'];
		$config['suffix'] 			= '?'.$query_string;
		$config['first_url'] 		= $config['base_url'].'?'.$query_string;

		$ci->pagination->initialize($config);

		return $ci->pagination->create_links();
	}
