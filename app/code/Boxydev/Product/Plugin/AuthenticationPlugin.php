<?php

namespace Boxydev\Product\Plugin;

use Magento\Customer\Model\Authentication;
use Magento\Customer\Model\CustomerRegistry;
use Psr\Log\LoggerInterface;

class AuthenticationPlugin
{
    /**
     * @var CustomerRegistry
     */
    private $customerRegistry;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        CustomerRegistry $customerRegistry,
        LoggerInterface $logger
    ) {
        $this->customerRegistry = $customerRegistry;
        $this->logger = $logger;
    }

    public function afterAuthenticate(Authentication $subject, $result, $customerId)
    {
        $customer = $this->customerRegistry->retrieve($customerId);
        $this->logger->debug(sprintf(
            'Connexion de %s',
            $customer->getEmail()
        ), ['customer' => $customer]);

        return $result;
    }
}
