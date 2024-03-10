<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [__('новый'), __('в работе'), __('на тестировании'), __('завершен')];

        DB::beginTransaction();
        foreach ($statuses as $status) {
            TaskStatus::create(['name' => $status]);
        }
        DB::commit();
    }
}
