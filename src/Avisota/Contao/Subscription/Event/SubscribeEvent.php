<?php

/**
 * Avisota newsletter and mailing system
 * Copyright © 2016 Sven Baumann
 *
 * PHP version 5
 *
 * @copyright  way.vision 2016
 * @author     Sven Baumann <baumann.sv@gmail.com>
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
