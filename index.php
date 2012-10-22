<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require 'facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '451970521512909',
  'secret' => '13c15fa10074aaeae63b12221138471f',
));

	if ($facebook->getSession()) {
    $user = $facebook->getUser();
	$uid = $facebook->getUser();
	$me = $facebook->api('/me/friends');
	echo "<br>Total friends".sizeof($me['data'])."<br>";
	
	echo "<br> Friends collage<br><br>";
	foreach($me['data'] as $frns)
	{
	echo "<img src="\"https://graph.facebook.com/".$frns['id']."/picture\"" title="\"".$frns['name']."\"/">";
	
}

	
	echo "<br><br><br>	By <br><a href="\"http://facebook.com/mjeyaganesh\""><img src="\"https://graph.facebook.com/1147530774/picture\"" title="\"Jeyaganesh\"/"></a>";

	}
	else {
	$loginUrl = "https://graph.facebook.com/oauth/authorize?type=user_agent&display=page&client_id=APPID
	&redirect_uri=http://apps.facebook.com/CANVAS URL/
	&scope=user_photos"; 
	echo '<fb:redirect url="' . $loginUrl . '"></fb:redirect>';  
}


?>
