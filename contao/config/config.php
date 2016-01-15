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

/**
 * Settings
 */
$GLOBALS['TL_CONFIG']['avisota_subscription_cleanup_days'] = 14;

/**
 * Event subscribers
 */
$GLOBALS['TL_EVENT_SUBSCRIBERS'][] = 'Avisota\Contao\Subscription\Cron';
$GLOBALS['TL_EVENT_SUBSCRIBERS'][] = 'Avisota\Contao\Subscription\SubscriptionLogger';
$GLOBALS['TL_EVENT_SUBSCRIBERS'][] = 'Avisota\Contao\Subscription\DataContainer\OptionsBuilder';

/**
 * Entities
 */
$GLOBALS['DOCTRINE_ENTITIES'][] = 'orm_avisota_blacklist';
$GLOBALS['DOCTRINE_ENTITIES'][] = 'orm_avisota_subscription';
$GLOBALS['DOCTRINE_ENTITIES'][] = 'orm_avisota_subscription_log';
