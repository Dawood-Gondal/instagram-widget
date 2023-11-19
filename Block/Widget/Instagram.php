<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_InstagramWidget
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\InstagramWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use M2Commerce\InstagramWidget\Helper\Data;

class Instagram extends Template implements BlockInterface
{
    /**
     * @var Data
     */
    public $helper;

    /**
     * @param Context $context
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $data = $this->helper->getConfigModule('general');
        if($data['slide']){
            $data['vertical-Swiping'] = $data['vertical'];
            $breakpoints = $this->getResponsiveBreakpoints();
            $responsive = '[';
            $num = count($breakpoints);
            foreach ($breakpoints as $size => $opt)
            {
                $item = (int) $data[$opt];
                $responsive .= '{"breakpoint": "'.$size.'", "settings": {"slidesToShow": "'.$item.'"}}';
                $num--;
                if($num) $responsive .= ', ';
            }
            $responsive .= ']';
            $data['center-Mode']    = $data['center_mode'];
            $data['autoplay-Speed'] = $data['autoplay_speed'];
            $data['slides-To-Show'] = $data['visible'];
            $data['swipe-To-Slide'] = 'true';
            $data['responsive'] = $responsive;
        }
        $this->addData($data);
        parent::_construct();
    }

    /**
     * @return string[]
     */
    public function getResponsiveBreakpoints()
    {
        return [
            1921=>'visible',
            1920=>'widescreen',
            1480=>'desktop',
            1200=>'laptop',
            992=>'notebook',
            768=>'tablet',
            576=>'landscape',
            481=>'portrait',
            361=>'mobile',
            1=>'mobile'
        ];
    }

    /**
     * @return string[]
     */
    public function getSlideOptions()
    {
        return [
            'autoplay',
            'arrows',
            'speed',
            'autoplay-Speed',
            'center-Mode',
            'dots',
            'fade', 'infinite',
            'padding',
            'vertical',
            'vertical-Swiping',
            'responsive',
            'rows',
            'slides-To-Show',
            'swipe-To-Slide'
        ];
    }

    /**
     * @return string[]
     */
    public function getFrontendCfg()
    {
        if ($this->getSlide())
            return $this->getSlideOptions();

        $this->addData([
            'responsive' =>json_encode($this->getGridOptions())
        ]);
        return ['padding', 'responsive'];
    }

    /**
     * @return array
     */
    public function getGridOptions()
    {
        $options = [];
        $breakpoints = $this->getResponsiveBreakpoints(); ksort($breakpoints);
        foreach ($breakpoints as $size => $screen)
        {
            $options[]= [
                $size-1 => $this->getData($screen)
            ];
        }
        return $options;
    }

}
