<?php

namespace Flagbit\VirtualCustomerSession\Service;


use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Login {

    /**
     * @var CustomerRepository
     */
    private $customerRepository;
    /**
     * @var ResponseFactory
     */
    private $responseFactory;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var Session
     */
    private $session;


    /**
     * LoginObserver constructor.
     *
     * @param CustomerRepository   $customerRepository
     * @param ResponseFactory      $responseFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param Session              $session
     */
    public function __construct(
        CustomerRepository $customerRepository,
        ResponseFactory $responseFactory,
        ScopeConfigInterface $scopeConfig,
        Session $session
    ) {

        $this->customerRepository = $customerRepository;
        $this->responseFactory    = $responseFactory;
        $this->scopeConfig        = $scopeConfig;
        $this->session            = $session;
    }


    /**
     * @param string $email
     */
    public function loginCustomer($email) {

        try {
            $customer = $this->customerRepository->get($email);
            $this->session->startSession($customer);
        }
        catch(NoSuchEntityException $e) {

            $this->sendForbiddenHeader();
        }
    }
}