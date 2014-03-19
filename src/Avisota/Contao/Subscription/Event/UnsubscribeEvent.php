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

use Avisota\Contao\Entity\Blacklist;
use Avisota\Contao\Entity\Subscription;

class UnsubscribeEvent extends SubscriptionAwareEvent
{
	/**
	 * @var Blacklist|null
	 */
	protected $blacklist;

	/**
	 * @var int
	 */
	protected $options;

	function __construct(Subscription $subscription, Blacklist $blacklist = null, $options)
	{
		parent::__construct($subscription);
		$this->blacklist = $blacklist;
		$this->options   = $options;
	}

	/**
	 * @param Blacklist|null $blacklist
	 */
	public function setBlacklist(Blacklist $blacklist = null)
	{
		$this->blacklist = $blacklist;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getBlacklist()
	{
		return $this->blacklist;
	}

	/**
	 * @return int
	 */
	public function getOptions()
	{
		return $this->options;
	}
}