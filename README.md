Messages
========

The Messages module for the Yii framework allows you use private messages in
your application.

Features include:
- basic private messages functionality
- autosuggest
- custom themes support
- simple integration

Requirements
------------

This has been tested with 1.1.8, but should work with any version.

В вашей модели пользователя нужно определить несколько методов необходимых для
MessageModule (об этом ниже).

Если вы хотите использовать в модуле default layout, удостоверьтесь что он
задан через double slash("//"). Usually default layout is defined in basic controller class.

    // class Controller
    public $layout='//layouts/column1';

Configuration
-------------

Создайте необходимые таблицы, использую SQL из файла data/message.sql

Настройки секции modules для конфига:

    return array(
       'modules' => array(
         'message' => array(
            'userModel' => 'User',
            'getNameMethod' => 'getFullName',
            'getSuggestMethod' => 'getSuggest',
         ),
       ),
    );


Для использования модуля необходимо указать модель пользователя используемую в
приложении `MessageModule::userModel`.

Если необходимо, укажите relations для sender и receiver
`MessageModule::senderRelation and MessageModule::receiverRelation`.

    'receiverRelation' => array(
        CActiveRecord::BELONGS_TO, 'MyUserModel',
        '',
        'on' => 'MyUserModel.my_custom_id = receiver_id'
    )

Если вы не используете встроенную в Yii assets functionality, то вам нужно
будет подключить библиотеки jQuery and jQuery UI(with styles), их можно найти
в папке модуля.

Insert items into zii.widgets.CMenu array (protected/views/layouts/main.php)

	array('url' => Yii::app()->getModule('message')->inboxUrl,
		'label' => 'Messages' . (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) ?
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
Если вас не устраивают стандартные views, вы легко можете заменить их на свои,
указав путь к папке с ними через `MessageModule::viewPath`.

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
Возможно определять получателя сообшения при помоши ссылки (например,
размешенной на странице его профайла). Для этого необходимо указать id
получателя в конце url

    http://example.com/message/compose/1

В этом случае имя поучателя подставится в форму автоматически.
