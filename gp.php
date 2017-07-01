
<?php

function curl($url)
	{
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
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Expect:'
	));
	$page = curl_exec($ch);
	curl_close($ch);
	return $page;
	}

function getPhotoGoogle($link)
	{
	$get = curl($link);
	$data = explode('url\u003d', $get);
	$url = explode('%3Dm', $data[1]);
	$decode = urldecode($url[0]);
	$count = count($data);
	$linkDownload = array();
	if ($count > 4)
		{
		$v1080p = $decode . '=m37';
		$v720p = $decode . '=m22';
		$v360p = $decode . '=m18';
		$linkDownload['1080p'] = $v1080p;
		$linkDownload['720p'] = $v720p;
		$linkDownload['360p'] = $v360p;
		}

	if ($count > 3)
		{
		$v720p = $decode . '=m22';
		$v360p = $decode . '=m18';
		$linkDownload['720p'] = $v720p;
		$linkDownload['360p'] = $v360p;
		}

	if ($count > 2)
		{
		$v360p = $decode . '=m18';
		$linkDownload['360p'] = $v360p;
		}

	foreach($linkDownload as $l)
		{
		$data = explode('|', $l);
		$files.= '{"type": "video/mp4", "label": "' . $data[1] . '", "file": "' . $data[0] . '"},';
		}

	return '[' . rtrim($files, ',') . ']';
	}
