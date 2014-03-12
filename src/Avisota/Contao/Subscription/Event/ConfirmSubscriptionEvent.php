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
use Symfony\Component\EventDispatcher\Event;

class ConfirmSubscriptionEvent extends Event
{
	/**
	 * @var Subscription
	 */
	protected $subscription;

	function __construct(Subscription $subscription)
	{
		$this->list = $subscription;
	}

	/**
	 * @return string
	 */
	public function getSubscription()
	{
		return $this->list;
	}
}