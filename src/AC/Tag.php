<?php
namespace AC;

class Tag extends ActiveCampaign {

	function list_($params) {
		$request_url = "{$this->url}&api_action=tags_list&api_output={$this->output}&{$params}";
		$response = $this->curl($request_url);
		return $response;
	}

}

?>