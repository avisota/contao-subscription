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

use Avisota\Contao\Entity\Blacklist;
use Avisota\Contao\Entity\Subscription;

/**
 * Class UnsubscribeEvent
 *
 * @package Avisota\Contao\Subscription\Event
 */
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

    /**
     * UnsubscribeEvent constructor.
     *
     * @param Subscription   $subscription
     * @param Blacklist|null $blacklist
     * @param                $options
     */
    public function __construct(Subscription $subscription, Blacklist $blacklist = null, $options = null)
    {
        parent::__construct($subscription);
        $this->blacklist = $blacklist;
        $this->options   = $options;
    }

    /**
     * @param Blacklist|null $blacklist
     *
     * @return $this
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
