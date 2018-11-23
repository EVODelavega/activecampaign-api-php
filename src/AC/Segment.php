<?php

class Segment extends ActiveCampaign {

	function list_($params) {
		// version 2 only
		$request_url = "{$this->url_base}/segment/list";
		$response = $this->curl($request_url, $params, "GET", "segment_list");
		return $response;
	}

}

?>