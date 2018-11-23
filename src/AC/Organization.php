<?php
namespace AC;

class Organization extends ActiveCampaign {

    function list_($params, $post_data) {
        $request_url = "{$this->url}&api_action=organization_list&api_output={$this->output}";
        $response = $this->curl($request_url);
        return $response;
    }

}

?>