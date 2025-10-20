<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePolicyUnifiedRequest extends FormRequest
{
    public function authorize()
    {
        $type = $this->getPolicyType();
        $canCentral = Gate::allows('policies_central_edit');

        $canSub = match ($type) {
            'travel'  => Gate::allows('policy_travel_edit'),
            'mobil'  => Gate::allows('policy_vehicle_edit'),
            'motor'      => Gate::allows('policy_motor_edit'),
            'pa' => Gate::allows('policy_pa_edit'),
            'rumahGedung' => Gate::allows('policy_rumah_gedung_edit'),
            'kesehatan' => Gate::allows('policy_kesehatan_edit'),
            default   => false,
        };

        return $canCentral && $canSub;
    }

    public function rules()
    {
        $centralRules = (new UpdatePoliciesCentralRequest())->rules();
        $typeRules = match ($this->getPolicyType()) {
            'travel'  => (new UpdatePolicyTravelRequest())->rules(),
            'mobil'  => (new UpdatePolicyVehicleRequest())->rules(),
            'motor'      => (new UpdatePolicyMotorRequest())->rules(),
            'pa' => (new UpdatePolicyPaRequest())->rules(),
            'rumahGedung'      => (new UpdatePolicyRumahGedungRequest())->rules(),
            'kesehatan' => (new UpdatePolicyKesehatanRequest())->rules(),
            default   => [],
        };
        return array_merge($centralRules, $typeRules);
    }

    public function centralData(): array
    {
        return $this->only(array_keys((new UpdatePoliciesCentralRequest())->rules()));
    }

    public function childData(): array
    {
        $rules = match ($this->getPolicyType()) {
            'travel'  => (new UpdatePolicyTravelRequest())->rules(),
            'mobil'  => (new UpdatePolicyVehicleRequest())->rules(),
            'motor'      => (new UpdatePolicyMotorRequest())->rules(),
            'pa' => (new UpdatePolicyPaRequest())->rules(),
            'rumahGedung'      => (new UpdatePolicyRumahGedungRequest())->rules(),
            'kesehatan' => (new UpdatePolicyKesehatanRequest())->rules(),
            default   => throw new \InvalidArgumentException("Unknown policy type: {$type}"),
        };

        return $this->only(array_keys($rules));
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
