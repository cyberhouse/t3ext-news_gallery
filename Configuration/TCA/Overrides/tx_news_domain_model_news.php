<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$columns = array(
	'gallery' => array(
		'exclude' => TRUE,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:cms/locallang_ttc.xlf:file_collections',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'localizeReferencesAtParentLocalization' => TRUE,
			'allowed' => 'sys_file_collection',
			'foreign_table' => 'sys_file_collection',
			'maxitems' => 10,
			'minitems' => 0,
			'size' => 5,
			'wizards' => array(
				'suggest' => array(
					'type' => 'suggest',
				),
			),
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'gallery', '', 'after:related_from');