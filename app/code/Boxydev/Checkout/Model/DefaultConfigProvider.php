<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Checkout\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Helper\Image;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class DefaultConfigProvider implements ConfigProviderInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $repository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var Image
     */
    private $imageHelper;

    public function __construct(
        ProductRepositoryInterface $repository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Image $imageHelper
    ) {
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->imageHelper = $imageHelper;
    }

    public function getConfig()
    {
        $crossProducts = [];

        $products = $this->repository->getList(
            $this->searchCriteriaBuilder->create()
        );

        foreach ($products->getItems() as $key => $product) {
            $crossProducts[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getFinalPrice(),
                'thumbnail' => $this->imageHelper
                    ->init($product, 'product_thumbnail_image')
                    ->setImageFile($product->getThumbnail())
                    ->getUrl()
            ];

            if (10 === $key) {
                break;
            }
        }

        return ['crossProducts' => $crossProducts];
    }
}
