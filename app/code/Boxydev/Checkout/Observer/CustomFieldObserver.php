<?php

namespace Boxydev\Checkout\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomFieldObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getOrder();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $addressRepository = $objectManager->create('\Magento\Customer\Api\AddressRepositoryInterface');
        $collection = $objectManager->create(\Magento\Quote\Model\ResourceModel\Quote\Address\Collection::class);

        $quoteId = $order->getQuoteId();
        $collection->addFieldToFilter('quote_id', $quoteId);

        $items = $collection->getItems();
        $quoteAddress = array_shift($items);

        $addressReal = $addressRepository->getById($order->getShippingAddress()->getCustomerAddressId());
        $addressReal->setCustomAttribute('custom_field', $quoteAddress->getCustomField());

        $addressRepository->save($addressReal);
    }
}
