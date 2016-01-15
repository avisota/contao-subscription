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
use Symfony\Component\EventDispatcher\Event;

/**
 * Class SubscriptionAwareEvent
 *
 * @package Avisota\Contao\Subscription\Event
 */
class SubscriptionAwareEvent extends Event
{
    /**
     * @var Subscription
     */
    protected $subscription;

    /**
     * SubscriptionAwareEvent constructor.
     *
     * @param Subscription $subscription
     */
    function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * @return Subscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }
}
