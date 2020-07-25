<?php

namespace Boxydev\Checkout\Model;

use Magento\Catalog\Helper\Image as MagentoImage;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\DataObject;

class DefaultConfigProvider implements ConfigProviderInterface
{
    /**
     * @var Collection
     */
    protected $productCollection;

    /**
     * @var MagentoImage
     */
    protected $imageHelper;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Product
     */
    private $productResource;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    public function __construct(
        Collection $productCollection,
        MagentoImage $imageHelper,
        Cart $cart,
        Product $productResource,
        ProductFactory $productFactory
    ) {
        $this->productCollection = $productCollection;
        $this->imageHelper = $imageHelper;
        $this->cart = $cart;
        $this->productResource = $productResource;
        $this->productFactory = $productFactory;
    }

    public function getConfig()
    {
        $category = false;

        if ($firstItem = $this->cart->getItems()->getFirstItem()) {
            $this->productResource->load(
                $product = $this->productFactory->create(),
                $firstItem->getProductId()
            );
            $categories = $product->getCategoryIds();
            $category = $categories[0] ?? false;
        }

        $products = $this->productCollection
            ->addAttributeToSelect('*')
            ->setPageSize(10);

        if ($category) {
            $products->addCategoriesFilter(['in' => $category]);
        }

        $crossProducts = [];

        /** @var Product $product */
        foreach ($products as $product) {
            $crossProducts[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getFinalPrice(),
                'thumbnail' => $this->imageHelper
                    ->init($product, 'product_thumbnail_image')
                    ->setImageFile($product->getThumbnail())
                    ->getUrl()
            ];
        }

        return [
            'crossProducts' => $crossProducts,
        ];
    }
}
