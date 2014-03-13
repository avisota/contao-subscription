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
use Avisota\Contao\Subscription\SubscriptionRecipientInterface;
use Avisota\Recipient\RecipientInterface;
use Symfony\Component\EventDispatcher\Event;

class PrepareSubscriptionEvent extends Event
{
	/**
	 * @var Subscription
	 */
	protected $subscription;

	/**
	 * @var SubscriptionRecipientInterface
	 */
	protected $recipient;

	function __construct(Subscription $subscription, SubscriptionRecipientInterface $recipient)
	{
		$this->subscription = $subscription;
		$this->recipient = $recipient;
	}

	/**
	 * @return Subscription
	 */
	public function getSubscription()
	{
		return $this->subscription;
	}

	/**
	 * @return \Avisota\Contao\Subscription\SubscriptionRecipientInterface
	 */
	public function getRecipient()
	{
		return $this->recipient;
	}
}