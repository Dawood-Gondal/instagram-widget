<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_InstagramWidget
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\InstagramWidget\Model\Config\Source;

class Truefalse implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'true', 'label' => __('True')],
            ['value' => 'false', 'label' => __('False')]
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'false' => __('No'),
            'true' => __('Yes')
        ];
    }
}
