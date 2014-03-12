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
 * Table orm_avisota_mailing_list
 * Entity Avisota\Contao:MailingList
 */

// Fields
$GLOBALS['TL_DCA']['orm_avisota_mailing_list']['fields']['subscriptions'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['orm_avisota_mailing_list']['subscriptions'],
	'oneToMany' => array(
		'targetEntity' => 'Avisota\Contao\Entity\MessageContent',
		'cascade'      => array('all'),
		'mappedBy'     => 'mailing_list',
	),
);
