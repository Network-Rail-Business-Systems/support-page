<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TargetQuestion;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use Illuminate\Support\Facades\Config;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class FieldsTest extends TestCase
{
    protected SupportDetail $subject;

    protected SupportDetailForm $form;

    protected TargetQuestion $question;

    protected TypeQuestion $type;

    protected array $roles;

    protected function setUp(): void
    {
        parent::setUp();

        $this->makeRole('Admin');
        $this->makeRole('Other role');
        $this->makeRole('Excluded role');

        Config::set('support-page.excluded_roles', ['Excluded role']);

        $this->subject = new SupportDetail();
        $this->subject->type = TypeQuestion::SYSTEM_QUESTIONS;
        $this->subject->target = 'a@b.com';

        $this->form = new SupportDetailForm($this->subject);

        $this->question = $this->form->tasks()
            ->task('details')
            ->question('target');
    }

    public function test(): void
    {
        $fields = $this->question->fields();

        $this->assertEquals(
            'mode',
            $fields[0]->name,
        );

        $this->assertEquals(
            'Who would you like to send system enquiries to?',
            $fields[0]->label,
        );

        $this->assertEquals(
            'Select a system role or provide an email address',
            $fields[0]->hint,
        );

        $this->assertEquals(
            'Target',
            $fields[0]->displayName,
        );

        $this->assertEquals(
            [
                'role' => [
                    'label' => 'Use a system role',
                    'inputs' => [
                        [
                            'label' => 'Which role would you like to send requests to?',
                            'name' => 'role',
                            'options' => [
                                'Admin' => 'Admin',
                                'Other role' => 'Other role',
                            ],
                            'type' => InputType::Select->value,
                            'value' => $this->subject->target,
                        ],
                    ],
                ],
                'divider' => [
                    'divider' => true,
                    'label' => 'or',
                ],
                'email' => [
                    'label' => 'Use an email address',
                    'inputs' => [
                        [
                            'label' => 'Which email address would you like to use?',
                            'name' => 'email',
                            'hint' => 'Enter an email address including @networkrail.co.uk',
                            'value' => $this->form->model->target,
                            'width' => 20,
                        ],
                    ],
                ],
            ],
            $fields[0]->options,
        );
    }
}
