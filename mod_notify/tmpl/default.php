
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

<script>

var $K2 = jQuery.noConflict();
$K2(document).ready(function(){

  "use strict";

  //accept transaction button click
  $K2('#accept').on('click',function(){
		var sparent=$K2(this).parent();
	  var sid=sparent.find('.sid').attr('value');
	  var itemid=sparent.find('.itemid').attr('value');
	  var seller=$K2('#seller').attr('value');
	  var URLs="index.php?option=com_comment&task=quotation.confirmTransaction";

  $K2.ajax({
        dataType:'text',
        url: URLs,
        data: {id: sid, seller: seller, item: itemid} ,
        type:"POST",

        success: function(msg){

          	alert('交易成功確立，請開始填寫交易資訊');
        },

         error:function(xhr, ajaxOptions, thrownError){ 
            alert('系統有錯誤發生');
         }
    });

  });

  //cancel transaction button click
  $K2('#cancel').on('click',function(){
		var sparent=$K2(this).parent();
	  var sid=sparent.find('.sid').attr('value');
	  var URLs="index.php?option=com_comment&task=quotation.cancelTransaction";

  $K2.ajax({
        dataType:'text',
        url: URLs,
        data: {id: sid} ,
        type:"POST",

        success: function(msg){

          	alert('交易已取消');
        },

         error:function(xhr, ajaxOptions, thrownError){ 
            alert('系統有錯誤發生');
         }
    });

  });





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
				<input style="visibility: hidden;" type="text" id="seller" value="<?php echo $register->id; ?>"> 

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

	                     	<td>

	                         	<div class="transaction">
						            	
						            	<input style="visibility: hidden;" type="text" class="itemid" value="<?php echo $sell_transactions[$key][item_id]; ?>"> <br>	
							            <input style="visibility: hidden;" type="text" class="sid" value="<?php echo $sell_transactions[$key][id]; ?>"> <br>
							            
							            <!-- 確認有貨 -->
							            <?php if($sell_transactions[$key][seller_status]=='對方已接受報價'): ?>
							            <button class='sbtn' id="accept" >確認進行交易</button>
							            <!-- 詢問填寫資料-->
							            <?php elseif ($sell_transactions[$key][seller_status]=='請填寫資料'):?>
							              <button class='sbtn' id="info">填寫資料</button>
							            <!-- 交易進行中-->
							            <?php elseif ($sell_transactions[$key][seller_status]=='交易進行中'):?>
							              <button class='sbtn' id="received_cash">已收款</button>
							            <!-- 交易完成-->
							            <?php elseif ($sell_transactions[$key][seller_status]=='交易完成'):?>
							              <button class='sbtn' id="evaluate">評價</button>
							        	<?php endif; ?>

								          
							            <!-- 確認沒貨 -->
							            <?php if($sell_transactions[$key][seller_status]=='對方已接受報價'): ?>
							            <button class='sbtn' id="cancel" >取消</button>
							            <!-- 交易進行中-->
							            <?php elseif ($sell_transactions[$key][seller_status]=='交易進行中'):?>
							              <button class='sbtn' id="sent_item">已出貨</button>
							        	<?php endif; ?>

						      	</div>

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