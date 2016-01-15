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

use Symfony\Component\EventDispatcher\Event;

/**
 * Class CollectSubscriptionListsEvent
 *
 * @package Avisota\Contao\Subscription\Event
 */
class CollectSubscriptionListsEvent extends Event
{
    /**
     * @var \ArrayObject
     */
    protected $options;

    /**
     * CollectSubscriptionListsEvent constructor.
     *
     * @param \ArrayObject $options
     */
    function __construct(\ArrayObject $options)
    {
        $this->options = $options;
    }

    /**
     * @return \ArrayObject
     */
    public function getOptions()
    {
        return $this->options;
    }
}
