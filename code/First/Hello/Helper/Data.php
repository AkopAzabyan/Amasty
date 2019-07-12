<?php
namespace First\Hello\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 * @package First\Hello\Helper
 */
class Data extends AbstractHelper
{

    const XML_PATH_HELLOWORLD = 'helloworld/';

    /**
     * @param $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param $code
     * @param null $storeId
     * @return mixed
     */
    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_HELLOWORLD . 'general/' . $code, $storeId);
    }

}