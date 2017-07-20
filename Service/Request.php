<?php
namespace Flagbit\VirtualCustomerSession\Service;


use Magento\Developer\Helper\Data;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\PhpEnvironment\Request as HttpRequest;

class Request {

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var Data
     */
    private $developer;
    /**
     * @var HttpRequest
     */
    private $request;


    /**
     * Request constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param Data                 $developer
     * @param HttpRequest          $request
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Data $developer,
        HttpRequest $request
    ) {

        $this->scopeConfig = $scopeConfig;
        $this->developer   = $developer;
        $this->request     = $request;
    }


    /**
     * @return string|bool
     */
    public function getEmail() {

        if(
            $this->developer->isDevAllowed() &&
            $this->scopeConfig->getValue('dev/virtual_customer/debug_using_request') == 1 &&
            $httpRemoteUser = $this->request->getHeader('DEBUG_CUSTOMER')
        ) {

            return $httpRemoteUser;
        }

        return false;
    }
}