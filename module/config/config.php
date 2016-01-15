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
