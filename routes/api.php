<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Crm Customer
    Route::post('crm-customers/media', 'CrmCustomerApiController@storeMedia')->name('crm-customers.storeMedia');
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Contact Contacts
    Route::apiResource('contact-contacts', 'ContactContactsApiController');

    // Insurance Companies
    Route::post('insurance-companies/media', 'InsuranceCompaniesApiController@storeMedia')->name('insurance-companies.storeMedia');
    Route::apiResource('insurance-companies', 'InsuranceCompaniesApiController');

    // Claim Types
    Route::apiResource('claim-types', 'ClaimTypesApiController');

    // Claim Type Group
    Route::apiResource('claim-type-groups', 'ClaimTypeGroupApiController');

    // Document Types Claim
    Route::apiResource('document-types-claims', 'DocumentTypesClaimApiController');

    // Insurance Product
    Route::post('insurance-products/media', 'InsuranceProductApiController@storeMedia')->name('insurance-products.storeMedia');
    Route::apiResource('insurance-products', 'InsuranceProductApiController');

    // Api Sync Logs
    Route::apiResource('api-sync-logs', 'ApiSyncLogsApiController');

    // Product Type
    Route::apiResource('product-types', 'ProductTypeApiController');

    // Claims
    Route::apiResource('claims', 'ClaimsApiController');

    // Detail Document Claims
    Route::post('detail-document-claims/media', 'DetailDocumentClaimsApiController@storeMedia')->name('detail-document-claims.storeMedia');
    Route::apiResource('detail-document-claims', 'DetailDocumentClaimsApiController');

    // Policies Central
    Route::post('policies-centrals/media', 'PoliciesCentralApiController@storeMedia')->name('policies-centrals.storeMedia');
    Route::apiResource('policies-centrals', 'PoliciesCentralApiController');

    // Policy Travel
    Route::post('policy-travels/media', 'PolicyTravelApiController@storeMedia')->name('policy-travels.storeMedia');
    Route::apiResource('policy-travels', 'PolicyTravelApiController');

    // Policy Vehicle
    Route::post('policy-vehicles/media', 'PolicyVehicleApiController@storeMedia')->name('policy-vehicles.storeMedia');
    Route::apiResource('policy-vehicles', 'PolicyVehicleApiController');

    // Policy Pa
    Route::post('policy-pas/media', 'PolicyPaApiController@storeMedia')->name('policy-pas.storeMedia');
    Route::apiResource('policy-pas', 'PolicyPaApiController');

    // Policy Rumah Gedung
    Route::post('policy-rumah-gedungs/media', 'PolicyRumahGedungApiController@storeMedia')->name('policy-rumah-gedungs.storeMedia');
    Route::apiResource('policy-rumah-gedungs', 'PolicyRumahGedungApiController');

    // Policy Kesehatan
    Route::post('policy-kesehatans/media', 'PolicyKesehatanApiController@storeMedia')->name('policy-kesehatans.storeMedia');
    Route::apiResource('policy-kesehatans', 'PolicyKesehatanApiController');

    // Policy Motor
    Route::post('policy-motors/media', 'PolicyMotorApiController@storeMedia')->name('policy-motors.storeMedia');
    Route::apiResource('policy-motors', 'PolicyMotorApiController');
});
