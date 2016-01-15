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
