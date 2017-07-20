<?php

namespace Flagbit\VirtualCustomerSession\Observer;


use Flagbit\VirtualCustomerSession\Service\Request;
use Magento\Customer\Model\Session;
use Magento\Framework\Event\ObserverInterface;
use Flagbit\VirtualCustomerSession\Service\Login;

class LoginObserver implements ObserverInterface {

    /**
     * @var Login
     */
    private $loginService;
    /**
     * @var Session
     */
    private $session;
    /**
     * @var Request
     */
    private $request;


    /**
     * LoginObserver constructor.
     *
     * @param Login   $loginService
     * @param Session $session
     * @param Request $request
     */
    public function __construct(
        Login $loginService,
        Session $session,
        Request $request
    ) {

        $this->loginService = $loginService;
        $this->session      = $session;
        $this->request      = $request;
    }


    /**
     * @param \Magento\Framework\Event\Observer $observer
     *
     * @return void
     * @SuppressWarnings(PHPMD)
     */
    public function execute(\Magento\Framework\Event\Observer $observer) {

        $email = $this->request->getEmail();

        if($email !== false) {
            if(
                !$this->session->isLoggedIn() ||
                strtolower($this->session->getCustomer()->getEmail()) != strtolower($email)
            ) {

                $this->loginService->loginCustomer($email);
            }
        }
    }
}
