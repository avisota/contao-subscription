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

use Symfony\Component\EventDispatcher\Event;

class CollectSubscriptionListsEvent extends Event
{
    /**
     * @var \ArrayObject
     */
    protected $options;

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
