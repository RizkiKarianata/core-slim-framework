<?php

$app->get("/", function($request, $response, $args) {
	$models = [
		"meta_judul_seo"       => configurationSeo("title"),
		"meta_description_seo" => configurationSeo("description"),
		"meta_title"           => configurationSeo("title"),
		"meta_description"     => configurationSeo("description"),
		"meta_keyword"         => configurationSeo("keyword"),
		"meta_url"             => configurationSeo("url"),
		"meta_image"           => configurationSeo("image"),
		"from"                 => "index",
		"detail"               => false,
	];
	return $this->view->render($response, "/pages/home.twig", $models);
});

$app->get("/{alias}", function($request, $response, $args) {
	if($args['alias'] == "example") {

	}else if($args['alias'] == "robots.txt") {
		$newResponse = $response->withHeader('Content-type', 'text/txt');
		return $this->view->render($newResponse, 'robots.txt', []);
	}else if($args['alias'] == "sitemap.xml") {
		$newResponse = $response->withHeader('Content-type', 'text/xml');
		return $this->view->render($newResponse, 'sitemap.xml', []);	
	}else {
		return $this->view->render($response, "/pages/404.twig");	
	}
});

?>