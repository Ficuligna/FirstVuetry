<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\User;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Task::class, 30)-> make()
                               ->each(function($task){
          $user = User::inRandomOrder() -> first();
          $task-> user() -> associate($user);
          $task -> save();
      });
    }
}
