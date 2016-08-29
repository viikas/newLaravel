<?php

namespace Modules\Quotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTemplateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        /* We will write authorization rule here for create template action */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //general
            'code' => 'required',
            'description' => 'required',
            'type' => 'required',
            'is_active' => 'required|boolean',
            'product_model_id' => 'required|integer',
            //settings
            'settings.*.field_code' => 'required',
            'settings.*.field_name' => 'required',
            'settings.*.field_value' => 'required',
            'settings.*.field_data_type' => 'required',
            //profiles
            'profiles.*.profile_id_fk' => 'required|integer',
            'profiles.*.is_fly_screen' => 'required|boolean',
            'profiles.*.qty_length' => 'required|numeric',
            //accessories
            'accessories.*.accessory_id_fk' => 'required|integer',
            'accessories.*.is_roller' => 'required|boolean',
            'accessories.*.qty_length' => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            //general
            'code.required' => 'Template code is required.',
            'description.required' => 'Description is required.',
            'type.required' => 'Template type is required.',
            'is_active.required' => 'It should be specified whether the template is active or not.',
            'is_active.boolean' => 'Active field should be true or false.',
            'product_model_id.required' => 'Product model is required.',
            'product_model_id.integer' => 'Product model should be passed as integer.',
            //settings
            'settings.*.field_code.required' => 'Code should be specified for all setting items .',
            'settings.*.field_name.required' => 'Name should be specified for all setting items .',
            'settings.*.field_value.required' => 'Value should be specified for all setting items .',
            'settings.*.field_data_type.required' => 'Data type should be specified for all setting items .',
            //profiles
            'profiles.*.profile_id_fk.required' => 'Profile id should be specified for all profile items.',
            'profiles.*.profile_id_fk.integer' => 'Profile id should be integer for all profile items.',
            'profiles.*.is_fly_screen.required' => 'It should be specified whether profile item is fly screen or not.',
            'profiles.*.is_fly_screen.boolean' => 'Fly screen for profile item should be true or false.',
            'profiles.*.qty_length.required' => 'Quantiy-length is required for all profile items.',
            'profiles.*.qty_length.numeric' => 'Quantiy-length of profile item should be numeric.',
            //accessories
            'accessories.*.accessory_id_fk.required' => 'Accessory id should be specified for all accessory items.',
            'accessories.*.accessory_id_fk.integer' => 'Accessory id should be integer for all accessory items.',
            'accessories.*.is_roller.required' => 'It should be specified whether accessory item is roller or not.',
            'accessories.*.is_roller.boolean' => 'Roller for accessory item should be true or false.',
            'accessories.*.qty_length.required' => 'Quantiy-length is required for all accessory items.',
            'accessories.*.qty_length.numeric' => 'Quantiy-length of accessory item should be numeric.',
        ];
    }

}
