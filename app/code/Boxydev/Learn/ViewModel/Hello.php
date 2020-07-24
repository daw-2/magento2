<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Learn\ViewModel;

use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Hello implements ArgumentInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var Session
     */
    private $session;

    public function __construct(
        RequestInterface $request,
        Session $session
    ) {
        $this->request = $request;
        $this->session = $session;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    public function say()
    {
        if ('hi' === $this->getRequest()->getControllerName()) {
            $output = 'Hello ';
            $names = $this->getRequest()->getParam('names') ?? [];
            foreach ($names as $name) {
                $output .= $name . ' ';
            }

            return $output;
        }

        return 'Hello FROM VIEW MODEL';
    }
}
