<?php
if (!defined('_GNUBOARD_')) exit;

// SHH https 리다이렉트 www 제거 시작 (24.11.07)
if(!isset($_SERVER["HTTPS"]) || preg_match("/www\./", $_SERVER['HTTP_HOST'])) {
  $HTTP_URL = str_replace('www.','',$_SERVER['HTTP_HOST']);
	header("HTTP/1.1 301 Moved Permanently");
	header("https://".$HTTP_URL.$_SERVER['REQUEST_URI']);	
}
// SHH https 리다이렉트 및 www 제거 끝
?>