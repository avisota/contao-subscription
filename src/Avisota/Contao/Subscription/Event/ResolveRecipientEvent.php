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
use Avisota\Contao\Subscription\SubscriptionRecipientInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ResolveRecipientEvent
 *
 * @package Avisota\Contao\Subscription\Event
 */
class ResolveRecipientEvent extends SubscriptionAwareEvent
{
    /**
     * @var SubscriptionRecipientInterface|null
     */
    protected $recipient;

    /**
     * @param SubscriptionRecipientInterface|null $recipient
     *
     * @return $this
     */
    public function setRecipient(SubscriptionRecipientInterface $recipient = null)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return SubscriptionRecipientInterface|null
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
}
