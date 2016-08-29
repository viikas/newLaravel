<?php

namespace Modules\Quotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNoteRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $data = [
            'quote_id' => 'required',
            'notes' => 'required',
            'user_name' => 'required'
        ];
        return $data;
    }

    public function messages() {
        return [
            'quote_id.required' => 'Quote id is required.',
            'note.required' => 'Not cannot be empty.',
            'user_name.required' => 'User name is required.',
        ];
    }

}
