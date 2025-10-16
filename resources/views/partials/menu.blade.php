<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }} {{ request()->is("admin/comissions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }} {{ request()->is("admin/comissions*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('comission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.comissions.index") }}" class="nav-link {{ request()->is("admin/comissions") || request()->is("admin/comissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hand-holding-usd">

                                        </i>
                                        <p>
                                            {{ trans('cruds.comission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('contact_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/business-types*") ? "menu-open" : "" }} {{ request()->is("admin/contact-companies*") ? "menu-open" : "" }} {{ request()->is("admin/status-prospects*") ? "menu-open" : "" }} {{ request()->is("admin/contact-contacts*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/business-types*") ? "active" : "" }} {{ request()->is("admin/contact-companies*") ? "active" : "" }} {{ request()->is("admin/status-prospects*") ? "active" : "" }} {{ request()->is("admin/contact-contacts*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-phone-square">

                            </i>
                            <p>
                                {{ trans('cruds.contactManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('business_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.business-types.index") }}" class="nav-link {{ request()->is("admin/business-types") || request()->is("admin/business-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-tie">

                                        </i>
                                        <p>
                                            {{ trans('cruds.businessType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('contact_company_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contact-companies.index") }}" class="nav-link {{ request()->is("admin/contact-companies") || request()->is("admin/contact-companies/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contactCompany.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('status_prospect_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.status-prospects.index") }}" class="nav-link {{ request()->is("admin/status-prospects") || request()->is("admin/status-prospects/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-battery-full">

                                        </i>
                                        <p>
                                            {{ trans('cruds.statusProspect.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('contact_contact_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contact-contacts.index") }}" class="nav-link {{ request()->is("admin/contact-contacts") || request()->is("admin/contact-contacts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contactContact.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('basic_c_r_m_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/crm-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/crm-customers*") ? "menu-open" : "" }} {{ request()->is("admin/crm-notes*") ? "menu-open" : "" }} {{ request()->is("admin/crm-documents*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/crm-statuses*") ? "active" : "" }} {{ request()->is("admin/crm-customers*") ? "active" : "" }} {{ request()->is("admin/crm-notes*") ? "active" : "" }} {{ request()->is("admin/crm-documents*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.basicCRM.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('crm_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-statuses.index") }}" class="nav-link {{ request()->is("admin/crm-statuses") || request()->is("admin/crm-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_customer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-customers.index") }}" class="nav-link {{ request()->is("admin/crm-customers") || request()->is("admin/crm-customers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmCustomer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_note_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-notes.index") }}" class="nav-link {{ request()->is("admin/crm-notes") || request()->is("admin/crm-notes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-sticky-note">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmNote.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_document_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-documents.index") }}" class="nav-link {{ request()->is("admin/crm-documents") || request()->is("admin/crm-documents/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmDocument.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('task_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/task-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/task-tags*") ? "menu-open" : "" }} {{ request()->is("admin/tasks*") ? "menu-open" : "" }} {{ request()->is("admin/task-histories*") ? "menu-open" : "" }} {{ request()->is("admin/tasks-calendars*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/task-statuses*") ? "active" : "" }} {{ request()->is("admin/task-tags*") ? "active" : "" }} {{ request()->is("admin/tasks*") ? "active" : "" }} {{ request()->is("admin/task-histories*") ? "active" : "" }} {{ request()->is("admin/tasks-calendars*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-list">

                            </i>
                            <p>
                                {{ trans('cruds.taskManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('task_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-statuses.index") }}" class="nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-tags.index") }}" class="nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-at">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.task.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_history_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-histories.index") }}" class="nav-link {{ request()->is("admin/task-histories") || request()->is("admin/task-histories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskHistory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tasks_calendar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks-calendars.index") }}" class="nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tasksCalendar.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('master_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/insurance-companies*") ? "menu-open" : "" }} {{ request()->is("admin/product-types*") ? "menu-open" : "" }} {{ request()->is("admin/insurance-products*") ? "menu-open" : "" }} {{ request()->is("admin/jenis-pertanggungans*") ? "menu-open" : "" }} {{ request()->is("admin/perluasan-pertanggungans*") ? "menu-open" : "" }} {{ request()->is("admin/jenis-rumah-gedungs*") ? "menu-open" : "" }} {{ request()->is("admin/jenis-pakets*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/insurance-companies*") ? "active" : "" }} {{ request()->is("admin/product-types*") ? "active" : "" }} {{ request()->is("admin/insurance-products*") ? "active" : "" }} {{ request()->is("admin/jenis-pertanggungans*") ? "active" : "" }} {{ request()->is("admin/perluasan-pertanggungans*") ? "active" : "" }} {{ request()->is("admin/jenis-rumah-gedungs*") ? "active" : "" }} {{ request()->is("admin/jenis-pakets*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.master.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('insurance_company_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.insurance-companies.index") }}" class="nav-link {{ request()->is("admin/insurance-companies") || request()->is("admin/insurance-companies/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.insuranceCompany.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.product-types.index") }}" class="nav-link {{ request()->is("admin/product-types") || request()->is("admin/product-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-archive">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('insurance_product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.insurance-products.index") }}" class="nav-link {{ request()->is("admin/insurance-products") || request()->is("admin/insurance-products/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-avianex">

                                        </i>
                                        <p>
                                            {{ trans('cruds.insuranceProduct.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('jenis_pertanggungan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.jenis-pertanggungans.index") }}" class="nav-link {{ request()->is("admin/jenis-pertanggungans") || request()->is("admin/jenis-pertanggungans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-alt-circle-left">

                                        </i>
                                        <p>
                                            {{ trans('cruds.jenisPertanggungan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('perluasan_pertanggungan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.perluasan-pertanggungans.index") }}" class="nav-link {{ request()->is("admin/perluasan-pertanggungans") || request()->is("admin/perluasan-pertanggungans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-arrow-alt-circle-left">

                                        </i>
                                        <p>
                                            {{ trans('cruds.perluasanPertanggungan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('jenis_rumah_gedung_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.jenis-rumah-gedungs.index") }}" class="nav-link {{ request()->is("admin/jenis-rumah-gedungs") || request()->is("admin/jenis-rumah-gedungs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bullhorn">

                                        </i>
                                        <p>
                                            {{ trans('cruds.jenisRumahGedung.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('jenis_paket_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.jenis-pakets.index") }}" class="nav-link {{ request()->is("admin/jenis-pakets") || request()->is("admin/jenis-pakets/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-box-open">

                                        </i>
                                        <p>
                                            {{ trans('cruds.jenisPaket.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('policy_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/policies-centrals*") ? "menu-open" : "" }} {{ request()->is("admin/policy-travels*") ? "menu-open" : "" }} {{ request()->is("admin/policy-vehicles*") ? "menu-open" : "" }} {{ request()->is("admin/policy-motors*") ? "menu-open" : "" }} {{ request()->is("admin/policy-pas*") ? "menu-open" : "" }} {{ request()->is("admin/policy-rumah-gedungs*") ? "menu-open" : "" }} {{ request()->is("admin/policy-kesehatans*") ? "menu-open" : "" }} {{ request()->is("admin/api-sync-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/policies-centrals*") ? "active" : "" }} {{ request()->is("admin/policy-travels*") ? "active" : "" }} {{ request()->is("admin/policy-vehicles*") ? "active" : "" }} {{ request()->is("admin/policy-motors*") ? "active" : "" }} {{ request()->is("admin/policy-pas*") ? "active" : "" }} {{ request()->is("admin/policy-rumah-gedungs*") ? "active" : "" }} {{ request()->is("admin/policy-kesehatans*") ? "active" : "" }} {{ request()->is("admin/api-sync-logs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.policy.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('policies_central_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.policies-centrals.index") }}" class="nav-link {{ request()->is("admin/policies-centrals") || request()->is("admin/policies-centrals/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-dollar-sign">

                                        </i>
                                        <p>
                                            {{ trans('cruds.policiesCentral.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('policy_travel_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.policy-travels.index") }}" class="nav-link {{ request()->is("admin/policy-travels") || request()->is("admin/policy-travels/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-plane-departure">

                                        </i>
                                        <p>
                                            {{ trans('cruds.policyTravel.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('policy_vehicle_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.policy-vehicles.index") }}" class="nav-link {{ request()->is("admin/policy-vehicles") || request()->is("admin/policy-vehicles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-car">

                                        </i>
                                        <p>
                                            {{ trans('cruds.policyVehicle.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('policy_motor_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.policy-motors.index") }}" class="nav-link {{ request()->is("admin/policy-motors") || request()->is("admin/policy-motors/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-motorcycle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.policyMotor.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('policy_pa_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.policy-pas.index") }}" class="nav-link {{ request()->is("admin/policy-pas") || request()->is("admin/policy-pas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.policyPa.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('policy_rumah_gedung_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.policy-rumah-gedungs.index") }}" class="nav-link {{ request()->is("admin/policy-rumah-gedungs") || request()->is("admin/policy-rumah-gedungs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-home">

                                        </i>
                                        <p>
                                            {{ trans('cruds.policyRumahGedung.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('policy_kesehatan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.policy-kesehatans.index") }}" class="nav-link {{ request()->is("admin/policy-kesehatans") || request()->is("admin/policy-kesehatans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hospital-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.policyKesehatan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('api_sync_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.api-sync-logs.index") }}" class="nav-link {{ request()->is("admin/api-sync-logs") || request()->is("admin/api-sync-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bezier-curve">

                                        </i>
                                        <p>
                                            {{ trans('cruds.apiSyncLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('claim_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/claim-type-groups*") ? "menu-open" : "" }} {{ request()->is("admin/claim-types*") ? "menu-open" : "" }} {{ request()->is("admin/document-types-claims*") ? "menu-open" : "" }} {{ request()->is("admin/detail-document-claims*") ? "menu-open" : "" }} {{ request()->is("admin/claims*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/claim-type-groups*") ? "active" : "" }} {{ request()->is("admin/claim-types*") ? "active" : "" }} {{ request()->is("admin/document-types-claims*") ? "active" : "" }} {{ request()->is("admin/detail-document-claims*") ? "active" : "" }} {{ request()->is("admin/claims*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-ambulance">

                            </i>
                            <p>
                                {{ trans('cruds.claimManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('claim_type_group_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.claim-type-groups.index") }}" class="nav-link {{ request()->is("admin/claim-type-groups") || request()->is("admin/claim-type-groups/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-boxes">

                                        </i>
                                        <p>
                                            {{ trans('cruds.claimTypeGroup.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('claim_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.claim-types.index") }}" class="nav-link {{ request()->is("admin/claim-types") || request()->is("admin/claim-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-archive">

                                        </i>
                                        <p>
                                            {{ trans('cruds.claimType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('document_types_claim_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.document-types-claims.index") }}" class="nav-link {{ request()->is("admin/document-types-claims") || request()->is("admin/document-types-claims/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-address-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.documentTypesClaim.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('detail_document_claim_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.detail-document-claims.index") }}" class="nav-link {{ request()->is("admin/detail-document-claims") || request()->is("admin/detail-document-claims/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.detailDocumentClaim.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('claim_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.claims.index") }}" class="nav-link {{ request()->is("admin/claims") || request()->is("admin/claims/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.claim.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('marketing_targer_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.marketing-targers.index") }}" class="nav-link {{ request()->is("admin/marketing-targers") || request()->is("admin/marketing-targers/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-money-bill-alt">

                            </i>
                            <p>
                                {{ trans('cruds.marketingTarger.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('invoice_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.invoices.index") }}" class="nav-link {{ request()->is("admin/invoices") || request()->is("admin/invoices/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-file-invoice-dollar">

                            </i>
                            <p>
                                {{ trans('cruds.invoice.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>