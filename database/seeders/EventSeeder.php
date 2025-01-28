<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owners = User::where('role', 'event_owner')->get();
        $staff = User::where('role', 'staff')->get();
        $visitors = User::where('role', 'visitor')->get();

        Event::factory(3)->create()->each(function ($event) use ($owners, $staff, $visitors) {
            $event->owners()->attach($owners->random(rand(1, 2))->pluck('id')->mapWithKeys(function ($id) {
                return [$id => ['role' => 'event_owner']];
            }));

            $event->staff()->attach($staff->random(rand(2, 5))->pluck('id')->mapWithKeys(function ($id) {
                return [$id => ['role' => 'staff']];
            }));

            $event->visitors()->attach($visitors->random(rand(5, 10))->pluck('id')->toArray());
            // $event->visitors()->attach($visitors->random(rand(5, 10))->pluck('id')->mapWithKeys(function ($id) {
            //     return [$id => ['role' => 'visitor']];
            // }));
        });
    }
}
