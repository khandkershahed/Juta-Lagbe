<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {

        $this->ensureIsNotRateLimited();
        $identifier = $this->string('email');
        $password = $this->string('password');
        $hash_password = Hash::make($password);
        $remember = $this->boolean('remember');
        if (!Auth::guard('admin')->attempt(['email' => $identifier, 'password' => $password], $remember) &&
        !Auth::guard('admin')->attempt(['phone' => $identifier, 'password' => $password], $remember)) {

            RateLimiter::hit($this->throttleKey());

            $errors = [];
            if (!Admin::where('email', $identifier)->exists() && !Admin::where('phone', $identifier)->exists()) {
                $errors['identifier'] = trans('Email or Phone number is not correct');
            } else if (!Admin::where('password', $hash_password)->exists()) {
                $errors['password'] = trans('Password is not correct');
            }


            throw ValidationException::withMessages($errors);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('admin.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
