# General Description
This Module enables a new debugging mode for customer session. If the module is installed and activated a developer is able to simulate a customer session by sending the customer email using a additional HTTP Header without knowing the password.

## Important Notes
This module is designed to be installed using require-dev only. Installing it on a public live system we will enable everybody to sign into any customer account without security restrictions like the customer password. If this module needs to be installed and enabled on a live system, make sure to correctly setup IP restrictions under developer settings in the magento backend.

## Usage
To enable the virtual customer sessions you will find a switch in the admin panel once the module is installed.
Path: System → Developer → Virtual Customer Session → Enable Debugging using request header
Please note: The functionality depends on the original Magento client restrictions. If IP limitation is active, virtual customer sessions are available for the given IPs only.
To log in to a customer account, use a browser plugin of your choice to pass the header "DEBUG-CUSTOMER" on every request.
The customer with the email address that matches the value of the header will automatically be logged in.


## Module

| | |
--- | ---
Github | https://github.com/Flagbit/magento2-virtual-customer-session
Packagist | https://packagist.org/packages/flagbit/magento2-virtual-customer-session
Composer | flagbit/magento2-virtual-customer-session


## Header
| | |
--- | ---
Name | DEBUG-CUSTOMER
Value | the customers email address

## Sample Browser Extensions
| | |
--- | ---
Chrome | https://chrome.google.com/webstore/detail/modheader/idgpnmonknjnojddfkpgkljpfnnfcklj
Firefox | https://addons.mozilla.org/de/firefox/addon/modify-headers/
Opera | https://addons.opera.com/de/extensions/details/modify-header-value/?display=en
Safari | impossible due to api restrictions