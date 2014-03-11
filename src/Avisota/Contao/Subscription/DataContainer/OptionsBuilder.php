<?php

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2013 Tristan Lins
 *
 * PHP version 5
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    avisota/contao-subscription
 * @license    LGPL-3.0+
 * @filesource
 */

namespace Avisota\Contao\Subscription\DataContainer;

use Avisota\Contao\Core\Event\CollectSubscriptionListsEvent;
use Contao\Doctrine\ORM\EntityHelper;
use ContaoCommunityAlliance\Contao\Bindings\ContaoEvents;
use ContaoCommunityAlliance\Contao\Bindings\Events\Controller\LoadDataContainerEvent;
use ContaoCommunityAlliance\Contao\Bindings\Events\System\LoadLanguageFileEvent;
use ContaoCommunityAlliance\Contao\Events\CreateOptions\CreateOptionsEvent;
use DcGeneral\Contao\Compatibility\DcCompat;
use DcGeneral\DC_General;
use DcGeneral\Factory\DcGeneralFactory;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OptionsBuilder implements EventSubscriberInterface
{
	/**
	 * {@inheritdoc}
	 */
	static public function getSubscribedEvents()
	{
		return array(
		);
	}
}
