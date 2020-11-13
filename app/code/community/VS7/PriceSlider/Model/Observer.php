<?php

class VS7_PriceSlider_Model_Observer
{
    public function insertPriceSlider($event)
    {
        $layout = Mage::app()->getLayout();

        $head = $layout->getBlock('head');
        $navLeft = $layout->getBlock('amshopby.navleft');

        if ($head && $navLeft) {
            $filters = $navLeft->getFilters();
            $limitMinMax = array();
            foreach ($filters as $filter) {
                if (Amasty_Shopby_Model_Catalog_Layer_Filter_Price::DT_SLIDER == $filter->getDisplayType()) {
                    $limitMinMax[$filter->getAttributeModel()->getAttributeCode()] = $filter->getAttributeModel()->getLimitMinMax();
                }
            }

            if (empty($limitMinMax)) {
                return;
            }

            $head->addItem('skin_js', 'vs7_priceslider/priceslider.js');

            $lmmBlock = Mage::app()->getLayout()->createBlock('core/text');
            $lmmBlock->setText(
                '<script type="text/javascript">var vs7_price_slider_minmax =' . Mage::helper('core')->jsonEncode($limitMinMax) . ';</script>'
            );
            $layout->getBlock('before_body_end')->append($lmmBlock);
        }
    }
}