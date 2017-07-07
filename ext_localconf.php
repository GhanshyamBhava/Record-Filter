<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Vehicle.Cars',
            'Fecars',
            [
                'Cars' => 'list, show, new, create, edit, update, delete, filter',
                'Company' => 'list',
                'CarClass' => 'list',
                'FluelType' => 'list'
            ],
            // non-cacheable actions
            [
                'Cars' => 'create, update, delete, filter',
                'Company' => '',
                'CarClass' => '',
                'FluelType' => ''
            ]
        );

	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					fecars {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_fecars.svg
						title = LLL:EXT:cars/Resources/Private/Language/locallang_db.xlf:tx_cars_domain_model_fecars
						description = LLL:EXT:cars/Resources/Private/Language/locallang_db.xlf:tx_cars_domain_model_fecars.description
						tt_content_defValues {
							CType = list
							list_type = cars_fecars
						}
					}
				}
				show = *
			}
	   }'
	);
    },
    $_EXTKEY
);
