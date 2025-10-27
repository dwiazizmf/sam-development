<?php

namespace App\Http\Requests;

use App\Models\PoliciesCentral;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePoliciesCentralRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('policies_central_edit');
    }

    public function rules()
    {
        return [
            'policy_number' => [
                'string',
                'required',
                'unique:policies_centrals,policy_number,' . $this->getCentralId(),
            ],
            'policy_number_external' => [
                'string',
                'nullable',
            ],
            'insurance_product_id' => [
                'required',
                'integer',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'premium_amount' => [
                'numeric|decimal:0,2',
                'required',
            ],
            'discount' => [
                'numeric',
            ],
            'discount_total' => [
                'numeric',
            ],
            'sum_insured' => [
                'numeric|decimal:0,2',
                'required',
            ],
            'policy_status' => [
                'required',
            ],
            'payment_status' => [
                'required',
            ],
            'external_polis_doc' => [
                'array',
            ],
             'assigned_to_user_id' => [
                'integer',
            ],
             'assigned_to_customer_id' => [
                'integer',
            ],
            'aksessoris_tambahan' => [
                'string',
                'nullable',
            ],
            'aksesoris_harga' => [
                'numeric|decimal:0,2',
                'nullable',
            ],
            'biaya_lainnya' => [
                'numeric|decimal:0,2',
                'nullable',
            ]
        ];
    }

    private function getCentralId(): ?int
    {
        // Pastikan ada parameter route
        $paramNames = request()->route()?->parameterNames() ?? [];
        $key = $paramNames[0] ?? null;
        if (!$key) return null;

        // Tentukan model berdasarkan route parameter
        $modelClass = match ($key) {
            'policy_travel' => \App\Models\PolicyTravel::class,
            'policy_vehicle' => \App\Models\PolicyVehicle::class,
            'policy_motor' => \App\Models\PolicyMotor::class,
            'policy_pa' => \App\Models\PolicyPa::class,
            'policy_rumah_gedung' => \App\Models\PolicyRumahGedung::class,
            'policy_kedehatan' => \App\Models\PolicyKesehatan::class,
            default => null,
        };

        if (!$modelClass) return null;

        // Ambil value dari route (bisa object atau ID)
        $routeValue = request()->route($key);
        $id = is_object($routeValue) ? $routeValue->id : $routeValue;

        // Ambil id_policies dari model child
        return $modelClass::where('id', $id)->value('id_policies_id');
    }


}
