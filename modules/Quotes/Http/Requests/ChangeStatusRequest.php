<?php namespace Modules\Quotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest {
/**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    /*We will write authorization rule here */
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
      $data = [
      'quote_id'=>'required',
      'status_id'=>'required',
      'user_name'=>'required'
    ];
    return $data;
  }
  
  public function messages()
  {
    return [
        'quote_item_id.required' => 'Quote item id is required.',
      'status_id.required' => 'Quote status id is required.',
      'user_name.required' => 'User name is required.',
    ];
  }

}
