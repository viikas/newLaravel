<?php namespace Modules\Quotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGlobalSettingsRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//general
		'field_code'=>'required',
        	'field_name'=>'required',
        	'field_value'=>'required',
        	'field_data_type'=>'required',
        	'setting_type'=>'required',
        	   'remark'=>'required',     	        		
        	        			];
	}


	public function messages()
	{

		return[
		'field_code.required'=>'field code is required.',
		'field_name.required'=>'field name is required.',
		'field_data_type.required'=>'field data type is required.',
		'setting_type.required'=>'setting type is required',
		'remark.required'=>'remark is required',
	];

	}

}
