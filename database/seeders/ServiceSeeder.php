<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => 'github',
                'image_url' => 'https://img.favpng.com/11/4/4/computer-icons-github-icon-design-png-favpng-XEGR4H8ZTC4dv7qja6v0N2FzD.jpg',
            ],
            [
                'name' => 'gitlab',
                'image_url' => 'https://banner2.cleanpng.com/20180713/hfv/kisspng-logo-version-control-gitlab-brand-e-commerce-gitlab-5b482945dfad48.8320886315314558139162.jpg',
            ],
            [
                'name' => 'bitbucket',
                'image_url' => 'https://img.favpng.com/4/7/1/bitbucket-logo-stash-atlassian-bamboo-png-favpng-ZDy2haBp78hcCAxwneQNfmMQC.jpg',
            ],
        ];

        $insertServices = DB::table('services')->insert($services);

        $insertServices ? \Log::info('Seeded services') : \Log::error('Seeded services failed');
    }
}
