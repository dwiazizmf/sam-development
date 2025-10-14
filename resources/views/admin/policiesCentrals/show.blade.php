@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.policiesCentral.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policies-centrals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.id') }}
                        </th>
                        <td>
                            {{ $policiesCentral->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.assigned_to_customer') }}
                        </th>
                        <td>
                            {{ $policiesCentral->assigned_to_customer->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.policy_number') }}
                        </th>
                        <td>
                            {{ $policiesCentral->policy_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.policy_number_external') }}
                        </th>
                        <td>
                            {{ $policiesCentral->policy_number_external }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.insurance_product') }}
                        </th>
                        <td>
                            {{ $policiesCentral->insurance_product->product_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.start_date') }}
                        </th>
                        <td>
                            {{ $policiesCentral->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.end_date') }}
                        </th>
                        <td>
                            {{ $policiesCentral->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.premium_amount') }}
                        </th>
                        <td>
                            {{ $policiesCentral->premium_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.discount') }}
                        </th>
                        <td>
                            {{ $policiesCentral->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.discount_total') }}
                        </th>
                        <td>
                            {{ $policiesCentral->discount_total }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.aksessoris_tambahan') }}
                        </th>
                        <td>
                            {{ $policiesCentral->aksessoris_tambahan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.aksesoris_harga') }}
                        </th>
                        <td>
                            {{ $policiesCentral->aksesoris_harga }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.biaya_lainnya') }}
                        </th>
                        <td>
                            {{ $policiesCentral->biaya_lainnya }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.sum_insured') }}
                        </th>
                        <td>
                            {{ $policiesCentral->sum_insured }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.policy_status') }}
                        </th>
                        <td>
                            {{ App\Models\PoliciesCentral::POLICY_STATUS_SELECT[$policiesCentral->policy_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.payment_status') }}
                        </th>
                        <td>
                            {{ App\Models\PoliciesCentral::PAYMENT_STATUS_SELECT[$policiesCentral->payment_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.external_polis_doc') }}
                        </th>
                        <td>
                            @foreach($policiesCentral->external_polis_doc as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.assigned_to_user') }}
                        </th>
                        <td>
                            {{ $policiesCentral->assigned_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.external_policy') }}
                        </th>
                        <td>
                            {{ $policiesCentral->external_policy->system_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policiesCentral.fields.created_by') }}
                        </th>
                        <td>
                            {{ $policiesCentral->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policies-centrals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#policies_claims" role="tab" data-toggle="tab">
                {{ trans('cruds.claim.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#id_policies_policy_kesehatans" role="tab" data-toggle="tab">
                {{ trans('cruds.policyKesehatan.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#id_policies_policy_travels" role="tab" data-toggle="tab">
                {{ trans('cruds.policyTravel.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#polis_invoices" role="tab" data-toggle="tab">
                {{ trans('cruds.invoice.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#id_policies_policy_motors" role="tab" data-toggle="tab">
                {{ trans('cruds.policyMotor.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#id_policies_policy_pas" role="tab" data-toggle="tab">
                {{ trans('cruds.policyPa.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#id_policies_policy_vehicles" role="tab" data-toggle="tab">
                {{ trans('cruds.policyVehicle.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#id_policies_policy_rumah_gedungs" role="tab" data-toggle="tab">
                {{ trans('cruds.policyRumahGedung.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="policies_claims">
            @includeIf('admin.policiesCentrals.relationships.policiesClaims', ['claims' => $policiesCentral->policiesClaims])
        </div>
        <div class="tab-pane" role="tabpanel" id="id_policies_policy_kesehatans">
            @includeIf('admin.policiesCentrals.relationships.idPoliciesPolicyKesehatans', ['policyKesehatans' => $policiesCentral->idPoliciesPolicyKesehatans])
        </div>
        <div class="tab-pane" role="tabpanel" id="id_policies_policy_travels">
            @includeIf('admin.policiesCentrals.relationships.idPoliciesPolicyTravels', ['policyTravels' => $policiesCentral->idPoliciesPolicyTravels])
        </div>
        <div class="tab-pane" role="tabpanel" id="polis_invoices">
            @includeIf('admin.policiesCentrals.relationships.polisInvoices', ['invoices' => $policiesCentral->polisInvoices])
        </div>
        <div class="tab-pane" role="tabpanel" id="id_policies_policy_motors">
            @includeIf('admin.policiesCentrals.relationships.idPoliciesPolicyMotors', ['policyMotors' => $policiesCentral->idPoliciesPolicyMotors])
        </div>
        <div class="tab-pane" role="tabpanel" id="id_policies_policy_pas">
            @includeIf('admin.policiesCentrals.relationships.idPoliciesPolicyPas', ['policyPas' => $policiesCentral->idPoliciesPolicyPas])
        </div>
        <div class="tab-pane" role="tabpanel" id="id_policies_policy_vehicles">
            @includeIf('admin.policiesCentrals.relationships.idPoliciesPolicyVehicles', ['policyVehicles' => $policiesCentral->idPoliciesPolicyVehicles])
        </div>
        <div class="tab-pane" role="tabpanel" id="id_policies_policy_rumah_gedungs">
            @includeIf('admin.policiesCentrals.relationships.idPoliciesPolicyRumahGedungs', ['policyRumahGedungs' => $policiesCentral->idPoliciesPolicyRumahGedungs])
        </div>
    </div>
</div>

@endsection