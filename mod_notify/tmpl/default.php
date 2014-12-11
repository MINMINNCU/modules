<?php
/**
 * @package         Asikart.Module
 * @subpackage      mod_notify
 * @copyright       Copyright (C) 2012 Asikart.com, Inc. All rights reserved.
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<style type="text/css">
<!--
.chat_wrapper {
	width: 500px;
	margin-right: auto;
	margin-left: auto;
	background: #CCCCCC;
	border: 1px solid #999999;
	padding: 10px;
	font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;
}
.chat_wrapper .message_box {
	background: #FFFFFF;
	height: 150px;
	overflow: auto;
	padding: 10px;
	border: 1px solid #999999;
}
.chat_wrapper .panel input{
	padding: 2px 2px 2px 5px;
}
.system_msg{color: #BDBDBD;font-style: italic;}
.user_name{font-weight:bold;}
.user_message{color: #88B6E0;}
-->
</style>

<?php 
$colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
$user_colour = array_rand($colours);
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script language="javascript" type="text/javascript">  

$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "ws://localhost:9000/demo/server.php"; 	
	websocket = new WebSocket(wsUri); 
	
	websocket.onopen = function(ev) { // connection is open 
		$('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
	}

	$('#send-btn').click(function(){ //use clicks message send button	
		var mymessage = $('#message').val(); //get message text
		var myname = $('#name').val(); //get user name
		
		if(myname == ""){ //empty name?
			alert("Enter your Name please!");
			return;
		}
		if(mymessage == ""){ //emtpy message?
			alert("Enter Some message Please!");
			return;
		}
		
		//prepare json data
		var msg = {
		message: mymessage,
		name: myname,
		color : '<?php echo $colours[$user_colour]; ?>'
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
	});
	
	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var type = msg.type; //message type
		var umsg = msg.message; //message text
		var uname = msg.name; //user name
		var ucolor = msg.color; //color

		if(type == 'usermsg') 
		{
			$('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
		}
		if(type == 'system')
		{
			$('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
		}
		
		$('#message').val(''); //reset text
	};
	
	websocket.onerror	= function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");}; 
	websocket.onclose 	= function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");}; 
});
</script>

<div class="notify-module-wrap<?php echo $moduleclass_sfx; ?>">
    <div class="notify-module-wrap-inner">
        
        <div id="nav">
			<div id="notice_tab" class="tab tab_visited">
				<img src="templates/mynewtemplate/images/notice.png" />
			</div>
			<div id="items_tab" class="tab">
				<img src="templates/mynewtemplate/images/item.png" />
			</div>
			<div id="trans_tab" class="tab"> 
				<img src="templates/mynewtemplate/images/transaction.png" />
			</div> 
		</div>
		<div id="notice_content" class="subNotify">
			<table class="table">
				<thead>
				<tr>
					<th>類別</th>
					<th>內容</th>
				</tr>
				</thead>
				<?php if($notice):?>
					<?php foreach ($notice as $n): ?>
						<tr>
							<td>
	                         	<?php echo $n->type; ?>
	                     	</td>
	                     	<td>
	                         	<?php echo $n->detail; ?>
	                     	</td>
						</tr>
                      <?php endforeach; ?>
				<?php endif?>
			</table>
		</div>
		<div id="item_content" class="subNotify" style="">
			<table class='table'>
				<thead>
				<tr>
					<th>標題</th>
					<th>報價數量</th>
					<th>留言數量</th>
				</tr>
				</thead>
				<?php if($items):?>
					<?php foreach ($items as $key=>$value): ?>
						<tr>
							<td>
	                         	<?php echo $items[$key][title] ?>
	                     	</td>
	                     	<td>
	                         	<?php echo $items[$key][Qcount] ?>
	                     	</td>
	                     	<td>
	                         	<?php echo $items[$key][Tcount] ?>
	                     	</td>
						</tr>
                      <?php endforeach; ?>
				<?php endif?>
			</table>
		</div>
		<div id="trans_content" class="subNotify table" style="">
			<table>
				<thead>
				<tr>
					<th>標題</th>
					<th>人</th>
					<th>狀態</th>
				</tr>
				</thead>

				<tr>
				</tr>
			</table>

<div class="chat_wrapper">
<div class="message_box" id="message_box"></div>
<div class="panel">
<input type="text" name="name" id="name" placeholder="Your Name" maxlength="10" style="width:20%"  />
<input type="text" name="message" id="message" placeholder="Message" maxlength="80" style="width:60%" />
<button id="send-btn">Send</button>
</div>
</div>
		</div>
        
    </div>
</div>

<script type="text/javascript" >
$K2('#notice_tab').on('click',function(){
	$K2('.tab').removeClass('tab_visited');
	$K2('#notice_tab').addClass('tab_visited');
	$K2('.subNotify').hide();
	$K2('#notice_content').show();
});
$K2('#items_tab').on('click',function(){
	$K2('.tab').removeClass('tab_visited');
	$K2('#items_tab').addClass('tab_visited');
	$K2('.subNotify').hide();
	$K2('#item_content').show();
});
$K2('#trans_tab').on('click',function(){
	$K2('.tab').removeClass('tab_visited');
	$K2('#trans_tab').addClass('tab_visited');
	$K2('.subNotify').hide();
	$K2('#trans_content').show();
});
</script>