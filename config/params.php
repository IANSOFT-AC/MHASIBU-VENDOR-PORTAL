<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'jimkinyua25@gmail.com',
    'senderName' => 'Supplier Portal Test',
    'productVendor' => env('PRODUCT_VENDOR'),
    'DBCompanyName' => env('DBCompanyName'),

    'powered' => 'Iansoft Ltd',
    'NavisionUsername'=> env('NavisionUsername'),
    'NavisionPassword'=> env('NavisionPassword'),

    'server'=>env('server'),
    'WebServicePort'=>env('WebServicePort'),
    'ServerInstance'=>env('ServerInstance'),
    'ServiceCompanyName'=>env('CompanyName'),
    'DBCompanyName' =>env('DBCompanyName'),

    'codeUnits' => [
       'PortalFactory' => 'PortalFactory', // 50062
    ],
    'SystemConfigs'=>[
        'UsingNTLM'=>env('UsingNTLM'),
        'ChildAccount'=>env('ChildAccount'),
        'GroupAccount'=>env('GroupAccount'),
        'IndividualAccount'=>env('IndividualAccount'),

    ],

    'ServiceName'=>[

        /**************************Companies*************************************/
        'Companies' => 'Companies', //357 (Page)
        'SupplierAplicationList'=>'SupplierAplicationList', //66050 Page
        'VendorCard'=>'VendorCard', //66051
        'SupplierCategory'=>'SupplierCategory', //66057
        'SupplierPartnerDetails'=>'SupplierPartnerDetails',//66056
        'Countries'=>'Countries',//10
        'SupplierBankAccounts' => 'SupplierBankAccounts',  //66058
        'KenyaBanks' => 'KenyaBanks', // 66067
        'SupplierAdditionalAddress' => 'SupplierAdditionalAddress', // 66059
        'PostalCodes' => 'PostalCodes', //367
        'PaymentTerms' => 'PaymentTerms', //4
        'PaymentMethods' => 'PaymentMethods',// 427
        'PortalFactory' => 'PortalFactory', // 50062
    ],

];
