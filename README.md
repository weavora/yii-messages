Messages
========

This Yii Framework module allows you to add quickly private messaging into your application.

**Features included**:

* basic private messaging functionality,
* autosuggest,
* custom themes support,
* simple integration

Requirements
------------

This module was tested with 1.1.8 but should work with any version.

MessageModule requires a couple of methods to be defined in you User model (see below):

If you want to use modules' default layout make sure that it is defined via double slash ("//"). Usually default layout is defined in basic controller class.

    // class Controller
    public $layout='//layouts/column1';

Configuration
-------------

Create necessary tables using SQL file - data/message.sql

There are config settings of modules section below:

    return array(
        'modules' => array(
            'message' => array(
                'userModel' => 'User',
                'getNameMethod' => 'getFullName',
                'getSuggestMethod' => 'getSuggest',
            ),
        ),
    );

In order to use module you should specify **User model** that is used in the application `MessageModule::userModel`.

If necessary, specify relations for **Sender** and **Receiver** `MessageModule::senderRelation` and `MessageModule::receiverRelation`.

	'receiverRelation' => array(
        CActiveRecord::BELONGS_TO, 
        'MyUserModel',
        '',
        'on' => 'MyUserModel.my_custom_id = receiver_id'
     )

If you do not use Yii assets build-in functionality you will need to connect jQuery and jQuery UI(with styles) libraries. You can find them in modules folder.

Insert items into `zii.widgets.CMenu` array (protected/views/layouts/main.php)

    array(
        'url' => Yii::app()->getModule('message')->inboxUrl,
        'label' => 'Messages' .
            (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) ?
                ' (' . Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) . ')' : ''),
        'visible' => !Yii::app()->user->isGuest),

Examples
--------

    // config
    return array(
    'modules' => array(
        'message' => array(
            'userModel' => 'User',
            'getNameMethod' => 'getFullName',
            'getSuggestMethod' => 'getSuggest',
            ),
        ),
    );

    // class User
    public function getFullName() {
        return $this->username;
    }

    public function getSuggest($q) {
    	$c = new CDbCriteria();
    	$c->addSearchCondition('username', $q, true, 'OR');
    	$c->addSearchCondition('email', $q, true, 'OR');
    	return $this->findAll($c);
    }

Custom Views
------------

If you are not satisfied with the standard views you can easily replace them with your own just linking path to their folder through `MessageModule::viewPath`.

    //config
    return array(
        'modules' => array(
            'message' => array(
                ...
                // for app/protected/views/messagesModuleCustom
                'viewPath' => '//messagesModuleCustom',
            ),
        ),
    );

    // app/protected/views/messagesModuleCustom directory listing
    ..
    compose.php
    inbox.php
    sent.php
    view.php

Direct messages
---------------

It is possible to determine each recipient by URL (for example, under user profile page). To do this, you should add his id at the end of URL.

`http://example.com/message/compose/1`

In this case recipients' name will be automatically inserted in the form.
