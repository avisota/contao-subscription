<?php

/**
 * Avisota newsletter and mailing system
 * Copyright © 2016 Sven Baumann
 *
 * PHP version 5
 *
 * @copyright  way.vision 2016
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @package    avisota/contao-subscription-recipient
 * @license    LGPL-3.0+
 * @filesource
 */

namespace Avisota\Contao\Subscription\DataContainer;

use Contao\Doctrine\ORM\EntityHelper;

class Subscription extends \Backend
{
    /**
     * Return the "toggle visibility" button
     *
     * @param array
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     *
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        $input = \Input::getInstance();

        $subscriptionRepository = EntityHelper::getRepository('Avisota\Contao:Subscription');
        /** @var \Avisota\Contao\Entity\Subscription $subscription */

        if (strlen($input->get('tid'))) {
            $id        = $input->get('tid');
            $confirmed = $input->get('state') == 1;

            /** @var \Avisota\Contao\Entity\Subscription $subscription */
            $subscription = $subscriptionRepository->find($id);

            $subscription->setConfirmed($confirmed);

            $entityManager = EntityHelper::getEntityManager();
            $entityManager->persist($subscription);
            $entityManager->flush($subscription);

            $this->redirect($this->getReferer());
        }

        $subscription = $subscriptionRepository->findOneBy(
            array(
                'recipient' => $row['recipient'],
                'list'      => $row['list'],
            )
        );

        $href .= '&amp;tid=' . $subscription->id() . '&amp;state=' . ($row['confirmed'] ? '' : 1);

        if (!$row['confirmed']) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars(
            $title
        ) . '"' . $attributes . '>' . $this->generateImage($icon, $label) . '</a> ';
    }
}
