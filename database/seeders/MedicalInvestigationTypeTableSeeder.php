<?php

namespace Database\Seeders;

use App\Models\MedicalInvestigationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalInvestigationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataRaw = "Thoracic Inlet,,thoracic_inlet,Radiology,X-ray,string:Shoulder Joint,,shoulder_joint,Radiology,X-ray,string:Elbow Joint,,elbow_joint,Radiology,X-ray,string:Wrist Joint,,wrist_joint,Radiology,X-ray,string:Sacro Iliac Joint,,sacro,Radiology,X-ray,string:Pelvic Joint,,pelvic_joint,Radiology,X-ray,string:Hip Joint,,hip_joint,Radiology,X-ray,string:Knee Joint,,knee_joint,Radiology,X-ray,string:Ankle,,ankle,Radiology,X-ray,string:Radius/Ulner,,radius,Radiology,X-ray,string:Femoral,,femoral,Radiology,X-ray,string:Tibia/Fibula,,tibia,Radiology,X-ray,string:Fingers,,fingers,Radiology,X-ray,string:Toes,,toes,Radiology,X-ray,string:Foot,,foot,Radiology,X-ray,string:Obstetric,,obstetric,Radiology,Ultrasound Scan,string:Abdominal,,abdominal,Radiology,Ultrasound Scan,string:Pelvis,,pelvis,Radiology,Ultrasound Scan,string:Prostrate,,prostrate,Radiology,Ultrasound Scan,string:Breast,,breast,Radiology,Ultrasound Scan,string:Thyroid,,thyroid,Radiology,Ultrasound Scan,string
        ";

        $data = [
            [
                'name' => 'Chest',
                'description' => '',
                'code' => 'chest',
                'group' => 'Radiology',
                'subgroup' => 'X-ray',
                'result_type' => 'string'
            ],
            [
                'name' => 'Humerus',
                'description' => '',
                'code' => 'humerus',
                'group' => 'Radiology',
                'subgroup' => 'X-ray',
                'result_type' => 'string'
            ],
            [
                'name' => 'Cervical Vertebrae',
                'description' => '',
                'code' => 'cervical_vertebrae',
                'group' => 'Radiology',
                'subgroup' => 'X-ray',
                'result_type' => 'string'
            ],
            [
                'name' => 'Thoracic Vertebraee',
                'description' => '',
                'code' => 'thoracic_vertebrae',
                'group' => 'Radiology',
                'subgroup' => 'X-ray',
                'result_type' => 'string'
            ],
            [
                'name' => 'Lumvar Vertebrae',
                'description' => '',
                'code' => 'lumvar_vertebrae',
                'group' => 'Radiology',
                'subgroup' => 'X-ray',
                'result_type' => 'string'
            ],
            [
                'name' => 'Lumbo Sacral Vertebrae',
                'description' => '',
                'code' => 'lumbo_sacral',
                'group' => 'Radiology',
                'subgroup' => 'X-ray',
                'result_type' => 'string'
            ],
            [
                'name' => 'Thoraco Lumbar Vertebrae',
                'description' => '',
                'code' => 'thoraco_lumbar',
                'group' => 'Radiology',
                'subgroup' => 'X-ray',
                'result_type' => 'string'
            ],
            [
                'name' => 'Thoraco Lumbar Vertebrae',
                'description' => '',
                'code' => 'thoraco_lumbar',
                'group' => 'Radiology',
                'subgroup' => 'X-ray',
                'result_type' => 'string'
            ],
        ];

        foreach (explode(':', $dataRaw) as $rowSequence) {
            $dataItems = explode(',', $rowSequence);
            $data[] = [
                'name' => $dataItems[0],
                'description' => $dataItems[1],
                'code' => $dataItems[2],
                'group' => $dataItems[3],
                'subgroup' => $dataItems[4],
                'result_type' => $dataItems[5]
            ];
        }

        foreach ($data as $key => $value) {
            $type = MedicalInvestigationType::updateOrCreate([
                'name' => str_replace('            ', '', $value['name']),
            ], [
                'description' => $value['description'],
                'subgroup' => $value['subgroup'],
                'result_type' => in_array($value['result_type'], ['string', 'decimal', 'integer']) ? $value['result_type'] : null,
            ]);

            if ($value['group']) {
                $parent = MedicalInvestigationType::firstOrCreate(['name' => $value['group']]);
                $parent->children()->save($type);
            }
        }

    }
}
