<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    private $models = [
        'Role'               => 'cruds.role.title',
        'User'               => 'cruds.user.title',
        'Task'               => 'cruds.task.title',
        'CrmStatus'          => 'cruds.crmStatus.title',
        'CrmCustomer'        => 'cruds.crmCustomer.title',
        'CrmDocument'        => 'cruds.crmDocument.title',
        'ContactCompany'     => 'cruds.contactCompany.title',
        'ContactContact'     => 'cruds.contactContact.title',
        'InsuranceCompany'   => 'cruds.insuranceCompany.title',
        'ClaimType'          => 'cruds.claimType.title',
        'ClaimTypeGroup'     => 'cruds.claimTypeGroup.title',
        'DocumentTypesClaim' => 'cruds.documentTypesClaim.title',
        'InsuranceProduct'   => 'cruds.insuranceProduct.title',
        'ApiSyncLog'         => 'cruds.apiSyncLog.title',
        'ProductType'        => 'cruds.productType.title',
        'Claim'              => 'cruds.claim.title',
        'MarketingTarger'    => 'cruds.marketingTarger.title',
        'PoliciesCentral'    => 'cruds.policiesCentral.title',
        'PolicyTravel'       => 'cruds.policyTravel.title',
        'TaskHistory'        => 'cruds.taskHistory.title',
    ];

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search === null || ! isset($search['term'])) {
            abort(400);
        }

        $term           = $search['term'];
        $searchableData = [];
        foreach ($this->models as $model => $translation) {
            $modelClass = 'App\Models\\' . $model;
            $query      = $modelClass::query();

            $fields = $modelClass::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%' . $term . '%');
            }

            $results = $query->take(10)
                ->get();

            foreach ($results as $result) {
                $parsedData           = $result->only($fields);
                $parsedData['model']  = trans($translation);
                $parsedData['fields'] = $fields;
                $formattedFields      = [];
                foreach ($fields as $field) {
                    $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                }
                $parsedData['fields_formated'] = $formattedFields;

                $parsedData['url'] = url('/admin/' . Str::plural(Str::snake($model, '-')) . '/' . $result->id . '/edit');

                $searchableData[] = $parsedData;
            }
        }

        return response()->json(['results' => $searchableData]);
    }
}
