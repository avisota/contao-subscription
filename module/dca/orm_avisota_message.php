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
 * Table orm_avisota_message
 * Entity Avisota\Contao:Message
 */
$GLOBALS['TL_DCA']['orm_avisota_message']['metasubpalettes']['setRecipients'] = array('recipients');

$GLOBALS['TL_DCA']['orm_avisota_message']['fields']['setRecipients'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['orm_avisota_message']['setRecipients'],
	'inputType' => 'checkbox',
	'eval'      => array('tl_class' => 'clr w50', 'submitOnChange' => true)
);
$GLOBALS['TL_DCA']['orm_avisota_message']['fields']['recipients']    = array
(
	'label'            => &$GLOBALS['TL_LANG']['orm_avisota_message']['recipients'],
	'inputType'        => 'select',
	'options_callback' => CreateOptionsEventCallbackFactory::createCallback('avisota.create-recipient-source-options'),
	'eval'             => array(
		'mandatory' => true,
		'tl_class'  => 'w50'
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
