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

class PrepareSubscriptionEvent extends SubscriptionAwareEvent
{
    /**
     * @var SubscriptionRecipientInterface
     */
    protected $recipient;

    function __construct(Subscription $subscription, SubscriptionRecipientInterface $recipient)
    {
        parent::__construct($subscription);
        $this->recipient = $recipient;
    }

    /**
     * @return SubscriptionRecipientInterface
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
}
