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

class SubscribeEvent extends SubscriptionAwareEvent
{
	/**
	 * @var int
	 */
	protected $options;

	function __construct(Subscription $subscription, $options)
	{
		parent::__construct($subscription);
		$this->options = $options;
	}

	/**
	 * @return int
	 */
	public function getOptions()
	{
		return $this->options;
	}
}