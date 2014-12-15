
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

  //送出賣方資料
  $K2('#ssubmit').on('click',function(){
  	var sparent=$K2(this).parent();
  	var sid=sparent.find('.sid').attr('value');
  	var URLs="index.php?option=com_comment&task=quotation.fillSellerContact";

  	$K2.ajax({
  		dataType:'text',
  		url: URLs,
  		data: {id: sid} ,
  		type:"POST",

  		success: function(msg){

  			alert('請在確認雙方資訊後進行交易活動');
  		},

  		error:function(xhr, ajaxOptions, thrownError){ 
  			alert('系統有錯誤發生');
  		}
  	});

  });

	//送出買方資料

  $K2('#bsubmit').submit(function(event){
	var sparent=$K2(this).parent();
	  var sid=sparent.find('.sid').attr('value');
	  var URLs="index.php?option=com_comment&task=quotation.fillBuyerContact";
	  var postData=$K2(this).serializeArray();
	  var name=postData[0].vaule;
	  var phone=postData[1].vaule;
	  var option_text=postData[2].vaule;
	 if (typeof event == "undefined"){
      event = window.event;
   	}
	event.preventDefault(); //STOP default action
    event.unbind(); //unbind. to stop multiple form submit.

  	$K2.ajax({
        dataType:'text',
        url: URLs,
        data: {
        	id: sid,
        	name:name,
        	phone:phone,
        	option_text:option_text
        } ,
        type:"POST",

			success: function(msg){

				alert('請在確認雙方資訊後進行交易活動');
			},

			error:function(xhr, ajaxOptions, thrownError){ 
				alert('系統有錯誤發生');
			}
		});

	});

  //賣方已收款
  $K2('#received_cash').on('click',function(){
  	var sparent=$K2(this).parent();
  	var sid=sparent.find('.sid').attr('value');
  	var URLs="index.php?option=com_comment&task=quotation.receivedCash";

  	$K2.ajax({
  		dataType:'text',
  		url: URLs,
  		data: {id: sid} ,
  		type:"POST",

  		success: function(msg){

  			alert('已通知買方收到款項');

  			$K2(document).find('#received_cash').attr("disabled", true);

  		},

  		error:function(xhr, ajaxOptions, thrownError){ 
  			alert('系統有錯誤發生');
  		}
  	});

  });

  //賣方已出貨
  $K2('#sent_item').on('click',function(){
  	var sparent=$K2(this).parent();
  	var sid=sparent.find('.sid').attr('value');
  	var URLs="index.php?option=com_comment&task=quotation.sentItem";

  	$K2.ajax({
  		dataType:'text',
  		url: URLs,
  		data: {id: sid} ,
  		type:"POST",

  		success: function(msg){

  			alert('已通知買方寄出貨物');

  			$K2(document).find('#sent_item').attr("disabled", true);

  		},

  		error:function(xhr, ajaxOptions, thrownError){ 
  			alert('系統有錯誤發生');
  		}
  	});

  });

  //買方已付款
  $K2('#paid_cash').on('click',function(){
  	var bparent=$K2(this).parent();
  	var bid=bparent.find('.bid').attr('value');
  	var URLs="index.php?option=com_comment&task=quotation.paidCash";

  	$K2.ajax({
  		dataType:'text',
  		url: URLs,
  		data: {id: bid} ,
  		type:"POST",

  		success: function(msg){

  			alert('已通知賣方匯出款項');

  			$K2(document).find('#paid_cash').attr("disabled", true);

  		},

  		error:function(xhr, ajaxOptions, thrownError){ 
  			alert('系統有錯誤發生');
  		}
  	});

  });

   //買方已收貨
  $K2('#received_item').on('click',function(){
   	var bparent=$K2(this).parent();
   	var bid=bparent.find('.bid').attr('value');
   	var URLs="index.php?option=com_comment&task=quotation.receivedItem";

   	$K2.ajax({
   		dataType:'text',
   		url: URLs,
   		data: {id: bid} ,
   		type:"POST",

   		success: function(msg){

   			alert('已通知賣方收到貨物');

   			 $K2(document).find('#received_item').attr("disabled", true);
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

		<div id="trans_content" class="subNotify">
			<!-- 使用者為買家 -->
			<table class='table'>
				<thead>
					<tr>
						<th></th>
						<th>需求項目</th>
						<th>狀態</th>
						<th>操作</th>
					</tr>
				</thead>
				<input style="visibility: hidden;" type="text" id="buyer" value="<?php echo $register->id; ?>"> 
				<?php if($buy_transactions):?>
					<?php foreach ($buy_transactions as $key=>$value): ?>
						<tr class="trans_record">
							<td> 
								<img class='img_contact' src='<?php echo JURI::base(true); ?>/images/contact.png' alt='contact'/>
								<div class='contact'>
									<p class='close'>x</p>
									<p>買方</p>
									<?php if (is_null($buy_transactions[$key][buyer_contact][name])): ?>
										<form id='bsubmit'>
											姓名：<input name='contact_name'/> 
											電話：<input name='contact_phone'/> 
											備註：<input name='contact_option'/>
											<button type='submit'>送出</button>
										</form>
									<?php else: ?>
										姓名：<?php echo $buy_transactions[$key][buyer_contact][name] ?>
										電話：<?php echo $buy_transactions[$key][buyer_contact][phone] ?>
										備註：<?php echo $buy_transactions[$key][buyer_contact][option_text] ?>
										<button>編輯</button>
									<?php endif;?>
									<hr/>
									<p>賣方</p>
									<?php if (is_null($buy_transactions[$key][seller_contact][name])): ?>
										<p>等待對方填寫資料</p>
									<?php else: ?>
										姓名：<?php echo $buy_transactions[$key][seller_contact][name] ?>
										電話：<?php echo $buy_transactions[$key][seller_contact][phone] ?>
										備註：<?php echo $buy_transactions[$key][seller_contact][option_text] ?>
										<button>編輯</button>
									<?php endif;?>
								</div>
							</td>
							<td>
								<?php echo $buy_transactions[$key][title] ?>
							</td>
							<td>
								<?php echo $buy_transactions[$key][buyer_status] ?>
							</td>
							<td>
								<div class="transaction">
									<input style="visibility: hidden;" type="text" class="itemid" value="<?php echo $buy_transactions[$key][item_id]; ?>"> <br>	
									<input style="visibility: hidden;" type="text" class="bid" value="<?php echo $buy_transactions[$key][id]; ?>"> <br>
									<!-- 詢問填寫資料-->
									<?php if ($buy_transactions[$key][buyer_status]=='請填寫資料'):?>
										<button class='bbtn' id="b_info">填寫資料</button>
										<!-- 交易進行中-->
										<?php elseif ($buy_transactions[$key][buyer_status]=='交易進行中'||$buy_transactions[$key][buyer_status]=='賣方交易完成'
										||$buy_transactions[$key][buyer_status]=='賣方已出貨' ||$buy_transactions[$key][buyer_status]=='賣方已收款'):?>
										<button class='bbtn' id="paid_cash">已付款</button>			      
									<?php endif; ?>

									<!-- 交易進行中-->
									<?php if ($buy_transactions[$key][buyer_status]=='交易進行中' ||$buy_transactions[$key][buyer_status]=='賣方交易完成'
										||$buy_transactions[$key][buyer_status]=='賣方已出貨' ||$buy_transactions[$key][buyer_status]=='賣方已收款'):?>
										<button class='bbtn' id="received_item">已收貨</button>
									<?php endif; ?>
									<!-- 交易完成-->
									<?php if ($buy_transactions[$key][buyer_status]=='賣方交易完成'):?>
										<button class='bbtn' id="b_evaluate">評價</button>
									<?php endif; ?>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif?>
			</table>
			<!-- 使用者為賣家 -->
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
									<?php if (is_null($buy_transactions[$key][buyer_contact][name])): ?>
										<p>等待對方填寫資料</p>
										<?php else: ?>
											姓名：<?php echo $buy_transactions[$key][buyer_contact][name] ?>
											電話：<?php echo $buy_transactions[$key][buyer_contact][phone] ?>
											備註：<?php echo $buy_transactions[$key][buyer_contact][option_text] ?>
									<?php endif;?>
									<hr/>
									<p>賣方</p>
									<?php if (is_null($buy_transactions[$key][seller_contact][name])): ?>
										<form>
											姓名：<input> </input>
											電話：<input> </input>
											備註：<input> </input>
											<button>送出</button>
										</form>
									<?php else: ?>
										姓名：<?php echo $buy_transactions[$key][seller_contact][name] ?>
										電話：<?php echo $buy_transactions[$key][seller_contact][phone] ?>
										備註：<?php echo $buy_transactions[$key][seller_contact][option_text] ?>
										<button>編輯</button>
									<?php endif;?>
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
									<?php elseif ($sell_transactions[$key][seller_status]=='交易進行中'|| $sell_transactions[$key][seller_status]=='買方交易完成'
										|| $sell_transactions[$key][seller_status]=='買方已付款' || $sell_transactions[$key][seller_status]=='買方已收貨'):?>
										<button class='sbtn' id="received_cash">已收款</button>
									<?php endif; ?>

									<!-- 確認沒貨 -->
									<?php if($sell_transactions[$key][seller_status]=='對方已接受報價'): ?>
										<button class='sbtn' id="cancel" >取消</button>
										<!-- 交易進行中-->
									<?php elseif ($sell_transactions[$key][seller_status]=='交易進行中'|| $sell_transactions[$key][seller_status]=='買方交易完成'
										|| $sell_transactions[$key][seller_status]=='買方已付款' || $sell_transactions[$key][seller_status]=='買方已收貨'):?>
										<button class='sbtn' id="sent_item">已出貨</button>
									<?php endif; ?>
									<!-- 交易完成-->
									<?php if ($sell_transactions[$key][seller_status]=='買方交易完成'):?>
										<button class='sbtn' id="s_evaluate">評價</button>
									<?php endif; ?>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif?>
			</table>
		</div><!--  end trans_content -->
	</div> <!-- end otify-module-wrap-inner -->
</div> <!-- end notify-module-wrap -->

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