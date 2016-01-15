<?php

/**
 * Avisota newsletter and mailing system
 * Copyright © 2016 Sven Baumann
 *
 * PHP version 5
 *
 * @copyright  way.vision 2016
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @package    avisota/contao-subscription-recipient
 * @license    LGPL-3.0+
 * @filesource
 */

/**
 * Table orm_avisota_subscription_log
 * Entity Avisota\Contao:SubscriptionLog
 */
$GLOBALS['TL_DCA']['orm_avisota_subscription_log'] = array
(
    // Entity
    'entity' => array(
        'idGenerator' => \Doctrine\ORM\Mapping\ClassMetadataInfo::GENERATOR_TYPE_UUID
    ),
    // Fields
    'fields' => array
    (
        'id'        => array
        (
            'field' => array(
                'id'      => true,
                'type'    => 'string',
                'length'  => '36',
                'options' => array('fixed' => true),
            )
        ),
        'recipient' => array
        (
            'field' => array(
                'type' => 'string',
            )
        ),
        'list'      => array
        (
            'field' => array(
                'type' => 'string',
            )
        ),
        'datetime'  => array
        (
            'field' => array(
                'type'     => 'datetime',
                'nullable' => true,
            )
        ),
    )
);
