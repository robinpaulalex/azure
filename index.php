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

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
	$friends = $facebook->api('/me/friends'); 
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}



?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>SplitEven</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
     <script src="http://connect.facebook.net/en_US/all.js"></script>
     <script type="text/javascript">
  	 FB.init({
    		appId  : '451970521512909',
  	    });

  	 function echoSize() {
    	      document.getElementById('output').innerHTML = 
                 "HTML Content Width: " + window.innerWidth + 
                 " Height: " + window.innerHeight;
    	      console.log(window.innerWidth + ' x ' + window.innerHeight);
  	    }

	   echoSize();
  	   window.onresize = echoSize;
     </script>
	
	<h1>SplitEven</h1>

    

    <h3>Welcome to Split Even</h3>
    
    <?php if ($user): ?>
      <h3>You are <?php echo $user_profile['name']; ?> and you have <?php echo sizeof($friends['data']) ?> friends </h3>
	  
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">
    <div>
	<?php echo $friends['name'] ?>
	</div>
	
	<?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>
	<?php if ($user): ?>
      <pre><a href="<?php echo $logoutUrl; ?>">Logout</a></pre>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>
  </body>
</html>
