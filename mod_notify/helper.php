<?php
/**
 * @package         notify.Module
 * @subpackage      mod_notify
 * @copyright       Copyright (C) 2014 minmin.com, Inc. All rights reserved.
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class modNotifyHelper
{

    public static function getNotice(&$params)
    {
        // init db
        // ===========================================================================
        $db     = JFactory::getDbo();
        
        
        // get Joomla! API
        // ===========================================================================
        // $app     = JFactory::getApplication() ;
        $user    = JFactory::getUser() ;
        // $date    = JFactory::getDate( 'now' , JFactory::getConfig()->get('offset') ) ;
        // $uri     = JFactory::getURI() ;
        // $doc     = JFactory::getDocument();
                
        $db->setQuery('SELECT * FROM `#__notify` WHERE `to_id`='.$user->id);
        $notice=$db->loadObjectlist();
        return $notice;
    }
    public static function getItem(&$params)
    {
        $user   = JFactory::getUser() ;  
        $db     = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id','title','created_by', 'created')));
        $query->from($db->quoteName('#__k2_items'));
        $query->where($db->quoteName('created_by') . ' LIKE '. $user->id);
        $query->order($db->quoteName('created') .'DESC');

        $db->setQuery($query);
        $objs=$db->loadObjectlist();
        foreach ($objs as $i => $obj) {
            $items[$i][title]=$obj->title;
            
            $db->setQuery('SELECT * FROM `#__quotation` WHERE `article_id`='.$obj->id);
            $quotations=$db->loadObjectlist();
            $items[$i][Qcount]=sizeof($quotations);
            
            $db->setQuery('SELECT * FROM `#__comment` WHERE `contentid`='.$obj->id);
            $comments=$db->loadObjectlist();
            $items[$i][Tcount]=sizeof($comments);
        }
        
        return $items;
    }

    public static function getBuyTransactions(&$params)
    {
       
        $user   = JFactory::getUser() ;  
        $db     = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id','item_id','buyer_id','seller_id','buyer_status')));
        $query->from($db->quoteName('#__transactions'));
        $query->where($db->quoteName('buyer_id') . ' LIKE '. $user->id);
        $query->order($db->quoteName('created') .'DESC');

        $db->setQuery($query);
        $objs=$db->loadObjectlist();

        foreach ($objs as $i => $obj) {

            $buy_transactions[$i][id]=$obj->id;
            
            $db->setQuery('SELECT * FROM `#__k2_items` WHERE `id`='.$obj->item_id);
            $items=$db->loadObjectlist();
            foreach ($items as $i => $item) {
                $buy_transactions[$i][title]= $item->title;
            }

            $db->setQuery('SELECT * FROM `#__contact` WHERE `account_id`='.$obj->buyer_id);
            $buyer_contact=$db->loadObject();
            $buy_transactions[$i][buyer_contact][name]=$buyer_contact->name;
            $buy_transactions[$i][buyer_contact][phone]=$buyer_contact->phone;
            $buy_transactions[$i][buyer_contact][option_text]=$buyer_contact->option_text;

            $db->setQuery('SELECT * FROM `#__contact` WHERE `account_id`='.$obj->seller_id);
            $seller_contact=$db->loadObject();
            $buy_transactions[$i][seller_contact][name]=$seller_contact->name;
            $buy_transactions[$i][seller_contact][phone]=$seller_contact->phone;
            $buy_transactions[$i][seller_contact][option_text]=$seller_contact->option_text;

            $buy_transactions[$i][buyer_status]=$obj->buyer_status;
        }
        
        return $buy_transactions;
    }

       public static function getSellTransactions(&$params)
    {
       
        $user   = JFactory::getUser() ;  
        $db     = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id','item_id','buyer_id','seller_id','seller_status')));
        $query->from($db->quoteName('#__transactions'));
        $query->where($db->quoteName('seller_id') . ' LIKE '. $user->id);
        $query->order($db->quoteName('created') .'DESC');

        $db->setQuery($query);
        $objs=$db->loadObjectlist();

        foreach ($objs as $i => $obj) {

            $sell_transactions[$i][id]=$obj->id;
            $sell_transactions[$i][item_id]=$obj->item_id;
            
            $db->setQuery('SELECT * FROM `#__k2_items` WHERE `id`='.$obj->item_id);
            $items=$db->loadObjectlist();
            foreach ($items as $i => $item) {
                $sell_transactions[$i][title]= $item->title;
            }

            $db->setQuery('SELECT * FROM `#__contact` WHERE `account_id`='.$obj->buyer_id);
            $buyer_contact=$db->loadObject();
            $sell_transactions[$i][buyer_contact][name]=$buyer_contact->name;
            $sell_transactions[$i][buyer_contact][phone]=$buyer_contact->phone;
            $sell_transactions[$i][buyer_contact][option_text]=$buyer_contact->option_text;

            $db->setQuery('SELECT * FROM `#__contact` WHERE `account_id`='.$obj->seller_id);
            $seller_contact=$db->loadObject();
            $sell_transactions[$i][seller_contact][name]=$seller_contact->name;
            $sell_transactions[$i][seller_contact][phone]=$seller_contact->phone;
            $sell_transactions[$i][seller_contact][option_text]=$seller_contact->option_text;

            $sell_transactions[$i][seller_status]=$obj->seller_status;
        }
        
        return $sell_transactions;
    }
    function getRegister()
    {

        $register=JFactory::getUser();

        return $register;
    }
    
}
