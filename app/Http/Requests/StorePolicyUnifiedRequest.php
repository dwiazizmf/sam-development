<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePolicyUnifiedRequest extends FormRequest
{
    public function authorize()
    {
        $type = $this->getPolicyType();
        $canCentral = Gate::allows('policies_central_create');

        $canSub = match ($type) {
            'travel'  => Gate::allows('policy_travel_create'),
            'mobil'  => Gate::allows('policy_vehicle_create'),
            'motor'      => Gate::allows('policy_motor_create'),
            'pa' => Gate::allows('policy_pa_create'),
            'rumahGedung' => Gate::allows('policy_rumah_gedung_create'),
            'kesehatan' => Gate::allows('policy_kesehatan_create'),
            default   => false,
        };

        return $canCentral && $canSub;
    }

    public function rules()
    {
        $centralRules = (new StorePoliciesCentralRequest())->rules();
        $typeRules = match ($this->getPolicyType()) {
            'travel'  => (new StorePolicyTravelRequest())->rules(),
            'mobil'  => (new StorePolicyVehicleRequest())->rules(),
            'motor'      => (new StorePolicyMotorRequest())->rules(),
            'pa' => (new StorePolicyPaRequest())->rules(),
            'rumahGedung'      => (new StorePolicyRumahGedungRequest())->rules(),
            'kesehatan' => (new StorePolicyKesehatanRequest())->rules(),
            default   => [],
        };
        return array_merge($centralRules, $typeRules);
    }

    public function centralData(): array
    {
        return array_merge(
            $this->only(array_keys((new StorePoliciesCentralRequest())->rules())),
            ['created_by_id' => auth()->id()]
        );
    }

    public function childData(): array
    {
        $rules = match ($this->getPolicyType()) {
            'travel'  => (new StorePolicyTravelRequest())->rules(),
            'mobil'  => (new StorePolicyVehicleRequest())->rules(),
            'motor'      => (new StorePolicyMotorRequest())->rules(),
            'pa' => (new StorePolicyPaRequest())->rules(),
            'rumahGedung'      => (new StorePolicyRumahGedungRequest())->rules(),
            'kesehatan' => (new StorePolicyKesehatanRequest())->rules(),
            default   => throw new \InvalidArgumentException("Unknown policy type: {$type}"),
        };

        return array_merge($this->only(array_keys($rules)), ['created_by_id' => auth()->id()]);
    }

    public function getPolicyType(): ?string
    {
        $type = match (request()->segment(2)) {
            'policy-travels'  => 'travel',
            'policy-vehicles'  => 'mobil',
            'policy-motors'      => 'motor',
            'plicy-pas' => 'pa',
            'plicy-rumah-gedungs' => 'rumahGedung',
            'plicy-kesehatans' => 'kesehatan',
            default   => '',
        };;

        // Ambil dari input atau route parameter
        return $type;
    }
}
