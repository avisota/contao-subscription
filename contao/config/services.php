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


/**
 * Define subscription managers
 */

$container['avisota.subscription'] = $container->share(
    function ($container) {
        $subscriptionManager = new \Avisota\Contao\Subscription\SubscriptionManager();
        $subscriptionManager->setEntityManager($container['doctrine.orm.entityManager']);
        $subscriptionManager->setEventDispatcher($container['event-dispatcher']);
        $subscriptionManager->setLogger($container['avisota.logger.subscription']);
        return $subscriptionManager;
    }
);

// subscription log default level
$container['avisota.logger.default.level.subscription'] = function ($container) {
    return 'debug';
};

// subscription log default handlers
$container['avisota.logger.default.handlers.subscription'] = new ArrayObject(
    array('avisota.logger.handler.subscription', 'avisota.logger.handler.general')
);

// subscription log handler
$container['avisota.logger.handler.subscription'] = $container->share(
    function ($container) {
        $factory = $container['logger.factory.handler.stream'];

        return $factory('avisota.subscription.log', $container['avisota.logger.default.level.subscription']);
    }
);

// subscription log
$container['avisota.logger.subscription'] = function ($container) {
    $factory = $container['logger.factory'];
    $logger  = $factory('avisota.subscription', $container['avisota.logger.default.handlers.subscription']);

    return $logger;
};
