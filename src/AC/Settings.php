<?php
namespace AC;

class Settings extends ActiveCampaign {

	function edit($params, $post_data) {
		$request_url = "{$this->url}&api_action=settings_edit&api_output={$this->output}";
		$response = $this->curl($request_url, $post_data);
		return $response;
	}

}

?>