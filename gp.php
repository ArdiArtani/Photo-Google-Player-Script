<?php
function curl($url) {
	$ch = @curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	$page = curl_exec($ch);
	curl_close($ch);
	return $page;
}
function posterImg($url, $size = "1280,720") { //poster size width,height
$internalErrors = libxml_use_internal_errors(true);
$ch = curl_init();
$timeout = 30;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
curl_close($ch);
$sizes = explode(",",$size);
$dom = new DOMDocument();
@$dom->loadHTML($html);
libxml_use_internal_errors($internalErrors);
$maximgx = 1;
$imgx = "";
foreach($dom->getElementsByTagName('img') as $element) {
($maximgx <= 1) ? $maximgx++ && $imgx = $element->getAttribute('src') : ''; 
}
$xim = str_replace("=w214-h120-k-no","=w".$sizes[0]."-h".$sizes[1]."-no",$imgx);
return $xim;    
}
function getPhotoGoogle($link){
	$get = curl($link);
	$data = explode('url\u003d', $get);
	$url = explode('%3Dm', $data[1]);
	$decode = urldecode($url[0]);
	$count = count($data);
	$linkDownload = array();
	$v1080p = $decode.'=m37';
	$v720p = $decode.'=m22';
	$v360p = $decode.'=m18';
	if($count > 7) {
		$linkDownload['1080p'] = $v1080p;
		$linkDownload['720p'] = $v720p;
		$linkDownload['360p'] = $v360p;
	} else if($count > 3) {
		$linkDownload['720p'] = $v720p;
		$linkDownload['360p'] = $v360p;
	} else if($count > 2) {
		$linkDownload['360p'] = $v360p;
	}

	foreach ($linkDownload as $key => $l){
		$files .= '{"type": "video/mp4", "label": "'.$key.'", "file": "'.$l.'"},';
	}

	if(@!$files) {
		$files = '{"type": "video/mp4", "label": "HD", "file": "'.$decode .'=m18'.'"}';
	}else{
		return '['.rtrim($files, ',').']';
	}
}

function fetch_value($str, $find_start = '', $find_end = ''){
	if ($find_start == '') {
			return '';
	}
	$start = strpos($str, $find_start);
	if ($start === false) {
			return '';
	}
	$length = strlen($find_start);
	$substr = substr($str, $start + $length);
	if ($find_end == '') {
			return $substr;
	}
	$end = strpos($substr, $find_end);
	if ($end === false) {
			return $substr;
	}

	return substr($substr, 0, $end);
}

function getURLbyID($id){
	$url="https://goo.gl/photos/$id";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$a = curl_exec($ch); // $a will contain all headers
	$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL
	$photoid = fetch_value(file_get_contents($url), '[null,[["', '",');
	$substr = '?key';
	$fullurl = '/photo/'.$photoid;
	$gpurl = str_replace($substr, $fullurl.$substr, $url);
	return $gpurl;
}

?>
