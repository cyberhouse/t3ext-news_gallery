<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Simple gallery for ext:news',
	'description' => 'Extend news with file collections',
	'category' => 'fe',
	'author' => 'Georg Ringer',
	'author_email' => 'georg.ringer@cyberhouse.at',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'modify_tables' => 'tx_news_domain_model_news',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author_company' => '',
	'version' => '3.2.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.3-7.9.99',
			'news' => '3.0-3.99.999',
		),
		'conflicts' => array(),
		'suggests' => array(),
	),
	'_md5_values_when_last_written' => '',
	'suggests' => array(),
);
