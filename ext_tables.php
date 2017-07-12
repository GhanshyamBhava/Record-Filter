<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Vehicle.Cars',
            'Fecars',
            'FE Cars'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Cars');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cars_domain_model_cars', 'EXT:cars/Resources/Private/Language/locallang_csh_tx_cars_domain_model_cars.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cars_domain_model_cars');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cars_domain_model_company', 'EXT:cars/Resources/Private/Language/locallang_csh_tx_cars_domain_model_company.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cars_domain_model_company');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cars_domain_model_carclass', 'EXT:cars/Resources/Private/Language/locallang_csh_tx_cars_domain_model_carclass.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cars_domain_model_carclass');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cars_domain_model_flueltype', 'EXT:cars/Resources/Private/Language/locallang_csh_tx_cars_domain_model_flueltype.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cars_domain_model_flueltype');

        /*** FlexForm ***/
        $extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($extKey));
        $pluginSignature = $extensionName.'_fecars';

        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$extKey.'/Configuration/FlexForms/FlexForm.xml');
        /*** FlexForm ***/

        
},
$_EXTKEY

);
