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
		<div id="item_content" class="subNotify">
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
		<div id="trans_content" class="subNotify table">
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