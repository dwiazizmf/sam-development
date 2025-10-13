<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::resource('permissions', 'PermissionsController', ['except' => ['create', 'store', 'destroy']]);

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::post('tasks/parse-csv-import', 'TaskController@parseCsvImport')->name('tasks.parseCsvImport');
    Route::post('tasks/process-csv-import', 'TaskController@processCsvImport')->name('tasks.processCsvImport');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Crm Status
    Route::delete('crm-statuses/destroy', 'CrmStatusController@massDestroy')->name('crm-statuses.massDestroy');
    Route::resource('crm-statuses', 'CrmStatusController');

    // Crm Customer
    Route::delete('crm-customers/destroy', 'CrmCustomerController@massDestroy')->name('crm-customers.massDestroy');
    Route::post('crm-customers/media', 'CrmCustomerController@storeMedia')->name('crm-customers.storeMedia');
    Route::post('crm-customers/ckmedia', 'CrmCustomerController@storeCKEditorImages')->name('crm-customers.storeCKEditorImages');
    Route::post('crm-customers/parse-csv-import', 'CrmCustomerController@parseCsvImport')->name('crm-customers.parseCsvImport');
    Route::post('crm-customers/process-csv-import', 'CrmCustomerController@processCsvImport')->name('crm-customers.processCsvImport');
    Route::resource('crm-customers', 'CrmCustomerController');

    // Crm Note
    Route::delete('crm-notes/destroy', 'CrmNoteController@massDestroy')->name('crm-notes.massDestroy');
    Route::resource('crm-notes', 'CrmNoteController');

    // Crm Document
    Route::delete('crm-documents/destroy', 'CrmDocumentController@massDestroy')->name('crm-documents.massDestroy');
    Route::post('crm-documents/media', 'CrmDocumentController@storeMedia')->name('crm-documents.storeMedia');
    Route::post('crm-documents/ckmedia', 'CrmDocumentController@storeCKEditorImages')->name('crm-documents.storeCKEditorImages');
    Route::resource('crm-documents', 'CrmDocumentController');

    // Contact Company
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::post('contact-companies/parse-csv-import', 'ContactCompanyController@parseCsvImport')->name('contact-companies.parseCsvImport');
    Route::post('contact-companies/process-csv-import', 'ContactCompanyController@processCsvImport')->name('contact-companies.processCsvImport');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::post('contact-contacts/parse-csv-import', 'ContactContactsController@parseCsvImport')->name('contact-contacts.parseCsvImport');
    Route::post('contact-contacts/process-csv-import', 'ContactContactsController@processCsvImport')->name('contact-contacts.processCsvImport');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Insurance Companies
    Route::delete('insurance-companies/destroy', 'InsuranceCompaniesController@massDestroy')->name('insurance-companies.massDestroy');
    Route::post('insurance-companies/media', 'InsuranceCompaniesController@storeMedia')->name('insurance-companies.storeMedia');
    Route::post('insurance-companies/ckmedia', 'InsuranceCompaniesController@storeCKEditorImages')->name('insurance-companies.storeCKEditorImages');
    Route::post('insurance-companies/parse-csv-import', 'InsuranceCompaniesController@parseCsvImport')->name('insurance-companies.parseCsvImport');
    Route::post('insurance-companies/process-csv-import', 'InsuranceCompaniesController@processCsvImport')->name('insurance-companies.processCsvImport');
    Route::resource('insurance-companies', 'InsuranceCompaniesController');

    // Claim Types
    Route::delete('claim-types/destroy', 'ClaimTypesController@massDestroy')->name('claim-types.massDestroy');
    Route::post('claim-types/parse-csv-import', 'ClaimTypesController@parseCsvImport')->name('claim-types.parseCsvImport');
    Route::post('claim-types/process-csv-import', 'ClaimTypesController@processCsvImport')->name('claim-types.processCsvImport');
    Route::resource('claim-types', 'ClaimTypesController');

    // Claim Type Group
    Route::delete('claim-type-groups/destroy', 'ClaimTypeGroupController@massDestroy')->name('claim-type-groups.massDestroy');
    Route::post('claim-type-groups/parse-csv-import', 'ClaimTypeGroupController@parseCsvImport')->name('claim-type-groups.parseCsvImport');
    Route::post('claim-type-groups/process-csv-import', 'ClaimTypeGroupController@processCsvImport')->name('claim-type-groups.processCsvImport');
    Route::resource('claim-type-groups', 'ClaimTypeGroupController');

    // Document Types Claim
    Route::delete('document-types-claims/destroy', 'DocumentTypesClaimController@massDestroy')->name('document-types-claims.massDestroy');
    Route::post('document-types-claims/parse-csv-import', 'DocumentTypesClaimController@parseCsvImport')->name('document-types-claims.parseCsvImport');
    Route::post('document-types-claims/process-csv-import', 'DocumentTypesClaimController@processCsvImport')->name('document-types-claims.processCsvImport');
    Route::resource('document-types-claims', 'DocumentTypesClaimController');

    // Insurance Product
    Route::delete('insurance-products/destroy', 'InsuranceProductController@massDestroy')->name('insurance-products.massDestroy');
    Route::post('insurance-products/media', 'InsuranceProductController@storeMedia')->name('insurance-products.storeMedia');
    Route::post('insurance-products/ckmedia', 'InsuranceProductController@storeCKEditorImages')->name('insurance-products.storeCKEditorImages');
    Route::post('insurance-products/parse-csv-import', 'InsuranceProductController@parseCsvImport')->name('insurance-products.parseCsvImport');
    Route::post('insurance-products/process-csv-import', 'InsuranceProductController@processCsvImport')->name('insurance-products.processCsvImport');
    Route::resource('insurance-products', 'InsuranceProductController');

    // Api Sync Logs
    Route::delete('api-sync-logs/destroy', 'ApiSyncLogsController@massDestroy')->name('api-sync-logs.massDestroy');
    Route::resource('api-sync-logs', 'ApiSyncLogsController');

    // Product Type
    Route::delete('product-types/destroy', 'ProductTypeController@massDestroy')->name('product-types.massDestroy');
    Route::post('product-types/parse-csv-import', 'ProductTypeController@parseCsvImport')->name('product-types.parseCsvImport');
    Route::post('product-types/process-csv-import', 'ProductTypeController@processCsvImport')->name('product-types.processCsvImport');
    Route::resource('product-types', 'ProductTypeController');

    // Claims
    Route::delete('claims/destroy', 'ClaimsController@massDestroy')->name('claims.massDestroy');
    Route::post('claims/parse-csv-import', 'ClaimsController@parseCsvImport')->name('claims.parseCsvImport');
    Route::post('claims/process-csv-import', 'ClaimsController@processCsvImport')->name('claims.processCsvImport');
    Route::resource('claims', 'ClaimsController');

    // Detail Document Claims
    Route::delete('detail-document-claims/destroy', 'DetailDocumentClaimsController@massDestroy')->name('detail-document-claims.massDestroy');
    Route::post('detail-document-claims/media', 'DetailDocumentClaimsController@storeMedia')->name('detail-document-claims.storeMedia');
    Route::post('detail-document-claims/ckmedia', 'DetailDocumentClaimsController@storeCKEditorImages')->name('detail-document-claims.storeCKEditorImages');
    Route::resource('detail-document-claims', 'DetailDocumentClaimsController');

    // Marketing Targer
    Route::delete('marketing-targers/destroy', 'MarketingTargerController@massDestroy')->name('marketing-targers.massDestroy');
    Route::post('marketing-targers/parse-csv-import', 'MarketingTargerController@parseCsvImport')->name('marketing-targers.parseCsvImport');
    Route::post('marketing-targers/process-csv-import', 'MarketingTargerController@processCsvImport')->name('marketing-targers.processCsvImport');
    Route::resource('marketing-targers', 'MarketingTargerController');

    // Policies Central
    Route::delete('policies-centrals/destroy', 'PoliciesCentralController@massDestroy')->name('policies-centrals.massDestroy');
    Route::post('policies-centrals/media', 'PoliciesCentralController@storeMedia')->name('policies-centrals.storeMedia');
    Route::post('policies-centrals/ckmedia', 'PoliciesCentralController@storeCKEditorImages')->name('policies-centrals.storeCKEditorImages');
    Route::post('policies-centrals/parse-csv-import', 'PoliciesCentralController@parseCsvImport')->name('policies-centrals.parseCsvImport');
    Route::post('policies-centrals/process-csv-import', 'PoliciesCentralController@processCsvImport')->name('policies-centrals.processCsvImport');
    Route::resource('policies-centrals', 'PoliciesCentralController');

    // Policy Travel
    Route::delete('policy-travels/destroy', 'PolicyTravelController@massDestroy')->name('policy-travels.massDestroy');
    Route::post('policy-travels/media', 'PolicyTravelController@storeMedia')->name('policy-travels.storeMedia');
    Route::post('policy-travels/ckmedia', 'PolicyTravelController@storeCKEditorImages')->name('policy-travels.storeCKEditorImages');
    Route::post('policy-travels/parse-csv-import', 'PolicyTravelController@parseCsvImport')->name('policy-travels.parseCsvImport');
    Route::post('policy-travels/process-csv-import', 'PolicyTravelController@processCsvImport')->name('policy-travels.processCsvImport');
    Route::resource('policy-travels', 'PolicyTravelController');

    // Perluasan Pertanggungan
    Route::delete('perluasan-pertanggungans/destroy', 'PerluasanPertanggunganController@massDestroy')->name('perluasan-pertanggungans.massDestroy');
    Route::resource('perluasan-pertanggungans', 'PerluasanPertanggunganController');

    // Jenis Pertanggungan
    Route::delete('jenis-pertanggungans/destroy', 'JenisPertanggunganController@massDestroy')->name('jenis-pertanggungans.massDestroy');
    Route::resource('jenis-pertanggungans', 'JenisPertanggunganController');

    // Policy Vehicle
    Route::delete('policy-vehicles/destroy', 'PolicyVehicleController@massDestroy')->name('policy-vehicles.massDestroy');
    Route::post('policy-vehicles/media', 'PolicyVehicleController@storeMedia')->name('policy-vehicles.storeMedia');
    Route::post('policy-vehicles/ckmedia', 'PolicyVehicleController@storeCKEditorImages')->name('policy-vehicles.storeCKEditorImages');
    Route::post('policy-vehicles/parse-csv-import', 'PolicyVehicleController@parseCsvImport')->name('policy-vehicles.parseCsvImport');
    Route::post('policy-vehicles/process-csv-import', 'PolicyVehicleController@processCsvImport')->name('policy-vehicles.processCsvImport');
    Route::resource('policy-vehicles', 'PolicyVehicleController');

    // Policy Pa
    Route::delete('policy-pas/destroy', 'PolicyPaController@massDestroy')->name('policy-pas.massDestroy');
    Route::post('policy-pas/media', 'PolicyPaController@storeMedia')->name('policy-pas.storeMedia');
    Route::post('policy-pas/ckmedia', 'PolicyPaController@storeCKEditorImages')->name('policy-pas.storeCKEditorImages');
    Route::post('policy-pas/parse-csv-import', 'PolicyPaController@parseCsvImport')->name('policy-pas.parseCsvImport');
    Route::post('policy-pas/process-csv-import', 'PolicyPaController@processCsvImport')->name('policy-pas.processCsvImport');
    Route::resource('policy-pas', 'PolicyPaController');

    // Jenis Rumah Gedung
    Route::delete('jenis-rumah-gedungs/destroy', 'JenisRumahGedungController@massDestroy')->name('jenis-rumah-gedungs.massDestroy');
    Route::resource('jenis-rumah-gedungs', 'JenisRumahGedungController');

    // Jenis Paket
    Route::delete('jenis-pakets/destroy', 'JenisPaketController@massDestroy')->name('jenis-pakets.massDestroy');
    Route::post('jenis-pakets/parse-csv-import', 'JenisPaketController@parseCsvImport')->name('jenis-pakets.parseCsvImport');
    Route::post('jenis-pakets/process-csv-import', 'JenisPaketController@processCsvImport')->name('jenis-pakets.processCsvImport');
    Route::resource('jenis-pakets', 'JenisPaketController');

    // Policy Rumah Gedung
    Route::delete('policy-rumah-gedungs/destroy', 'PolicyRumahGedungController@massDestroy')->name('policy-rumah-gedungs.massDestroy');
    Route::post('policy-rumah-gedungs/media', 'PolicyRumahGedungController@storeMedia')->name('policy-rumah-gedungs.storeMedia');
    Route::post('policy-rumah-gedungs/ckmedia', 'PolicyRumahGedungController@storeCKEditorImages')->name('policy-rumah-gedungs.storeCKEditorImages');
    Route::post('policy-rumah-gedungs/parse-csv-import', 'PolicyRumahGedungController@parseCsvImport')->name('policy-rumah-gedungs.parseCsvImport');
    Route::post('policy-rumah-gedungs/process-csv-import', 'PolicyRumahGedungController@processCsvImport')->name('policy-rumah-gedungs.processCsvImport');
    Route::resource('policy-rumah-gedungs', 'PolicyRumahGedungController');

    // Policy Kesehatan
    Route::delete('policy-kesehatans/destroy', 'PolicyKesehatanController@massDestroy')->name('policy-kesehatans.massDestroy');
    Route::post('policy-kesehatans/media', 'PolicyKesehatanController@storeMedia')->name('policy-kesehatans.storeMedia');
    Route::post('policy-kesehatans/ckmedia', 'PolicyKesehatanController@storeCKEditorImages')->name('policy-kesehatans.storeCKEditorImages');
    Route::post('policy-kesehatans/parse-csv-import', 'PolicyKesehatanController@parseCsvImport')->name('policy-kesehatans.parseCsvImport');
    Route::post('policy-kesehatans/process-csv-import', 'PolicyKesehatanController@processCsvImport')->name('policy-kesehatans.processCsvImport');
    Route::resource('policy-kesehatans', 'PolicyKesehatanController');

    // Task History
    Route::post('task-histories/media', 'TaskHistoryController@storeMedia')->name('task-histories.storeMedia');
    Route::post('task-histories/ckmedia', 'TaskHistoryController@storeCKEditorImages')->name('task-histories.storeCKEditorImages');
    Route::resource('task-histories', 'TaskHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Business Type
    Route::delete('business-types/destroy', 'BusinessTypeController@massDestroy')->name('business-types.massDestroy');
    Route::resource('business-types', 'BusinessTypeController');

    // Status Prospect
    Route::delete('status-prospects/destroy', 'StatusProspectController@massDestroy')->name('status-prospects.massDestroy');
    Route::resource('status-prospects', 'StatusProspectController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Invoices
    Route::delete('invoices/destroy', 'InvoicesController@massDestroy')->name('invoices.massDestroy');
    Route::post('invoices/parse-csv-import', 'InvoicesController@parseCsvImport')->name('invoices.parseCsvImport');
    Route::post('invoices/process-csv-import', 'InvoicesController@processCsvImport')->name('invoices.processCsvImport');
    Route::resource('invoices', 'InvoicesController');

    // Comission
    Route::post('comissions/parse-csv-import', 'ComissionController@parseCsvImport')->name('comissions.parseCsvImport');
    Route::post('comissions/process-csv-import', 'ComissionController@processCsvImport')->name('comissions.processCsvImport');
    Route::resource('comissions', 'ComissionController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Policy Motor
    Route::delete('policy-motors/destroy', 'PolicyMotorController@massDestroy')->name('policy-motors.massDestroy');
    Route::post('policy-motors/media', 'PolicyMotorController@storeMedia')->name('policy-motors.storeMedia');
    Route::post('policy-motors/ckmedia', 'PolicyMotorController@storeCKEditorImages')->name('policy-motors.storeCKEditorImages');
    Route::post('policy-motors/parse-csv-import', 'PolicyMotorController@parseCsvImport')->name('policy-motors.parseCsvImport');
    Route::post('policy-motors/process-csv-import', 'PolicyMotorController@processCsvImport')->name('policy-motors.processCsvImport');
    Route::resource('policy-motors', 'PolicyMotorController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
