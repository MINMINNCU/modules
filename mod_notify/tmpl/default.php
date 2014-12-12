
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
		<div id="trans_content" class="subNotify">
			<table class='table'>
				<thead>
				<tr>
					<th></th>
					<th>需求項目</th>
					<th>狀態</th>
					<th>操作</th>
				</tr>
				</thead>
				<?php if($buy_transactions):?>
					<?php foreach ($buy_transactions as $key=>$value): ?>
						<tr class="trans_record">
							<td> 
								<img class='img_contact' src='<?php echo JURI::base(true); ?>/images/contact.png' alt='contact'/>
							</td>
							<td>
	                         	<?php echo $buy_transactions[$key][title] ?>
	                     	</td>
	                     	<td>
	                         	<?php echo $buy_transactions[$key][buyer_status] ?>
	                     	</td>
	                     	<td>
	                         	<div class="transaction">

						         	<?php if($register->id==$author): ?>
						            
							            <input style="visibility: hidden;" type="text" class="Qid" value="<?php echo $quotations[$i]->id; ?>"> <br>
							            <!-- 此需求未接受過報價 -->
							            <?php if(!$accept): ?>
							            <button class='qbtn' name="accept" >接受報價</button>
							            <!-- 此需求接受過報價 但非此報價-->
							            <?php elseif (!($quotations[$i]->accept)):?>
							              <button class='qbtn' name="accept" disabled >接受報價</button>
							            <!-- 此報價已接受 為此報價-->
							            <?php else:?>
							              <button class='qbtn' name="accept" disabled >已報價</button>
							            <?php endif; ?>
							            
							            <span class='result'></span>
						          
						          	<?php endif; ?>

						      	</div>

	                     	</td>
						</tr>
                      <?php endforeach; ?>
				<?php endif?>
			</table>
			<table class='table'>
				<thead>
				<tr>
					<th></th>
					<th>報價項目</th>
					<th>狀態</th>
					<th>操作</th>
				</tr>
				</thead>
				<?php if($sell_transactions):?>
					<?php foreach ($sell_transactions as $key=>$value): ?>
						<tr class="trans_record">
							<td> 
								<img class='img_contact' src='<?php echo JURI::base(true); ?>/images/contact.png' alt='contact'/>
								<div class='contact'>
									<p class='close'>x</p>
									<p>買方</p>
									<form>
										姓名：<input> </input>
										電話：<input> </input>
										備註：<input> </input>
									</form>
									<hr/>
									<p>賣方</p>
									<form>
										姓名：<input> </input>
										電話：<input> </input>
										備註：<input> </input>
									</form>
									<button class="hopscotch-nav-button next hopscotch-next">送出</button>
								</div>
							</td>
							<td>
	                         	<?php echo $sell_transactions[$key][title] ?>
	                     	</td>
	                     	<td>
	                         	<?php echo $sell_transactions[$key][seller_status] ?>
	                     	</td>
						</tr>
                      <?php endforeach; ?>
				<?php endif?>
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
$K2(".trans_record").mouseenter(function(){
  $K2(this).find('img').css('visibility','visible');
});
$K2(".trans_record").mouseleave(function(){
  $K2(this).find('img').css('visibility','hidden');
});
$K2('.img_contact').on('click',function(){
	$K2(this).parent().find('.contact').show();
});
$K2('.close').on('click',function(){
	$K2(this).parent().hide();
});
</script>