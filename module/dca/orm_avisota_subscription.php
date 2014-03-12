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

use ContaoCommunityAlliance\Contao\Events\CreateOptions\CreateOptionsEventCallbackFactory;

/**
 * Table orm_avisota_subscription
 * Entity Avisota\Contao:Subscription
 */
$GLOBALS['TL_DCA']['orm_avisota_subscription'] = array
(
	// Entity
	'entity'     => array(
		'idGenerator' => \Doctrine\ORM\Mapping\ClassMetadataInfo::GENERATOR_TYPE_NONE,
	),
	// Config
	'config'     => array
	(
		'dataContainer' => 'General',
	),
	// DataContainer
	'dca_config' => array
	(
		'data_provider' => array
		(
			'default' => array
			(
				'class'  => 'Contao\Doctrine\ORM\DataContainer\General\EntityDataProvider',
				'source' => 'orm_avisota_subscription'
			),
		),
	),
	// List
	'list'       => array
	(
		'sorting'           => array
		(
			'mode'        => 1,
			'fields'      => array('list'),
			'panelLayout' => 'filter;search,limit',
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'       => 'act=select',
				'class'      => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations'        => array
		(
			'show' => array
			(
				'label' => &$GLOBALS['TL_LANG']['orm_avisota_subscription']['show'],
				'href'  => 'act=show',
				'icon'  => 'show.gif'
			),
		),
	),
	// Fields
	'fields'     => array
	(
		'id'              => array(
			'field' => array(
				'id'      => true,
				'type'    => 'string',
				'length'  => '32',
				'options' => array('fixed' => true),
			)
		),
		'createdAt'       => array(
			'label' => &$GLOBALS['TL_LANG']['orm_avisota_subscription']['createdAt'],
			'field' => array(
				'type'          => 'datetime',
				'nullable'      => true,
				'timestampable' => array('on' => 'create')
			),
		),
		'updatedAt'       => array(
			'label' => &$GLOBALS['TL_LANG']['orm_avisota_subscription']['updatedAt'],
			'field' => array(
				'type'          => 'datetime',
				'nullable'      => true,
				'timestampable' => array('on' => 'update')
			),
		),
		'recipientType'   => array
		(
			'label' => &$GLOBALS['TL_LANG']['orm_avisota_subscription']['recipient'],
			'field' => array(
				'key'    => true,
				'type'   => 'text',
				'length' => '512',
			),
		),
		'recipientId'     => array
		(
			'label' => &$GLOBALS['TL_LANG']['orm_avisota_subscription']['recipient'],
			'field' => array(
				'key'    => true,
				'type'   => 'text',
				'length' => '512',
			),
		),
		'mailingList'     => array
		(
			'label'     => &$GLOBALS['TL_LANG']['orm_avisota_subscription']['mailingList'],
			'manyToOne' => array(
				'index'        => true,
				'targetEntity' => 'Avisota\Contao\Entity\Message',
				'cascade'      => array('persist', 'detach', 'merge', 'refresh'),
				'inversedBy'   => 'subscriptions',
				'joinColumns'  => array(
					array(
						'name'                 => 'mailingList',
						'referencedColumnName' => 'id',
						'nullable'             => true,
					)
				)
			),
		),
		'active'          => array
		(
			'label'   => &$GLOBALS['TL_LANG']['orm_avisota_subscription']['active'],
			'default' => false,
			'field'   => array(
				'type' => 'boolean',
			),
		),
		'activationToken' => array
		(
			'label' => &$GLOBALS['TL_LANG']['orm_avisota_subscription']['activationToken'],
			'field' => array(
				'type'     => 'string',
				'length'   => '32',
				'options'  => array('fixed' => true),
				'nullable' => true,
			),
		),
		'activatedOn'     => array
		(
			'label' => &$GLOBALS['TL_LANG']['orm_avisota_subscription']['activatedOn'],
			'field' => array(
				'type'     => 'datetime',
				'nullable' => true,
			),
		),
	)
);
