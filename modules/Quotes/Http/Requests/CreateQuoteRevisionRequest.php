<?php namespace Modules\Quotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuoteRevisionRequest extends FormRequest {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    /*We will write authorization rule here for create template action*/
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
      'opportunity_id_fk'=>'required',
      'quote_id' => 'required',
      'title'=>'required',
      'quote_status_id_fk'=>'required',
      'is_include_vat'=>'required|boolean',
      'product_category_id_fk'=>'required',
      'is_glass'=>'required|boolean',
      'created_by' => 'required',
    ];
  }
  
  public function messages()
  {
    return [
      //general
      'opportunity_id.required' => 'Opportunity is required.',
      'title.required' => 'Title is required.',
      'quote_status_id.required' => 'Quote Status is required.',
      'a_include_vat.required' => 'Is include vat is required.',
      'is_active.boolean' => 'Is include vat should be true or false.',
      'product_category_id_fk.required' => 'Product category is required',
      'is_glass.required' => 'Is glass is required',
      'is_glass.boolean' => 'Is glass shoud be true or false',
      'created_by.required' => "Created by is required"
      
    ];
  }

}
