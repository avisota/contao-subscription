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

/**
 * Class SubscriptionEvents
 *
 * @package Avisota\Contao\Subscription
 */
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
     * The CLEAN_SUBSCRIPTION event occurs when an unconfirmed subscription request timed out and get removed.
     *
     * The event listener method receives a Avisota\Contao\Subscription\Event\CleanSubscriptionEvent instance.
     *
     * @var string
     *
     * @api
     */
    const CLEAN_SUBSCRIPTION = 'avisota.subscription.clean';

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

    /**
     * The PREPARE_SUBSCRIPTION event occurs before the subscription get persisted.
     *
     * This event allow you to manipulate the subscription object before it get stored into the database.
     * The event listener method receives a Avisota\Contao\Subscription\Event\PrepareSubscriptionEvent instance.
     *
     * @var string
     *
     * @api
     */
    const PREPARE_SUBSCRIPTION = 'avisota.subscription.prepare-subscription';

    /**
     * The CREATE_RECIPIENT_PROPERTIES_OPTIONS event occurs when an options
     * list must be filled with recipient properties.
     *
     * The event listener method receives
     * a ContaoCommunityAlliance\Contao\Events\CreateOptions\CreateOptionsEvent instance.
     *
     * @var string
     *
     * @api
     */
    const CREATE_RECIPIENT_PROPERTIES_OPTIONS = 'avisota.subscription-recipient.create-recipient-properties-options';
}
