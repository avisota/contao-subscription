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
 * Table orm_avisota_mailing_list
 * Entity Avisota\Contao:MailingList
 */

// Fields
$GLOBALS['TL_DCA']['orm_avisota_mailing_list']['fields']['subscriptions'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['orm_avisota_mailing_list']['subscriptions'],
	'oneToMany' => array(
		'targetEntity' => 'Avisota\Contao\Entity\Subscription',
		'cascade'      => array('persist', 'detach', 'merge', 'refresh'),
		'mappedBy'     => 'mailingList',
	),
);
$GLOBALS['TL_DCA']['orm_avisota_mailing_list']['fields']['blacklists'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['orm_avisota_mailing_list']['blacklists'],
	'oneToMany' => array(
		'targetEntity' => 'Avisota\Contao\Entity\Blacklist',
		'cascade'      => array('persist', 'detach', 'merge', 'refresh'),
		'mappedBy'     => 'mailingList',
	),
);
