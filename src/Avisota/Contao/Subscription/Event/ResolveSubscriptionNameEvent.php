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

class ResolveSubscriptionNameEvent extends SubscriptionAwareEvent
{
    /**
     * @var string
     */
    protected $subscriptionName;

    /**
     * @param string $name
     */
    public function setSubscriptionName($name)
    {
        $this->subscriptionName = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscriptionName()
    {
        return $this->subscriptionName;
    }
}
