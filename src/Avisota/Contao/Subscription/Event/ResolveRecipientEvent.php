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

use Avisota\Contao\Entity\Subscription;
use Avisota\Contao\Subscription\SubscriptionRecipientInterface;
use Symfony\Component\EventDispatcher\Event;

class ResolveRecipientEvent extends SubscriptionAwareEvent
{
    /**
     * @var SubscriptionRecipientInterface|null
     */
    protected $recipient;

    /**
     * @param SubscriptionRecipientInterface|null $recipient
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
