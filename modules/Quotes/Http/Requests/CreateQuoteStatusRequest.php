<?php namespace Modules\Quotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuoteStatusRequest extends FormRequest {

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
			//status_code,status_name,remarks
		// general rules
		'status_code'=>'required',
		'status_name'=>'required',
		'remarks'=>'required'
		];
	}

	// Related Messages to be sent in case of not validated
	public function messages(){
		return [
		// General messages
		'status_code.required'=>'Status Code is required.',
		'status_name.required'=>'Status Name is required.',
		'remarks.required'=>'Remarks is required.'
		];
	}

}
