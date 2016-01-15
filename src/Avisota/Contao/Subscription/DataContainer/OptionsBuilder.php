<?php

/**
 * Avisota newsletter and mailing system
 * Copyright © 2016 Sven Baumann
 *
 * PHP version 5
 *
 * @copyright  way.vision 2016
 * @author     Sven Baumann <baumann.sv@gmail.com>
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
