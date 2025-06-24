<?php

namespace NetworkRailBusinessSystems\SupportPage\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

class SupportDetailFactory extends Factory
{
    protected $model = SupportDetail::class;

    public function definition(): array
    {
        return [
            'type' => TypeQuestion::GUIDES_AND_RESOURCES,
            'target' => $this->faker->url(),
            'label' => $this->faker->words(3, true),
        ];
    }

    public function withType(string $type): Factory
    {
        return $this->state([
            'type' => $type,
        ]);
    }

    public function withLabel(string $label): Factory
    {
        return $this->state([
            'label' => $label,
        ]);
    }

    public function withSystemQuestions(bool $role = false): Factory
    {
        $target = $role === false
            ? $this->faker->email
            : config('support-page.role_model')::first()->name;

        return $this->state([
            'type' => TypeQuestion::SYSTEM_QUESTIONS,
            'target' => $target,
        ]);
    }
}
