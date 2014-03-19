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

use Avisota\Contao\Entity\Subscription;
use Avisota\Contao\Subscription\SubscriptionRecipientInterface;

class PrepareSubscriptionEvent extends SubscriptionAwareEvent
{
	/**
	 * @var SubscriptionRecipientInterface
	 */
	protected $recipient;

	function __construct(Subscription $subscription, SubscriptionRecipientInterface $recipient)
	{
		parent::__construct($subscription);
		$this->recipient = $recipient;
	}

	/**
	 * @return SubscriptionRecipientInterface
	 */
	public function getRecipient()
	{
		return $this->recipient;
	}
}