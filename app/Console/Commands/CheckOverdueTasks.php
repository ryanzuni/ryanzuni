<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CheckOverdueTasks extends Command
{
    protected $signature = 'check:overdue-tasks';
    protected $description = 'Cek tugas overdue dan catat ke activity log';

    public function handle()
    {
        $now = Carbon::now()->toDateString();

        $overdueTasks = Task::where('status', '!=', 'done')
            ->where('due_date', '<', $now)
            ->get();

        foreach ($overdueTasks as $task) {
            ActivityLog::create([
                'id' => Str::uuid(),
                'user_id' => $task->assigned_to,
                'action' => 'overdue_task',
                'description' => 'Task overdue: ' . $task->id,
                'logged_at' => now()
            ]);
        }

        $this->info(count($overdueTasks) . ' task overdue dicatat ke log.');
    }
}
