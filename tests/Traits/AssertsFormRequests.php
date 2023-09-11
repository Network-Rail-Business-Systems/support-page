<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Traits;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Test your Laravel FormRequests without pulling your hair out!
 * Simply include this trait on your test and call the assert methods.
 *
 * @author Anthony Edmonds
 *
 * @link https://github.com/AnthonyEdmonds
 */
trait AssertsFormRequests
{
    protected function assertFormRequestPasses(FormRequest $request, User $user = null)
    {
        $this->assertTrue($this->runFormRequest($request, $user));
    }

    protected function assertFormRequestFails(FormRequest $request, User $user = null)
    {
        $this->assertFalse($this->runFormRequest($request, $user));
    }

    protected function runFormRequest(FormRequest $request, User $user = null): bool
    {
        if ($user !== null) {
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
        }

        return $this->app['validator']->make($request->query->all(), $request->rules())->passes();
    }
}
