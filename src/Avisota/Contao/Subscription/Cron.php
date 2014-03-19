<?php

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2013 Tristan Lins
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

class Cron implements EventSubscriberInterface
{
	/**
	 * {@inheritdoc}
	 */
	public static function getSubscribedEvents()
	{
		return array(
			CronEvents::DAILY => array('cronCleanupRecipientList'),
		);
	}

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
