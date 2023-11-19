<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_InstagramWidget
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\InstagramWidget\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Helper
 */
class Data extends AbstractHelper
{
    /**
     * @var ScopeConfigInterface|mixed
     */
    protected $configModule;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
        $this->configModule = $this->getConfig('m2c_instagram');
    }

    /**
     * @param $cfg
     * @return ScopeConfigInterface|mixed
     */
    public function getConfig($cfg='')
    {
        if ($cfg)
            return $this->scopeConfig->getValue( $cfg, ScopeInterface::SCOPE_STORE );
        return $this->scopeConfig;
    }

    /**
     * @param $cfg
     * @param $value
     * @return ScopeConfigInterface|mixed|null
     */
    public function getConfigModule($cfg='', $value=null)
    {
        $values = $this->configModule;
        if( !$cfg ) return $values;
        $config  = explode('/',(string) $cfg);
        $end     = count($config) - 1;
        foreach ($config as $key => $vl) {
            if( isset($values[$vl]) ){
                if( $key == $end ) {
                    $value = $values[$vl];
                }else {
                    $values = $values[$vl];
                }
            }
        }
        return $value;
    }

}
