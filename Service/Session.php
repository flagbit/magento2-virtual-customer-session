<?php

namespace Flagbit\VirtualCustomerSession\Service;


use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\Cookie\PhpCookieManager;

class Session {

    /**
     * @var Session
     */
    private $session;
    /**
     * @var CookieMetadataFactory
     */
    private $cookieMetadataFactory;
    /**
     * @var PhpCookieManager
     */
    private $cookieManager;


    /**
     * Session constructor.
     *
     * @param \Magento\Customer\Model\Session $session
     * @param PhpCookieManager                $cookieManager
     * @param CookieMetadataFactory           $cookieMetadataFactory
     */
    public function __construct(
        \Magento\Customer\Model\Session $session,
        PhpCookieManager $cookieManager,
        CookieMetadataFactory $cookieMetadataFactory
    ) {

        $this->session               = $session;
        $this->cookieMetadataFactory = $cookieMetadataFactory;
        $this->cookieManager         = $cookieManager;
    }


    /**
     * @param CustomerInterface $customer
     *
     * @throws
     */
    public function startSession(CustomerInterface $customer) {

        $this->session->setCustomerDataAsLoggedIn($customer);
        $this->session->regenerateId();
        if($this->cookieManager->getCookie('mage-cache-sessid')) {
            $metadata = $this->cookieMetadataFactory->createCookieMetadata();
            $metadata->setPath('/');
            $this->cookieManager->deleteCookie('mage-cache-sessid', $metadata);
        }
    }
}