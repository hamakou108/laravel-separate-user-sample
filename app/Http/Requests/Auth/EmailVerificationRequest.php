<?php


namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest as IlluminateEmailVerificationRequest;

class EmailVerificationRequest extends IlluminateEmailVerificationRequest
{
    public function authorize()
    {
        if (! hash_equals((string) $this->route('id'),
            (string) $this->user()->getAuthIdentifier())) {
            return false;
        }

        if (! hash_equals((string) $this->route('hash'),
            sha1($this->user()->getEmailForVerification()))) {
            return false;
        }

        return true;
    }
}
