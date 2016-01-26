<?php

/**
 * Avisota newsletter and mailing system
 * Copyright © 2016 Sven Baumann
 *
 * PHP version 5
 *
 * @copyright  way.vision 2016
 * @author     Sven Baumann <baumann.sv@gmail.com>
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
