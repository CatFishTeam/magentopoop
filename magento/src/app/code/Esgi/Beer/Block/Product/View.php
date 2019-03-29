<?php

namespace Esgi\Beer\Block\Product;

use Esgi\Beer\Model\BeerRepository;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\Context;

class View extends \Magento\Catalog\Block\Product\View
{

    private $beerRepository;

    public function __construct(Context $context, \Magento\Framework\Url\EncoderInterface $urlEncoder, \Magento\Framework\Json\EncoderInterface $jsonEncoder, \Magento\Framework\Stdlib\StringUtils $string, \Magento\Catalog\Helper\Product $productHelper, \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig, \Magento\Framework\Locale\FormatInterface $localeFormat, \Magento\Customer\Model\Session $customerSession, ProductRepositoryInterface $productRepository, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, BeerRepository $beerRepository, array $data = [])
    {
        $this->beerRepository = $beerRepository;
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
    }


    public function getBeer()
    {
        $beerId = $this->getProduct()->getData('beer_id');
        $beer = $this->beerRepository->getById($beerId);

        return $beer;
    }
}
