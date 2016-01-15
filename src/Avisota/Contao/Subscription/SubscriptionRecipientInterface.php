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

namespace Avisota\Contao\Subscription;

use Avisota\Recipient\RecipientInterface;

/**
 * Interface SubscriptionRecipientInterface
 *
 * @package Avisota\Contao\Subscription
 */
interface SubscriptionRecipientInterface extends RecipientInterface
{
	/**
	 * Return the id
	 * @return mixed
	 */
	public function getId();
}
