<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Tasks;

use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\UrlQuestion;

class SupportDetailTask extends Task
{
    public static function key(): string
    {
        return 'details';
    }

    public function label(): string
    {
        return 'Provide support details';
    }

    public function questions(): array
    {
        return [
            LabelQuestion::class,
            TypeQuestion::class,
            TargetQuestion::class,
            UrlQuestion::class,
        ];
    }
}
