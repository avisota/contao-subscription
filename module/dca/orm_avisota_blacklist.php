<?php

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2013 Tristan Lins
 *
 * PHP version 5
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    avisota/contao-subscription-recipient
 * @license    LGPL-3.0+
 * @filesource
 */


/**
 * Table orm_avisota_blacklist
 * Entity Avisota\Contao:RecipientBlacklist
 */
$GLOBALS['TL_DCA']['orm_avisota_blacklist'] = array
(
	// Entity
	'entity' => array(
		'idGenerator' => \Doctrine\ORM\Mapping\ClassMetadataInfo::GENERATOR_TYPE_UUID
	),
	// Fields
	'fields' => array
	(
		'id'            => array(
			'field' => array(
				'id'      => true,
				'type'    => 'string',
				'length'  => '32',
				'options' => array('fixed' => true),
			)
		),
		'recipientType'      => array
		(
			'label' => &$GLOBALS['TL_LANG']['orm_avisota_blacklist']['recipientType'],
			'field' => array(
				'key'    => true,
				'type'   => 'text',
				'length' => '512',
			),
		),
		'recipientEmailHash' => array
		(
			'label' => &$GLOBALS['TL_LANG']['orm_avisota_blacklist']['recipientEmailHash'],
			'field' => array(
				'key'    => true,
				'type'   => 'text',
				'length' => '512',
			),
		),
		'mailingList'        => array
		(
			'label'     => &$GLOBALS['TL_LANG']['orm_avisota_blacklist']['mailingList'],
			'manyToOne' => array(
				'index'        => true,
				'targetEntity' => 'Avisota\Contao\Entity\Message',
				'cascade'      => array('persist', 'detach', 'merge', 'refresh'),
				'inversedBy'   => 'blacklists',
				'joinColumns'  => array(
					array(
						'name'                 => 'mailingList',
						'referencedColumnName' => 'id',
						'nullable'             => true,
					)
				)
			),
		),
	)
);
