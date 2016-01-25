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

use Avisota\Contao\Entity\Blacklist;
use Avisota\Contao\Entity\MailingList;
use Avisota\Contao\Entity\Subscription;
use Avisota\Contao\Subscription\Event\ConfirmSubscriptionEvent;
use Avisota\Contao\Subscription\Event\PrepareSubscriptionEvent;
use Avisota\Contao\Subscription\Event\ResolveRecipientEvent;
use Avisota\Contao\Subscription\Event\SubscribeEvent;
use Avisota\Contao\Subscription\Event\UnsubscribeEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Interface SubscriptionManagerInterface
 *
 * Manager for subscriptions.
 *
 * Accessible via DI container key avisota.subscription.
 * <pre>
 * global $container;
 * $subscriptionManager = $container->get('avisota.subscription');
 * </pre>
 *
 * @package    avisota/contao-core
 */
class SubscriptionManager
{
    /**
     * Option to ignore the blacklist when subscribe or unsubscribe.
     * On subscribe, the blacklist will not be checked.
     * On unsubscribe, no blacklist entries will be created.
     */
    const OPT_IGNORE_BLACKLIST = 1;

    /**
     * Activate the recipient on subscribe.
     */
    const OPT_ACTIVATE = 8;

    /**
     * Include existing subscriptions into the result.
     */
    const OPT_INCLUDE_EXISTING = 32;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Check if a recipient is blacklisted.
     *
     * @param SubscriptionRecipientInterface $recipient   Recipient to check it's blacklist status.
     * @param MailingList|array              $mailingList One or more mailing lists to check their blacklist status.
     *                                                    To check all states omit this parameter.
     *                                                    To check the global state pass null.
     *                                                    To check the global state AND mailing list states,
     *                                                    pass null AND the mailing lists.
     *
     * @param null                           $_
     *
     * @return bool
     */
    public function isBlacklisted(
        SubscriptionRecipientInterface $recipient,
        $mailingList = null,
        $_ = null
    ) {
        return count(call_user_func_array(array($this, 'getBlacklistStatus'), func_get_args()));
    }

    /**
     * Get the blacklist entries for a recipient.
     *
     * @param SubscriptionRecipientInterface $recipient Recipient to check it's blacklist status.
     * @param null                           $mailingLists
     * @param null                           $_
     *
     * @return \Avisota\Contao\Entity\Blacklist[] Return an array of blacklist records.
     * @internal param array|MailingList $mailingList One or more mailing lists to check their blacklist status.
     *                                                    To get all states omit this parameter.
     *                                                    To get the global state pass null.
     *                                                    To get the global state AND mailing list states,
     *                                                    pass null AND the mailing lists.
     */
    public function getBlacklistStatus(
        SubscriptionRecipientInterface $recipient,
        $mailingLists = null,
        $_ = null
    ) {
        /** @var MailingList[] $mailingLists */
        $mailingLists = func_get_args();
        array_shift($mailingLists);

        $recipientType      = get_class($recipient);
        $recipientEmail     = $recipient->getEmail();
        $recipientEmailHash = md5($recipientEmail);

        $repository       = $this->entityManager->getRepository('Avisota\Contao:Blacklist');
        $queryBuilder     = $repository->createQueryBuilder('b');
        $expr             = $queryBuilder->expr();
        $whereMailingList = array();

        foreach ($mailingLists as $index => $mailingList) {
            if ($mailingList) {
                $whereMailingList[] = $expr->eq('b.mailingList', ':mailingList' . $index);
                $queryBuilder->setParameter('mailingList' . $index, $mailingList->getId());
            } else {
                $whereMailingList[] = $expr->isNull('b.mailingList');
            }
        }

        $queryBuilder
            ->where($expr->eq('b.recipientType', ':recipientType'))
            ->andWhere($expr->eq('b.recipientEmailHash', ':recipientEmailHash'))
            ->andWhere(call_user_func_array(array($expr, 'orX'), ($whereMailingList)))
            ->setParameter('recipientType', $recipientType)
            ->setParameter('recipientEmailHash', $recipientEmailHash);
        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }

    /**
     * Find existing subscriptions for a recipient.
     *
     * @param SubscriptionRecipientInterface $recipient The recipient instance.
     * @param null                           $mailingLists
     * @param null                           $_
     *
     * @return \Avisota\Contao\Entity\Subscription[]
     * @internal param array|MailingList $mailingList One or more mailing lists to check their blacklist status.
     *                                                    To get all subscriptions omit this parameter.
     *                                                    To get the global subscription pass null.
     *                                                    To get the global subscription AND mailing list subscriptions,
     *                                                    pass null AND the mailing lists.
     */
    public function getSubscriptions(
        SubscriptionRecipientInterface $recipient,
        $mailingLists = null,
        $_ = null
    ) {
        /** @var MailingList[] $mailingLists */
        $mailingLists = func_get_args();
        array_shift($mailingLists);

        while (count($mailingLists) == 1 && is_array($mailingLists[0])) {
            $mailingLists = $mailingLists[0];
        }

        $recipientType      = get_class($recipient);
        $recipientEmail     = $recipient->getEmail();
        $recipientEmailHash = md5($recipientEmail);

        $repository       = $this->entityManager->getRepository('Avisota\Contao:Subscription');
        $queryBuilder     = $repository->createQueryBuilder('s');
        $expr             = $queryBuilder->expr();
        $whereMailingList = array();

        foreach ($mailingLists as $index => $mailingList) {
            if ($mailingList) {
                $whereMailingList[] = $expr->eq('s.mailingList', ':mailingList' . $index);
                $queryBuilder->setParameter('mailingList' . $index, $mailingList->getId());
            } else {
                $whereMailingList[] = $expr->isNull('s.mailingList');
            }
        }

        $queryBuilder
            ->where($expr->eq('s.recipientType', ':recipientType'))
            ->andWhere($expr->eq('s.recipientEmailHash', ':recipientEmailHash'))
            ->andWhere(call_user_func_array(array($expr, 'orX'), ($whereMailingList)))
            ->setParameter('recipientType', $recipientType)
            ->setParameter('recipientEmailHash', $recipientEmailHash);
        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }

    /**
     * Find existing subscription for a recipient.
     *
     * @param SubscriptionRecipientInterface $recipient   The recipient instance.
     * @param MailingList                    $mailingList One or more mailing lists to check their blacklist status.
     *                                                    To get the global subscription pass null.
     *                                                    To get the mailing list subscription
     *                                                    pass a mailing list instance.
     *
     * @return Subscription[]
     */
    public function getSubscription(
        SubscriptionRecipientInterface $recipient,
        MailingList $mailingList = null
    ) {
        $recipientType = get_class($recipient);
        $recipientId   = $recipient->getId();

        $repository   = $this->entityManager->getRepository('Avisota\Contao:Subscription');
        $queryBuilder = $repository->createQueryBuilder('s');
        $expr         = $queryBuilder->expr();

        $queryBuilder
            ->where($expr->eq('s.recipientType', ':recipientType'))
            ->andWhere($expr->eq('s.recipientId', ':recipientId'))
            ->setParameter('recipientType', $recipientType)
            ->setParameter('recipientId', $recipientId);

        if ($mailingList) {
            $queryBuilder
                ->andWhere($expr->eq('s.mailingList', ':mailingList'))
                ->setParameter('mailingList', $mailingList->getId());
        } else {
            $queryBuilder
                ->andWhere($expr->isNull('s.mailingList'));
        }

        $query = $queryBuilder->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    /**
     * Subscribe to a mailing list.
     *
     * @param SubscriptionRecipientInterface $recipient The recipient that subscribe.
     * @param null                           $mailingLists
     * @param null                           $_
     * @param int                            $options   Subscription options, see SubscriptionManager::OPT_* constants.
     *
     * @return \Avisota\Contao\Entity\Subscription[] Return the list of all NEW subscriptions.
     *                        Existing subscriptions will be omited, until you pass OPT_INCLUDE_EXISTING to $options.
     * @internal param array|MailingList $mailingList One or more mailing lists to subscribe to.
     *                                                    Pass null or omit for global subscription.
     */
    public function subscribe(
        SubscriptionRecipientInterface $recipient,
        $mailingLists = null,
        $_ = null,
        $options = 0
    ) {
        /** @var MailingList[] $mailingLists */
        $mailingLists = func_get_args();
        array_shift($mailingLists);

        if (is_int($mailingLists[count($mailingLists) - 1])) {
            $options = array_pop($mailingLists);
        } else {
            $options = 0;
        }

        while (count($mailingLists) == 1 && is_array($mailingLists[0])) {
            $mailingLists = $mailingLists[0];
        }

        $subscriptions    = array();
        $newSubscriptions = array();

        foreach ($mailingLists as $mailingList) {
            $subscription = $this->getSubscription($recipient, $mailingList);

            if ($subscription) {
                if ($options & self::OPT_INCLUDE_EXISTING) {
                    $subscriptions[] = $subscription;
                }

                // skip when already subscribed
                continue;
            }

            $blacklists = $this->getBlacklistStatus($recipient, $mailingList);

            if (!($options & self::OPT_IGNORE_BLACKLIST) && count($blacklists)) {
                // skip when blacklisted
                continue;
            }

            $recipientType  = get_class($recipient);
            $recipientId    = $recipient->getId();
            $subscriptionId = md5(
                $recipientType . '::' . $recipientId . '::' . ($mailingList ? $mailingList->getId() : 'global')
            );

            $subscription = new Subscription();
            $subscription->setId($subscriptionId);
            $subscription->setRecipientType($recipientType);
            $subscription->setRecipientId($recipientId);
            $subscription->setMailingList($mailingList);
            $subscription->setActive((bool) ($options & self::OPT_ACTIVATE));
            $subscription->setActivationToken(md5(mt_rand(-time(), time())));

            $this->entityManager->persist($subscription);

            foreach ($blacklists as $blacklist) {
                $this->entityManager->remove($blacklist);
            }

            $event = new PrepareSubscriptionEvent($subscription, $recipient);
            $this->eventDispatcher->dispatch(SubscriptionEvents::PREPARE_SUBSCRIPTION, $event);

            $subscriptions[]    = $subscription;
            $newSubscriptions[] = $subscription;
        }

        if (count($newSubscriptions)) {
            $this->entityManager->flush();

            foreach ($newSubscriptions as $subscription) {
                $event = new SubscribeEvent($subscription, $options);
                $this->eventDispatcher->dispatch(SubscriptionEvents::SUBSCRIBE, $event);
            }
        }

        return $subscriptions;
    }

    /**
     * Confirm subscriptions by one ore more token.
     *
     * @param array $tokens The activation tokens.
     *
     * @param null  $_
     *
     * @return \Avisota\Contao\Entity\Subscription[] Return only the confirmed subscriptions.
     */
    public function confirmByToken($tokens, $_ = null)
    {
        $tokens = func_get_args();

        while (count($tokens) == 1 && is_array($tokens[0])) {
            $tokens = $tokens[0];
        }

        if (empty($tokens)) {
            return array();
        }

        $repository   = $this->entityManager->getRepository('Avisota\Contao:Subscription');
        $queryBuilder = $repository->createQueryBuilder('s');
        $expr         = $queryBuilder->expr();

        $or = $expr->orX();
        foreach ($tokens as $index => $token) {
            $or->add($expr->eq('s.activationToken', ':activationToken' . $index));
            $queryBuilder->setParameter('activationToken' . $index, $token);
        }

        $queryBuilder
            ->where($or)
            ->andWhere($expr->eq('s.active', ':active'))
            ->setParameter('active', false);

        $query = $queryBuilder->getQuery();

        $subscriptions = $query->getResult();

        return $this->confirm($subscriptions);
    }

    /**
     * Confirm one or more subscriptions.
     *
     * @param Subscription|array $subscriptions One or more subscription instances to confirm.
     *
     * @param null               $_
     *
     * @return \Avisota\Contao\Entity\Subscription[] Return only the confirmed subscriptions.
     */
    public function confirm($subscriptions, $_ = null)
    {
        /** @var Subscription[] $subscriptions */
        $subscriptions = func_get_args();

        while (count($subscriptions) == 1 && is_array($subscriptions[0])) {
            $subscriptions = $subscriptions[0];
        }

        $activatedSubscriptions = array();

        foreach ($subscriptions as $subscription) {
            if (!$subscription->getActive()) {
                $subscription->setActive(true);
                $subscription->setActivationToken(null);
                $subscription->setActivatedOn(new \DateTime());

                $activatedSubscriptions[] = $subscription;
            }
        }

        if (count($activatedSubscriptions)) {
            $this->entityManager->flush();

            foreach ($activatedSubscriptions as $subscription) {
                $event = new ConfirmSubscriptionEvent($subscription);
                $this->eventDispatcher->dispatch(SubscriptionEvents::CONFIRM_SUBSCRIPTION, $event);
            }
        }

        return $activatedSubscriptions;
    }

    /**
     * Remove one or more subscriptions.
     *
     * @param Subscription|array $subscriptions One or more subscription instances to confirm.
     * @param null               $_
     * @param int                $options
     */
    public function unsubscribe($subscriptions, $_ = null, $options = 0)
    {
        /** @var Subscription[] $subscriptions */
        $subscriptions = func_get_args();

        if (is_int($subscriptions[count($subscriptions) - 1])) {
            $options = array_pop($subscriptions);
        } else {
            $options = 0;
        }

        while (count($subscriptions) == 1 && is_array($subscriptions[0])) {
            $subscriptions = $subscriptions[0];
        }

        $flush = false;

        foreach ($subscriptions as $subscription) {
            if ($options & self::OPT_IGNORE_BLACKLIST) {
                $blacklist = null;
            } else {
                $event = new ResolveRecipientEvent($subscription);
                $this->eventDispatcher->dispatch(SubscriptionEvents::RESOLVE_RECIPIENT, $event);
                $recipient = $event->getRecipient();

                if (!$recipient) {
                    $this->logger->alert(
                        'Could not resolve recipient for subscription',
                        array(
                            'subscription'  => $subscription->getId(),
                            'recipientType' => $subscription->getRecipientType(),
                            'recipientId'   => $subscription->getRecipientId(),
                        )
                    );
                    continue;
                }

                $recipientType      = $subscription->getRecipientType();
                $recipientEmail     = $recipient->getEmail();
                $recipientEmailHash = md5($recipientEmail);

                $blacklist = new Blacklist();
                $blacklist->setRecipientType($recipientType);
                $blacklist->setRecipientEmailHash($recipientEmailHash);
                $blacklist->setMailingList($subscription->getMailingList());
            }

            $event = new UnsubscribeEvent($subscription, $blacklist, $options);
            $this->eventDispatcher->dispatch(SubscriptionEvents::UNSUBSCRIBE, $event);

            $blacklist = $event->getBlacklist();

            $this->entityManager->remove($subscription);

            if ($blacklist) {
                $this->entityManager->persist($blacklist);
            }

            $flush = true;
        }

        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * @param EntityManager $entityManager
     *
     * @return $this
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param EventDispatcher $eventDispatcher
     *
     * @return $this
     */
    public function setEventDispatcher(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        return $this;
    }

    /**
     * @return EventDispatcher
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return $this
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
