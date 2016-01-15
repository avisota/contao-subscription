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

namespace Avisota\Contao\Subscription;

use Avisota\Contao\Subscription\Event\ConfirmSubscriptionEvent;
use Avisota\Contao\SubscriptionRecipient\Event\CreateRecipientEvent;
use Avisota\Contao\SubscriptionRecipient\Event\RecipientAwareEvent;
use Avisota\Contao\SubscriptionRecipient\Event\RemoveRecipientEvent;
use Avisota\Contao\Subscription\Event\SubscribeEvent;
use Avisota\Contao\Subscription\Event\UnsubscribeEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class SubscriptionLogger
 *
 * @package Avisota\Contao\Subscription
 */
class SubscriptionLogger implements EventSubscriberInterface
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            SubscriptionEvents::SUBSCRIBE            => 'subscribe',
            SubscriptionEvents::CONFIRM_SUBSCRIPTION => 'confirm',
            SubscriptionEvents::UNSUBSCRIBE          => 'unsubscribe',
        );
    }

    /**
     * @param SubscribeEvent $event
     */
    public function subscribe(SubscribeEvent $event)
    {
        /** @var LoggerInterface $logger */
        $logger = $GLOBALS['container']['avisota.logger.subscription'];

        $subscription = $event->getSubscription();
        $recipient    = $subscription->getRecipient();

        $logger->info(
            sprintf(
                'Recipient %s start subscription to %s',
                $recipient->getEmail(),
                $subscription->getMailingList()
                    ? $subscription->getMailingList()->getTitle()
                    : 'global'
            )
        );
    }

    /**
     * @param ConfirmSubscriptionEvent $event
     */
    public function confirm(ConfirmSubscriptionEvent $event)
    {
        /** @var LoggerInterface $logger */
        $logger = $GLOBALS['container']['avisota.logger.subscription'];

        $subscription = $event->getSubscription();
        $recipient    = $subscription->getRecipient();

        $logger->info(
            sprintf(
                'Recipient %s confirmed subscription to %s',
                $recipient->getEmail(),
                $subscription->getMailingList()
                    ? $subscription->getMailingList()->getTitle()
                    : 'global'
            )
        );
    }

    /**
     * @param UnsubscribeEvent $event
     */
    public function unsubscribe(UnsubscribeEvent $event)
    {
        /** @var LoggerInterface $logger */
        $logger = $GLOBALS['container']['avisota.logger.subscription'];

        $subscription = $event->getSubscription();
        $recipient    = $subscription->getRecipient();

        $logger->info(
            sprintf(
                'Recipient %s cancel subscription to %s',
                $recipient->getEmail(),
                $subscription->getMailingList()
                    ? $subscription->getMailingList()->getTitle()
                    : 'global'
            )
        );
    }
}
