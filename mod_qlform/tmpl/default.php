<?php
/**
 * @package   mod_qlform
 * @copyright Copyright (C) 2014 ql.de All rights reserved.
 * @author    Mareike Riegel mareike.riegel@ql.de
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');

?>

<style type="text/css">

fieldset.additionalFields {display:none;}
.quotation{

  background-color: #F5FFFA;
  opacity: 0.8;
  margin: 6px;
}

</style>


<script>

var $K2 = jQuery.noConflict();
$K2(document).ready(function(){
var pathname = window.location.pathname; // returns path only
var url      = window.location.href;     // returns full url 
  "use strict";
  
  //before qutation submit
  $K2('#mod_qlform_97').submit(function(event) {
    $K2('.q_obj').each(function(i,e){
      //if the user have quotation of this item before
      if( $K2(e).attr('userId')==$K2('#register').attr('value')){
        //prevent submit the form
        event.preventDefault();
        alert("不能重複報價喔");
        return false;
      }
    });
    
    return true;
    
  });

  //accept quotation button click
  $K2('.qbtn').on('click',function(){
  var qparent=$K2(this).parent();
  var qid=qparent.find('.Qid').attr('value');
  var author=$K2('#author').attr('value');
  var URLs="index.php?option=com_comment&task=quotation.acceptQuotation";


  $K2.ajax({
        dataType:'text',
        url: URLs,
        data: {id: qid,buyer:author} ,
        type:"POST",

        success: function(msg){
          $K2(document).find('.qbtn').each(function(){
            $K2(this).attr("disabled", true);
          });
          qparent.find('.qbtn').html("已接受報價");
          // qparent.find('.result').html(msg);
        },

         error:function(xhr, ajaxOptions, thrownError){ 
            alert('bad');

            // alert(xhr.status); 
            // alert(thrownError); 
         }
    });

  });
});


</script>

<div class="qlform<?php echo $moduleclass_sfx; ?>" style="width: auto; height: auto;">

<?php 
$author=$obj_helper->getAuthor($article_id); 
$register=$obj_helper->getRegister();
?>

<input style="display: none;" type="text" id="author" value="<?php echo $author; ?>"> <br>
<input style="display: none;" type="text" id="register" value="<?php echo $register->id; ?>"> <br>

<?php for($i = 0; $i < sizeof($quotations); $i++): 

        $user_id=$quotations[$i]->user_id;
        $user=$obj_helper->getUser($user_id);
        $url='/develop/media/k2/users/'.$user[0]->image;

        ?>
        <div style="float:left; height:auto;  ">
        <img src="<?php echo JURI::base(true); ?>/media/k2/users/<?php echo $user[0]->image; ?>" alt="<?php echo $user->userName; ?>" width="60px" style="margin-top:14px; margin-left:4px; border-radius: 50%; border:1px solid #ccc;"/>
        </div>
        
        <div class="quotation" style="margin-left:85px; width: auto;">

          <input class='q_obj' style="display: none;" userId='<?php echo $user_id; ?>' price='<?php echo $quotations[$i]->quotation; ?>'>
          <div>
            <div style="height:48px; line-height:48px; font-size:17px; float:left; margin-left:12px">報價 “</div>
            <div style="height:48px; line-height:48px; font-size:26px;"><?php echo " ".$quotations[$i]->quotation." ”";?></div>
            <div style="font-size:17px; margin-left:13px;"><?php echo $quotations[$i]->description; ?></div>
          </div>
          
          <p align="right"><?php echo $quotations[$i]->created; ?></p>

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
              <button class='qbtn' name="accept" disabled >已接受報價</button>
            <?php endif; ?>
            
            <span class='result'></span>
          
          <?php endif; ?>

      </div>

      <div>
<?php endfor; ?>
</div>

<?php


if (1==$params->get('stylesActive',0))require JModuleHelper::getLayoutPath('mod_qlform', 'default_styles');
if (1==$emailcloak) echo '{emailcloak=off}'; /*very important; disables email cloaking in email inputs!!!!*/
require JModuleHelper::getLayoutPath('mod_qlform', 'default_copyright');

if ((1==$messageType OR 3==$messageType) AND isset($messages)) require JModuleHelper::getLayoutPath('mod_qlform', 'default_message');
if (0==$params->get('hideform') OR (1==$params->get('hideform') AND  (!isset($validated) OR (isset($validated) AND 0==$validated)))) 
{
  if (1==$showpretext) require JModuleHelper::getLayoutPath('mod_qlform', 'default_pretext');
  if (is_object($form)) require JModuleHelper::getLayoutPath('mod_qlform', 'default_form'.ucwords($params->get('stylesHtmltemplate','htmlpure')));
}
if (1==$params->get('backbool') AND isset($validated)) require JModuleHelper::getLayoutPath('mod_qlform', 'default_back');
if (1==$params->get('authorbool')) require JModuleHelper::getLayoutPath('mod_qlform', 'default_author');
?>
</div>
