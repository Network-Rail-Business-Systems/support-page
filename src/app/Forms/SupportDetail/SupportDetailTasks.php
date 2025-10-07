<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Tasks\SupportDetailTask;

class SupportDetailTasks extends Tasks
{
    public function tasks(): array
    {
        return [
            SupportDetailTask::class,
        ];
    }
}
