<?php

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2013 Tristan Lins
 *
 * PHP version 5
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    avisota/contao-core
 * @license    LGPL-3.0+
 * @filesource
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_avisota_settings']['metapalettes']['default']['subscription']         = array(
	'avisota_subscription_cleanup',
);
$GLOBALS['TL_DCA']['tl_avisota_settings']['metasubpalettes']['avisota_subscription_cleanup'] = array
(
	'avisota_subscription_cleanup_days',
);

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_avisota_settings']['fields']['avisota_subscription_cleanup'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_avisota_settings']['avisota_subscription_cleanup'],
	'inputType' => 'checkbox',
	'eval'      => array(
		'submitOnChange' => true,
		'tl_class'       => 'w50 m12'
	)
);

$GLOBALS['TL_DCA']['tl_avisota_settings']['fields']['avisota_subscription_cleanup_days'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_avisota_settings']['avisota_subscription_cleanup_days'],
	'inputType' => 'text',
	'eval'      => array(
		'rgxp'     => 'digit',
		'tl_class' => 'w50',
	)
);
