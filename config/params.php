<?php

return [
    'user.passwordResetTokenExpire' => '3600*24',
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'jimkinyua25@gmail.com',
    'senderName' => 'Supplier Portal Test',
    'productVendor' => env('PRODUCT_VENDOR'),
    'DBCompanyName' => env('DBCompanyName'),

    'powered' => 'Iansoft Ltd',
    'NavisionUsername' => env('NavisionUsername'),
    'NavisionPassword' => env('NavisionPassword'),

    'server' => env('server'),
    'WebServicePort' => env('WebServicePort'),
    'ServerInstance' => env('ServerInstance'),
    'ServiceCompanyName' => env('CompanyName'),
    'DBCompanyName' => env('DBCompanyName'),

    'codeUnits' => [
        'PortalFactory' => 'PortalFactory', // 50062
    ],
    'SystemConfigs' => [
        'UsingNTLM' => env('UsingNTLM'),
        'ChildAccount' => env('ChildAccount'),
        'GroupAccount' => env('GroupAccount'),
        'IndividualAccount' => env('IndividualAccount'),

    ],

    'ServiceName' => [

        /**************************Companies*************************************/
        'Companies' => 'Companies', //357 (Page)
        'SupplierAplicationList' => 'SupplierAplicationList', //66050 Page
        'VendorCard' => 'VendorCard', //66051
        'SupplierCategory' => 'SupplierCategory', //66057
        'SupplierPartnerDetails' => 'SupplierPartnerDetails', //66056
        'Countries' => 'Countries', //10
        'SupplierBankAccounts' => 'SupplierBankAccounts',  //66058
        'KenyaBanks' => 'KenyaBanks', // 66067
        'BankBranches' => 'BankBranches', //66068
        'SupplierAdditionalAddress' => 'SupplierAdditionalAddress', // 66059
        'PostalCodes' => 'PostalCodes', //367
        'PaymentTerms' => 'PaymentTerms', //4
        'PaymentMethods' => 'PaymentMethods', // 427
        'PortalFactory' => 'PortalFactory', // 50062
        'Countries' => 'Countries', //10
        'SupplierAttachments' => 'SupplierAttachments', //66063
        'SupplierAttachmentTypes' => 'SupplierAttachmentTypes', //66062

        'advertisedQuotationsList' => 'advertisedQuotationsList', //67033
        'quotationCard' => 'quotationCard', //67031 
        'quotationLines' => 'quotationLines', // 67032

        'advertisedTenderList' => 'advertisedTenderList', //67013
        'tenderCard' => 'tenderCard', //67011
        'tenderLines' => 'tenderLines', //67012 
    ],

];
