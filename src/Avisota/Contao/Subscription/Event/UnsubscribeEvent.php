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
use Avisota\Contao\Entity\Blacklist;
use Symfony\Component\EventDispatcher\Event;

class UnsubscribeEvent extends Event
{
	/**
	 * @var Subscription
	 */
	protected $subscription;

	/**
	 * @var Blacklist|null
	 */
	protected $blacklist;

	function __construct(Subscription $subscription, Blacklist $blacklist = null)
	{
		$this->list = $subscription;
		$this->blacklist = $blacklist;
	}

	/**
	 * @return string
	 */
	public function getSubscription()
	{
		return $this->list;
	}

	/**
	 * @return null
	 */
	public function getBlacklist()
	{
		return $this->blacklist;
	}
}