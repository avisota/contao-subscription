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

namespace Avisota\Contao\Subscription\Event;

use Avisota\Contao\Entity\Recipient;
use Avisota\Contao\Entity\Subscription;
use Avisota\Recipient\RecipientInterface;
use Symfony\Component\EventDispatcher\Event;

class SubscribeEvent extends Event
{
	/**
	 * @var Subscription
	 */
	protected $subscription;

	/**
	 * @var int
	 */
	protected $options;

	function __construct(Subscription $subscription, $options)
	{
		$this->list = $subscription;
	}

	/**
	 * @return Subscription
	 */
	public function getSubscription()
	{
		return $this->list;
	}

	/**
	 * @return int
	 */
	public function getOptions()
	{
		return $this->options;
	}
}