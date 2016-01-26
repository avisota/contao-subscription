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

/**
 * Class SubscribeEvent
 *
 * @package Avisota\Contao\Subscription\Event
 */
class SubscribeEvent extends SubscriptionAwareEvent
{
    /**
     * @var int
     */
    protected $options;

    /**
     * SubscribeEvent constructor.
     *
     * @param Subscription $subscription
     * @param              $subscriptionOptions
     */
    public function __construct(Subscription $subscription, $subscriptionOptions)
    {
        parent::__construct($subscription);
        $this->options = $subscriptionOptions;
    }

    /**
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }
}
