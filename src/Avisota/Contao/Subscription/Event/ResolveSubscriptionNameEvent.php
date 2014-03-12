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
use Symfony\Component\EventDispatcher\Event;

class ResolveSubscriptionNameEvent extends Event
{
	const NAME = 'Avisota\Contao\Core\Event\ResolveSubscriptionName';

	/**
	 * @var Subscription
	 */
	protected $subscription;

	/**
	 * @var string
	 */
	protected $subscriptionName;

	function __construct(Subscription $subscription)
	{
		$this->subscription     = $subscription;
		$this->subscriptionName = $subscription->getList();
	}

	/**
	 * @return Subscription
	 */
	public function getSubscription()
	{
		return $this->subscription;
	}

	/**
	 * @param string $name
	 */
	public function setSubscriptionName($name)
	{
		$this->subscriptionName = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getSubscriptionName()
	{
		return $this->subscriptionName;
	}
}