<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seederData = [
            [["id"=>1],["title"=>"Reading"]],
            [["id"=>2],["title"=>"Video Games"]],
            [["id"=>3],["title"=>"Sports"]],
            [["id"=>4],["title"=>"Travelling"]],
        ];
        foreach ($seederData as $socialplatform) {
            Interest::updateOrCreate($socialplatform[0],$socialplatform[1]);
        }
    }
}
