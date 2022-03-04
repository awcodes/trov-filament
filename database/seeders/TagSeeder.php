<?php

namespace Database\Seeders;

use Faker\Factory;
use Spatie\Tags\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $faqTags = [
            'In Store Personal Loans Title Loans',
            'Titlemax Online Loans',
            'Process',
            'Qualifications',
            'Payments',
            'Bad Credit Loans',
            'TitleMax Customer Portal',
            'TitleMax Vehicle Appraisal Process',
            'Notary Public Services',
            'Flexible Line of Credit',
        ];

        foreach ($faqTags as $tag) {
            Tag::findOrCreate($tag, 'faqTag');
        }

        foreach (range(1, 15) as $index) {
            Tag::findOrCreate($faker->words(rand(1, 5), true), 'postTag');
        }
    }
}
