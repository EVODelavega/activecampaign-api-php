<?php
use AC\ActiveCampaign;
use AC\Arguments\Config;
include 'src/AC/config.php';
$conf = new Config(
	array(
		'url'	=>  'yourURL',
		'apiKey' => 'yourAPIKEY',
		'apiUser'=> 'optionalUserName',
		'apiPAss'=> 'andPassword'
	)
);
	$ac = new ActiveCampaign($conf);
	$out = array();
	/*
	 * TEST API CREDENTIALS.
	 */

	if (!(int)$ac->credentials_test()) {
		echo "<p>Access denied: Invalid credentials (URL and/or API key).</p>";
		exit();
	}
	else {
		$out[] = 'Credentials valid! Proceeding...';
		//echo "<p>Credentials valid! Proceeding...</p>";
	}

	/*
	 * VIEW ACCOUNT DETAILS.
	 */

	$account = $ac->api("user/view?id=1");
	$out[] = $account;
	/*
	echo "<pre>";
	print_r($account);
	echo "</pre>";*/

	/*
	 * ADD NEW LIST.
	 */

	$list = array(
		"name" => "List 3",
		"sender_name" => "My Company",
		"sender_addr1" => "123 S. Street",
		"sender_city" => "Chicago",
		"sender_zip" => "60601",
		"sender_country" => "USA",
	);

	$list_add = $ac->api("list/add", $list);

	if ((int)$list_add->success) {
		// successful request
		$list_id = (int)$list_add->id;
		$out[] = 'List added successfully (ID '.$list_id.')!';
		//echo "<p>List added successfully (ID {$list_id})!</p>";
	}
	else {
		// request failed
		echo "<p>Adding list failed. Error returned: " . $list_add->error . "</p>";
		exit();
	}

	/*
	 * ADD OR EDIT CONTACT (TO THE NEW LIST CREATED ABOVE).
	 */

	$contact = array(
		"email" => "test@example.com",
		"first_name" => "Test",
		"last_name" => "Test",
		"p[{$list_id}]" => $list_id,
		"status[{$list_id}]" => 1, // "Active" status
	);

	$contact_sync = $ac->api("contact/sync", $contact);

	if ((int)$contact_sync->success) {
		// successful request
		$contact_id = (int)$contact_sync->subscriber_id;
		echo "<p>Contact synced successfully (ID {$contact_id})!</p>";
	}
	else {
		// request failed
		echo "<p>Syncing contact failed. Error returned: " . $contact_sync->error . "</p>";
		exit();
	}


	/*
	 * ADD NEW PIPELINE for Deal.
	 */
	$pipeline = [
				'title' => 'test pipeline',
				'currency' => 'usd',
				'autoassign' => 1,
				'users' => [1]  //need to set owners of this deal (person who created this Deal)
			];

	$pipeline_add = $ac->api("deal/pipeline_add", $pipeline);

	if ((int)$pipeline_add->success) {

		$pipelineId = $pipeline_add->id;
		echo "<p>Pipeline added successfully (ID {$pipelineId})!</p>";
	}
	else {
		// request failed
		echo "<p>Adding pipeline failed. Error returned: " . $pipeline_add->error . "</p>";
		exit();
	}



	/*
	 * ADD NEW STAGE for Deal.
	 */
	$stage = [
				'title' => 'test stage123',
				'pipeline' => $pipelineId
			];

	$stage_add = $ac->api("deal/stage_add", $stage);
	if ((int)$stage_add->success) {

		$stageId = $stage_add->id;
		echo "<p>Stage added successfully (ID {$stageId})!</p>";
	}
	else {
		// request failed
		echo "<p>Adding stage failed. Error returned: " . $stage_add->error . "</p>";
		exit();
	}

	
	/*
	 * ADD NEW Deal.
	 */
	$deal = [
				'title' => 'test deal',
				'value' => '100',
				'currency' => 'usd',
				'pipeline' => $pipelineId,
				'stage' => $stageId,
				'contactid' => $contact_id,
			];

	$deal_add = $ac->api("deal/add", $deal);
	if ((int)$deal_add->success) {
		$dealId = $deal_add->id;
		echo "<p>Deal added successfully (ID {$dealId})!</p>";
		echo "<pre>";
		print_r($deal_add);
		echo "</pre>";
	}
	else {
		// request failed
		echo "<p>Adding deal failed. Error returned: " . $deal_add->error . "</p>";
		exit();
	}

	

	/*
	 * ADD NEW EMAIL MESSAGE (FOR A CAMPAIGN).
	 */

	$message = array(
		"format" => "mime",
		"subject" => "Check out our latest deals!",
		"fromemail" => "newsletter@test.com",
		"fromname" => "Test from API",
		"html" => "<p>My email newsletter.</p>",
		"p[{$list_id}]" => $list_id,
	);

	$message_add = $ac->api("message/add", $message);

	if ((int)$message_add->success) {
		// successful request
		$message_id = (int)$message_add->id;
		echo "<p>Message added successfully (ID {$message_id})!</p>";
	}
	else {
		// request failed
		echo "<p>Adding email message failed. Error returned: " . $message_add->error . "</p>";
		exit();
	}

	/*
	 * CREATE NEW CAMPAIGN (USING THE EMAIL MESSAGE CREATED ABOVE).
	 */

	$campaign = array(
		"type" => "single",
		"name" => "July Campaign", // internal name (message subject above is what contacts see)
		"sdate" => "2020-07-01 00:00:00",
		"status" => 1,
		"public" => 1,
		"tracklinks" => "all",
		"trackreads" => 1,
		"htmlunsub" => 1,
		"p[{$list_id}]" => $list_id,
		"m[{$message_id}]" => 100, // 100 percent of subscribers
	);

	$campaign_create = $ac->api("campaign/create", $campaign);

	if ((int)$campaign_create->success) {
		// successful request
		$campaign_id = (int)$campaign_create->id;
		echo "<p>Campaign created and sent! (ID {$campaign_id})!</p>";
	}
	else {
		// request failed
		echo "<p>Creating campaign failed. Error returned: " . $campaign_create->error . "</p>";
		exit();
	}

	/*
	 * VIEW CAMPAIGN REPORTS (FOR THE CAMPAIGN CREATED ABOVE).
	 */

	$campaign_report_totals = $ac->api("campaign/report_totals?campaignid={$campaign_id}");

	echo "<p>Reports:</p>";
	echo "<pre>";
	print_r($campaign_report_totals);
	echo "</pre>";

function __autoload($class)
{
	$ns = explode('\\', $class);
	if ($ns[0] == 'AC')
	{
		$class = array_pop($ns);
		$path = 'src/'.implode('/', $ns).'/';
		if (file_exists($path.$class.'.php'))
			return include $path.$class.'.php';
	}
}

?>

<a href="http://www.activecampaign/api">View more API examples!</a>
