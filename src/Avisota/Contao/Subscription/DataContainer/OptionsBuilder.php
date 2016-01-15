<?php

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2013 Tristan Lins
 *
 * PHP version 5
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    avisota/contao-subscription
 * @license    LGPL-3.0+
 * @filesource
 */

namespace Avisota\Contao\Subscription\DataContainer;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OptionsBuilder implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    static public function getSubscribedEvents()
    {
        return array();
    }
}
