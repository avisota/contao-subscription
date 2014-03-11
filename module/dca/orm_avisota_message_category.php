<?php

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2013 Tristan Lins
 *
 * PHP version 5
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    avisota/contao-message
 * @license    LGPL-3.0+
 * @filesource
 */

use ContaoCommunityAlliance\Contao\Events\CreateOptions\CreateOptionsEventCallbackFactory;

/**
 * Table orm_avisota_message_category
 * Entity Avisota\Contao:MessageCategory
 */
$GLOBALS['TL_DCA']['orm_avisota_message_category']['metapalettes']['default']['recipients'] = array('recipientsMode');

$GLOBALS['TL_DCA']['orm_avisota_message_category']['metasubpalettes']['recipientsMode'] = array
(
	'byCategory'          => array('recipients'),
	'byMessageOrCategory' => array('recipients'),
);

$GLOBALS['TL_DCA']['orm_avisota_message_category']['fields']['recipientsMode'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['orm_avisota_message_category']['recipientsMode'],
	'default'   => 'byCategory',
	'inputType' => 'select',
	'options'   => array('byCategory', 'byMessageOrCategory', 'byMessage'),
	'reference' => &$GLOBALS['TL_LANG']['orm_avisota_message_category'],
	'eval'      => array(
		'mandatory'      => true,
		'submitOnChange' => true,
		'tl_class'       => 'clr w50'
	)
);
$GLOBALS['TL_DCA']['orm_avisota_message_category']['fields']['recipients'] = array
(
	'label'            => &$GLOBALS['TL_LANG']['orm_avisota_message_category']['recipients'],
	'inputType'        => 'select',
	'options_callback' => CreateOptionsEventCallbackFactory::createCallback('avisota.create-recipient-source-options'),
	'eval'             => array(
		'mandatory'          => true,
		'includeBlankOption' => true,
		'tl_class'           => 'w50'
	),
	'manyToOne'        => array(
		'targetEntity' => 'Avisota\Contao\Entity\RecipientSource',
		'cascade'      => array('all'),
		'joinColumns'  => array(
			array(
				'name'                 => 'recipientSource',
				'referencedColumnName' => 'id',
			),
		),
	),
);
