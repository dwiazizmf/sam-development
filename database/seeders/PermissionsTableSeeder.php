<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 3,
                'title' => 'permission_show',
            ],
            [
                'id'    => 4,
                'title' => 'permission_access',
            ],
            [
                'id'    => 5,
                'title' => 'role_create',
            ],
            [
                'id'    => 6,
                'title' => 'role_edit',
            ],
            [
                'id'    => 7,
                'title' => 'role_show',
            ],
            [
                'id'    => 8,
                'title' => 'role_delete',
            ],
            [
                'id'    => 9,
                'title' => 'role_access',
            ],
            [
                'id'    => 10,
                'title' => 'user_create',
            ],
            [
                'id'    => 11,
                'title' => 'user_edit',
            ],
            [
                'id'    => 12,
                'title' => 'user_show',
            ],
            [
                'id'    => 13,
                'title' => 'user_delete',
            ],
            [
                'id'    => 14,
                'title' => 'user_access',
            ],
            [
                'id'    => 15,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 16,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 17,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 18,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 19,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 20,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 21,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 22,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 23,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 24,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 25,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 26,
                'title' => 'task_create',
            ],
            [
                'id'    => 27,
                'title' => 'task_edit',
            ],
            [
                'id'    => 28,
                'title' => 'task_show',
            ],
            [
                'id'    => 29,
                'title' => 'task_delete',
            ],
            [
                'id'    => 30,
                'title' => 'task_access',
            ],
            [
                'id'    => 31,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 32,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 33,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 34,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 35,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 36,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 37,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 38,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 39,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 40,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 41,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 42,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 43,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 44,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 45,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 46,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 47,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 48,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 49,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 50,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 51,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 52,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 53,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 54,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 55,
                'title' => 'contact_management_access',
            ],
            [
                'id'    => 56,
                'title' => 'contact_company_create',
            ],
            [
                'id'    => 57,
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => 58,
                'title' => 'contact_company_show',
            ],
            [
                'id'    => 59,
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => 60,
                'title' => 'contact_company_access',
            ],
            [
                'id'    => 61,
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => 62,
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => 63,
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => 64,
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => 65,
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => 66,
                'title' => 'insurance_company_create',
            ],
            [
                'id'    => 67,
                'title' => 'insurance_company_edit',
            ],
            [
                'id'    => 68,
                'title' => 'insurance_company_show',
            ],
            [
                'id'    => 69,
                'title' => 'insurance_company_delete',
            ],
            [
                'id'    => 70,
                'title' => 'insurance_company_access',
            ],
            [
                'id'    => 71,
                'title' => 'claim_management_access',
            ],
            [
                'id'    => 72,
                'title' => 'claim_type_create',
            ],
            [
                'id'    => 73,
                'title' => 'claim_type_edit',
            ],
            [
                'id'    => 74,
                'title' => 'claim_type_show',
            ],
            [
                'id'    => 75,
                'title' => 'claim_type_delete',
            ],
            [
                'id'    => 76,
                'title' => 'claim_type_access',
            ],
            [
                'id'    => 77,
                'title' => 'claim_type_group_create',
            ],
            [
                'id'    => 78,
                'title' => 'claim_type_group_edit',
            ],
            [
                'id'    => 79,
                'title' => 'claim_type_group_show',
            ],
            [
                'id'    => 80,
                'title' => 'claim_type_group_delete',
            ],
            [
                'id'    => 81,
                'title' => 'claim_type_group_access',
            ],
            [
                'id'    => 82,
                'title' => 'document_types_claim_create',
            ],
            [
                'id'    => 83,
                'title' => 'document_types_claim_edit',
            ],
            [
                'id'    => 84,
                'title' => 'document_types_claim_show',
            ],
            [
                'id'    => 85,
                'title' => 'document_types_claim_delete',
            ],
            [
                'id'    => 86,
                'title' => 'document_types_claim_access',
            ],
            [
                'id'    => 87,
                'title' => 'insurance_product_create',
            ],
            [
                'id'    => 88,
                'title' => 'insurance_product_edit',
            ],
            [
                'id'    => 89,
                'title' => 'insurance_product_show',
            ],
            [
                'id'    => 90,
                'title' => 'insurance_product_delete',
            ],
            [
                'id'    => 91,
                'title' => 'insurance_product_access',
            ],
            [
                'id'    => 92,
                'title' => 'policy_access',
            ],
            [
                'id'    => 93,
                'title' => 'api_sync_log_create',
            ],
            [
                'id'    => 94,
                'title' => 'api_sync_log_edit',
            ],
            [
                'id'    => 95,
                'title' => 'api_sync_log_show',
            ],
            [
                'id'    => 96,
                'title' => 'api_sync_log_delete',
            ],
            [
                'id'    => 97,
                'title' => 'api_sync_log_access',
            ],
            [
                'id'    => 98,
                'title' => 'product_type_create',
            ],
            [
                'id'    => 99,
                'title' => 'product_type_edit',
            ],
            [
                'id'    => 100,
                'title' => 'product_type_show',
            ],
            [
                'id'    => 101,
                'title' => 'product_type_delete',
            ],
            [
                'id'    => 102,
                'title' => 'product_type_access',
            ],
            [
                'id'    => 103,
                'title' => 'claim_create',
            ],
            [
                'id'    => 104,
                'title' => 'claim_edit',
            ],
            [
                'id'    => 105,
                'title' => 'claim_show',
            ],
            [
                'id'    => 106,
                'title' => 'claim_delete',
            ],
            [
                'id'    => 107,
                'title' => 'claim_access',
            ],
            [
                'id'    => 108,
                'title' => 'detail_document_claim_create',
            ],
            [
                'id'    => 109,
                'title' => 'detail_document_claim_edit',
            ],
            [
                'id'    => 110,
                'title' => 'detail_document_claim_show',
            ],
            [
                'id'    => 111,
                'title' => 'detail_document_claim_delete',
            ],
            [
                'id'    => 112,
                'title' => 'detail_document_claim_access',
            ],
            [
                'id'    => 113,
                'title' => 'marketing_targer_create',
            ],
            [
                'id'    => 114,
                'title' => 'marketing_targer_edit',
            ],
            [
                'id'    => 115,
                'title' => 'marketing_targer_show',
            ],
            [
                'id'    => 116,
                'title' => 'marketing_targer_delete',
            ],
            [
                'id'    => 117,
                'title' => 'marketing_targer_access',
            ],
            [
                'id'    => 118,
                'title' => 'policies_central_show',
            ],
            [
                'id'    => 119,
                'title' => 'policies_central_access',
            ],
            [
                'id'    => 120,
                'title' => 'policy_travel_create',
            ],
            [
                'id'    => 121,
                'title' => 'policy_travel_edit',
            ],
            [
                'id'    => 122,
                'title' => 'policy_travel_show',
            ],
            [
                'id'    => 123,
                'title' => 'policy_travel_delete',
            ],
            [
                'id'    => 124,
                'title' => 'policy_travel_access',
            ],
            [
                'id'    => 125,
                'title' => 'perluasan_pertanggungan_create',
            ],
            [
                'id'    => 126,
                'title' => 'perluasan_pertanggungan_edit',
            ],
            [
                'id'    => 127,
                'title' => 'perluasan_pertanggungan_show',
            ],
            [
                'id'    => 128,
                'title' => 'perluasan_pertanggungan_delete',
            ],
            [
                'id'    => 129,
                'title' => 'perluasan_pertanggungan_access',
            ],
            [
                'id'    => 130,
                'title' => 'jenis_pertanggungan_create',
            ],
            [
                'id'    => 131,
                'title' => 'jenis_pertanggungan_edit',
            ],
            [
                'id'    => 132,
                'title' => 'jenis_pertanggungan_show',
            ],
            [
                'id'    => 133,
                'title' => 'jenis_pertanggungan_delete',
            ],
            [
                'id'    => 134,
                'title' => 'jenis_pertanggungan_access',
            ],
            [
                'id'    => 135,
                'title' => 'policy_vehicle_create',
            ],
            [
                'id'    => 136,
                'title' => 'policy_vehicle_edit',
            ],
            [
                'id'    => 137,
                'title' => 'policy_vehicle_show',
            ],
            [
                'id'    => 138,
                'title' => 'policy_vehicle_delete',
            ],
            [
                'id'    => 139,
                'title' => 'policy_vehicle_access',
            ],
            [
                'id'    => 140,
                'title' => 'policy_pa_create',
            ],
            [
                'id'    => 141,
                'title' => 'policy_pa_edit',
            ],
            [
                'id'    => 142,
                'title' => 'policy_pa_show',
            ],
            [
                'id'    => 143,
                'title' => 'policy_pa_delete',
            ],
            [
                'id'    => 144,
                'title' => 'policy_pa_access',
            ],
            [
                'id'    => 145,
                'title' => 'jenis_rumah_gedung_create',
            ],
            [
                'id'    => 146,
                'title' => 'jenis_rumah_gedung_edit',
            ],
            [
                'id'    => 147,
                'title' => 'jenis_rumah_gedung_show',
            ],
            [
                'id'    => 148,
                'title' => 'jenis_rumah_gedung_delete',
            ],
            [
                'id'    => 149,
                'title' => 'jenis_rumah_gedung_access',
            ],
            [
                'id'    => 150,
                'title' => 'jenis_paket_create',
            ],
            [
                'id'    => 151,
                'title' => 'jenis_paket_edit',
            ],
            [
                'id'    => 152,
                'title' => 'jenis_paket_show',
            ],
            [
                'id'    => 153,
                'title' => 'jenis_paket_delete',
            ],
            [
                'id'    => 154,
                'title' => 'jenis_paket_access',
            ],
            [
                'id'    => 155,
                'title' => 'policy_rumah_gedung_create',
            ],
            [
                'id'    => 156,
                'title' => 'policy_rumah_gedung_edit',
            ],
            [
                'id'    => 157,
                'title' => 'policy_rumah_gedung_show',
            ],
            [
                'id'    => 158,
                'title' => 'policy_rumah_gedung_delete',
            ],
            [
                'id'    => 159,
                'title' => 'policy_rumah_gedung_access',
            ],
            [
                'id'    => 160,
                'title' => 'policy_kesehatan_create',
            ],
            [
                'id'    => 161,
                'title' => 'policy_kesehatan_edit',
            ],
            [
                'id'    => 162,
                'title' => 'policy_kesehatan_show',
            ],
            [
                'id'    => 163,
                'title' => 'policy_kesehatan_delete',
            ],
            [
                'id'    => 164,
                'title' => 'policy_kesehatan_access',
            ],
            [
                'id'    => 165,
                'title' => 'task_history_show',
            ],
            [
                'id'    => 166,
                'title' => 'task_history_access',
            ],
            [
                'id'    => 167,
                'title' => 'business_type_create',
            ],
            [
                'id'    => 168,
                'title' => 'business_type_edit',
            ],
            [
                'id'    => 169,
                'title' => 'business_type_show',
            ],
            [
                'id'    => 170,
                'title' => 'business_type_delete',
            ],
            [
                'id'    => 171,
                'title' => 'business_type_access',
            ],
            [
                'id'    => 172,
                'title' => 'status_prospect_create',
            ],
            [
                'id'    => 173,
                'title' => 'status_prospect_edit',
            ],
            [
                'id'    => 174,
                'title' => 'status_prospect_show',
            ],
            [
                'id'    => 175,
                'title' => 'status_prospect_delete',
            ],
            [
                'id'    => 176,
                'title' => 'status_prospect_access',
            ],
            [
                'id'    => 177,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 178,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 179,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 180,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 181,
                'title' => 'invoice_create',
            ],
            [
                'id'    => 182,
                'title' => 'invoice_edit',
            ],
            [
                'id'    => 183,
                'title' => 'invoice_show',
            ],
            [
                'id'    => 184,
                'title' => 'invoice_delete',
            ],
            [
                'id'    => 185,
                'title' => 'invoice_access',
            ],
            [
                'id'    => 186,
                'title' => 'comission_show',
            ],
            [
                'id'    => 187,
                'title' => 'comission_access',
            ],
            [
                'id'    => 188,
                'title' => 'policy_motor_create',
            ],
            [
                'id'    => 189,
                'title' => 'policy_motor_edit',
            ],
            [
                'id'    => 190,
                'title' => 'policy_motor_show',
            ],
            [
                'id'    => 191,
                'title' => 'policy_motor_delete',
            ],
            [
                'id'    => 192,
                'title' => 'policy_motor_access',
            ],
            [
                'id'    => 193,
                'title' => 'master_access',
            ],
            [
                'id'    => 194,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
