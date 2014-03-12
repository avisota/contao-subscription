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

namespace Avisota\Contao\Subscription;

class SubscriptionEvents
{
	/**
	 * The SUBSCRIBE event occurs when a recipient subscribe.
	 *
	 * This event allows you to handle the subscription of a recipient. The event listener method receives
	 * a Avisota\Contao\Subscription\Event\SubscribeEvent instance.
	 *
	 * @var string
	 *
	 * @api
	 */
	const SUBSCRIBE = 'avisota.subscription.subscribe';

	/**
	 * The CONFIRM_SUBSCRIPTION event occurs when a recipient confirm his subscription.
	 *
	 * This event allows you to handle the confirmation of a subscription. The event listener method receives
	 * a Avisota\Contao\Subscription\Event\ConfirmSubscriptionEvent instance.
	 *
	 * @var string
	 *
	 * @api
	 */
	const CONFIRM_SUBSCRIPTION = 'avisota.subscription.confirm';

	/**
	 * The UNSUBSCRIBE event occurs when a recipient unsubscribe.
	 *
	 * This event allows you to handle the unsubscribe of a recipient. The event listener method receives
	 * a Avisota\Contao\Subscription\Event\UnsubscribeEvent instance.
	 *
	 * @var string
	 *
	 * @api
	 */
	const UNSUBSCRIBE = 'avisota.subscription.unsubscribe';

	/**
	 * The RESOLVE_RECIPIENT event occurs when the effective recipient instance must received from a subscription.
	 *
	 * The event listener method receives a Avisota\Contao\Subscription\Event\ResolveRecipientEvent instance.
	 *
	 * @var string
	 *
	 * @api
	 */
	const RESOLVE_RECIPIENT = 'avisota.subscription.resolve-recipient';
}
