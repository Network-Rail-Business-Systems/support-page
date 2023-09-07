<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

class SupportDetailFactory extends Factory
{
    protected $model = SupportDetail::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomKey(TypeQuestion::OPTIONS),
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
}
