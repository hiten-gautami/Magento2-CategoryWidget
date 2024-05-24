<?php

namespace Elsnertech\CategoryWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Model\Product\Media\Config as MediaConfig;
use Magento\Catalog\Model\CategoryFactory;

class PageWidget extends Template implements BlockInterface
{
   protected $_template = "Elsnertech_CategoryWidget::widget/page_widget.phtml";

   public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      MediaConfig $mediaConfig,
      CategoryFactory $categoryFactory,
      \Magento\Store\Model\StoreManagerInterface $storeManager,
      array $data = []
   ) {
      parent::__construct($context, $data);
      $this->mediaConfig = $mediaConfig;
      $this->categoryFactory = $categoryFactory;
      $this->_storeManager = $storeManager;
   }

   public function getMediaPath()
   {
      $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
      return $mediaUrl;
   }

   public function getBaseUrl()
   {
      return $this->_storeManager->getStore()->getBaseUrl();
   }

   public function getCategoryProducts($categoryId)
   {
      $category = $this->categoryFactory->create()->load($categoryId);
      $categoryProducts = $category->getProductCollection()->addAttributeToSelect('*');
      return $categoryProducts;
   }

}