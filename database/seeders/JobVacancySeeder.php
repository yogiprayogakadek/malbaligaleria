<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vacancies = [
            [
                'title' => 'Graphic Designer',
                'department' => 'Marketing',
                'type' => 'full-time',
                'location' => 'Mal Bali Galeria, Kuta',
                'description' => 'We are looking for a creative Graphic Designer to join our team. You will be responsible for creating visual concepts, using computer software or by hand, to communicate ideas that inspire, inform, and captivate consumers.',
                'requirements' => "- Proficient in Adobe Creative Suite (Photoshop, Illustrator, InDesign).\n- Proven graphic designing experience with a strong portfolio.\n- Ability to interact, communicate and present ideas.\n- Up to date with industry leading software and technologies.",
                'responsibilities' => "- Develop concepts, graphics and layouts for product illustrations, company logos and websites.\n- Determine size and arrangement of copy and illustrative material, as well as font style and size.\n- Prepare rough drafts and present your ideas.\n- Amend final designs to clients comments and gain full approval.",
                'salary_range' => 'Competitive',
                'deadline' => now()->addMonths(2),
                'is_active' => true,
            ],
            [
                'title' => 'Customer Service Officer',
                'department' => 'Operations',
                'type' => 'full-time',
                'location' => 'Mal Bali Galeria, Kuta',
                'description' => 'As a Customer Service Officer, you will be the face of Mal Bali Galeria. You will provide excellent service to our visitors and handle inquiries with professionalism and a smile.',
                'requirements' => "- Minimum Diploma degree in any field.\n- Excellent communication skills in Indonesian and English.\n- Friendly, patient, and able to work in a team.\n- Willing to work in shifts (including weekends and public holidays).",
                'responsibilities' => "- Greet and assist visitors with their inquiries and needs.\n- Handle complaints and provide appropriate solutions.\n- Manage the information desk and loyalty program registrations.\n- Support mall events and promotions.",
                'salary_range' => null,
                'deadline' => now()->addMonth(),
                'is_active' => true,
            ],
            [
                'title' => 'Social Media Specialist',
                'department' => 'Marketing',
                'type' => 'contract',
                'location' => 'Remote / Mal Bali Galeria',
                'description' => 'We are looking for a Social Media Specialist to manage our online presence and engage with our digital community. You will be responsible for creating content, monitoring trends, and analyzing social media performance.',
                'requirements' => "- Proven work experience as a Social Media Specialist or similar role.\n- Excellent consulting, writing, editing (photo/video/text), presentation and communication skills.\n- Knowledge of online marketing and good understanding of major social media channels.\n- Positive attitude, detail and customer oriented with good multitasking and organisational ability.",
                'responsibilities' => "- Build and execute social media strategy through competitive research, platform determination, benchmarking, messaging and audience identification.\n- Generate, edit, publish and share daily content (original text, images, video or HTML) that builds meaningful connections and encourages community members to take action.\n- Set up and optimize company pages within each platform to increase the visibility of company’s social content.",
                'salary_range' => 'Negotiable',
                'deadline' => now()->addWeeks(3),
                'is_active' => true,
            ],
            [
                'title' => 'Maintenance Technician',
                'department' => 'Engineering',
                'type' => 'full-time',
                'location' => 'Mal Bali Galeria, Kuta',
                'description' => 'The Maintenance Technician is responsible for performing general maintenance and repairs for the mall facilities and equipment.',
                'requirements' => "- Vocational school (SMK) or Diploma in Electrical/Mechanical Engineering.\n- Experience in building maintenance (AC, plumbing, electrical).\n- Able to troubleshoot and repair common technical issues.\n- Discipline and responsive to urgent maintenance requests.",
                'responsibilities' => "- Perform routine maintenance tasks on building systems.\n- Inspect facilities and troubleshoot equipment issues.\n- Repair or replace broken items as needed.\n- Maintain a clean and safe working environment.",
                'salary_range' => null,
                'deadline' => now()->addMonths(6),
                'is_active' => true,
            ],
        ];

        foreach ($vacancies as $vacancy) {
            JobVacancy::create($vacancy);
        }
    }
}
