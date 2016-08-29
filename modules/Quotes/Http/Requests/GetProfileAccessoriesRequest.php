<?php namespace Modules\Quotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetProfileAccessoriesRequest extends FormRequest {

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
			//quote_productprice_revision/general
		//'product_id'=>'required|integer',
		//'profile_price'=>'required',
		
		//'invent_price'=>'required',
		//'revised_price'=>'required',
		//'effective_date'=>'required',
		//'remark'=>'required',


		//accessories
		// 'accessories.*.accessory_id_fk'=>'required|integer',
		// 'accessories.*.code'=>'required',
		// 'accessories.*.sl_detail'=>'required',
		// 'accessories.*.revised_price'=>'required',
		];
	}


	public function messages()
	{

		return [
		//general

		// 'invent_price.required'=>'inventory price is required',
		// 'revised_price.required'=>'revised price is required',
		// 'effective_date.required'=>'effective date is requred',
		// 'remark.required'=>'remark is required',
		// //profile
		// 'profiles.*.profile_id_fk.required'=>'profile id should be specified for all profile item',
		// 'profiles.*.number.required'=>'number should be specified for all profile item',
		// 'profiles.*.weight.required'=>'weight should be specified for all profile item',
		// 'profiles.*.note.required'=>'note is required for all profile item',
		// ///accessories
		// 'accessories.*.accessory_id_fk.required'=>'accessory id should be specified for all accessories',
		// 'accessories.*.code.required'=>'code should be specified for all accessories',
		// 'accessories.*.sl_detail.required'=>'details should be specified for all accessories',
		// 'accessories.*.revised_price.required'=>'revised price should be specified for all accessories',

	];

	}


}
