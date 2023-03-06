<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookRequest extends FormRequest
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
            'title' => 'required',
            'count' => 'required|integer|gt:0',
            'price' => 'required|integer|gt:0',
            'authors' => ((User::ROLE_AUTHOR != Auth::user()->role) ? 'required|array' : ''),
            'authors.*' => ((User::ROLE_AUTHOR != Auth::user()->role) ? 'integer' : '')
        ];
    }

}