<?php

/**
 * Avisota newsletter and mailing system
 * Copyright © 2016 Sven Baumann
 *
 * PHP version 5
 *
 * @copyright  MEN AT WORK 2013
 * @package    avisota/contao-subscription-recipient
 * @license    LGPL-3.0+
 * @filesource
 */

namespace Avisota\Contao\Subscription;

use Avisota\Contao\Subscription\Event\CleanSubscriptionEvent;
use Contao\Doctrine\ORM\EntityHelper;
use ContaoCommunityAlliance\Contao\Events\Cron\CronEvents;
use Doctrine\ORM\Query;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class Cron
 *
 * @package Avisota\Contao\Subscription
 */
class Cron implements EventSubscriberInterface
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
            CronEvents::DAILY => array('cronCleanupRecipientList'),
        );
    }

    /**
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function cronCleanupRecipientList()
    {
        if (!$GLOBALS['TL_CONFIG']['avisota_subscription_cleanup']) {
            return;
        }

        /** @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $GLOBALS['container']['event-dispatcher'];

        $cleanupDate = new \DateTime();
        $cleanupDate->sub(new \DateInterval('P' . $GLOBALS['TL_CONFIG']['avisota_subscription_cleanup_days'] . 'D'));

        $entityManager = EntityHelper::getEntityManager();
        $repository    = $entityManager->getRepository('Avisota\Contao:Subscription');
        $queryBuilder  = $repository->createQueryBuilder('s');
        $expr          = $queryBuilder->expr();
        $queryBuilder
            ->select('s')
            ->where($expr->eq('s.confirmed', ':confirmed'))
            ->andWhere($expr->lt('s.updatedAt', ':cleanupDate'))
            ->setParameter('confirmed', true)
            ->setParameter('cleanupDate', $cleanupDate);
        $query         = $queryBuilder->getQuery();
        $subscriptions = $query->getResult();

        foreach ($subscriptions as $subscription) {
            $entityManager->remove($subscription);

            $event = new CleanSubscriptionEvent($subscription);
            $eventDispatcher->dispatch(SubscriptionEvents::CLEAN_SUBSCRIPTION, $event);
        }

        $entityManager->flush();
    }
}
