<?php

	

	class Buscar{

		public $texto;
		public $resp;

		function quitarCaracteres($texto){			
			
			$resp = htmlspecialchars(trim($texto));

			$this->resp = $resp;

			return $resp;
		}



		function eliminaAcentos() {

	        $text = htmlentities($this->resp, ENT_QUOTES, 'UTF-8');
	        $text = strtolower($text);
	        $patron = array (
	            // Espacios, puntos y comas por guion
	            //'/[\., ]+/' => ' ',
	 
	            // Vocales
	            '/\+/' => '',
	            '/&agrave;/' => 'a',
	            '/&egrave;/' => 'e',
	            '/&igrave;/' => 'i',
	            '/&ograve;/' => 'o',
	            '/&ugrave;/' => 'u',
	 
	            '/&aacute;/' => 'a',
	            '/&eacute;/' => 'e',
	            '/&iacute;/' => 'i',
	            '/&oacute;/' => 'o',
	            '/&uacute;/' => 'u',
	 
	            '/&acirc;/' => 'a',
	            '/&ecirc;/' => 'e',
	            '/&icirc;/' => 'i',
	            '/&ocirc;/' => 'o',
	            '/&ucirc;/' => 'u',
	 
	            '/&atilde;/' => 'a',
	            '/&etilde;/' => 'e',
	            '/&itilde;/' => 'i',
	            '/&otilde;/' => 'o',
	            '/&utilde;/' => 'u',
	 
	            '/&auml;/' => 'a',
	            '/&euml;/' => 'e',
	            '/&iuml;/' => 'i',
	            '/&ouml;/' => 'o',
	            '/&uuml;/' => 'u',
	 
	            '/&auml;/' => 'a',
	            '/&euml;/' => 'e',
	            '/&iuml;/' => 'i',
	            '/&ouml;/' => 'o',
	            '/&uuml;/' => 'u',
	 
	            // Otras letras y caracteres especiales
	            '/&aring;/' => 'a',
	            '/&ntilde;/' => 'n',
	 			'/&lt;/' => '<',
	            // Agregar aqui mas caracteres si es necesario

	        );
	 
	        $text = preg_replace(array_keys($patron),array_values($patron),$text);
	        return $text;
	    }


	}



?>