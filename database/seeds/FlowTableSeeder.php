<?php
/**
 * Created by PhpStorm.
 * User: Kontiki
 * Date: 25/05/2015
 * Time: 11:32 AM
 */
use \Illuminate\Database\Seeder;




class FlowTableSeeder extends Seeder{
    public function run()
    {
        \DB::table('flows')->truncate();
        \DB::table('flows_steps')->truncate();
        \DB::table('flows_steps_transitions')->truncate();

        \DB::table('flows')->insert([
           'name' => 'Task Flow',
            'description'=>'Task flow description',
            'module' => 'Tasks',
            'Active' => 1
        ]);
        \DB::table('flows_steps')->insert(
            [
            'flow_id' => 1,
            'name' => 'pending',
            'description' => 'task pending',
            'order' => 1,
            'is_last' =>0
            ],
            [
                'flow_id' => 1,
                'name' => 'done',
                'description' => 'task done',
                'order' => 2,
                'is_last' =>1

            ]
            );
        \DB::table('flows_steps_transitions')->insert([
            'flow_id' => 1,
            'step_from_id' => 1,
            'step_to_id' => 2
        ]);



    }

}