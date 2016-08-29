<?php namespace Modules\Quotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuoteItemRequest extends FormRequest {

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
      //item
      // 'quote_id'=>'required',
      // 'description'=>'required',
      // 'size'=>'required',
      // 'quantity'=>'required',
      // 'unit_price'=>'required',
      // 'total'=>'required',
      //item_templates
      'item_templates.*.template_code' => 'required',
      'item_templates.*.template_type' => 'required',
      'item_templates.*.material_cost' => 'required|numeric',
      'item_templates.*.fabrication_cost' => 'required|numeric',
      'item_templates.*.glass_cost' => 'required|numeric',
      //item_template_settings
      'item_templates.*.item_template_settings.*.field_code' => 'required',
      'item_templates.*.item_template_settings.*.field_name' => 'required',
      'item_templates.*.item_template_settings.*.field_value' => 'required',
      'item_templates.*.item_template_settings.*.field_data_type' => 'required',
      //item_template_profiles
      'item_templates.*.item_template_profiles.*.aluminium' => 'required',
      'item_templates.*.item_template_profiles.*.formula' => 'required',
      'item_templates.*.item_template_profiles.*.qty_length' => 'required|numeric',
      'item_templates.*.item_template_profiles.*.kg_meter' => 'required|numeric',
      'item_templates.*.item_template_profiles.*.amount' => 'required|numeric',
      //item_template_accessories
      'item_templates.*.item_template_accessories.*.acc_ref' => 'required',
      'item_templates.*.item_template_accessories.*.description' => 'required',
      'item_templates.*.item_template_accessories.*.formula' => 'required',
      'item_templates.*.item_template_accessories.*.qty_length' => 'required|numeric',
      'item_templates.*.item_template_accessories.*.mu_cost_rs' => 'required|numeric',
      'item_templates.*.item_template_accessories.*.total_price' => 'required|numeric',
      //item_template_infill   samyak may 23 2016 
      //  'item_templates.*.item_template_infill.*.is_fixed' => 'required',
      // 'item_templates.*.item_template_infill.*.panel_count' => 'required',
      // 'item_templates.*.item_template_infill.*.length_formula' => 'required',
      // 'item_templates.*.item_template_infill.*.height_formula' => 'required',
      // 'item_templates.*.item_template_infill.*.length_mm' => 'required',
      // 'item_templates.*.item_template_infill.*.height_mm' => 'required',
      // 'item_templates.*.item_template_infill.*.infill_area_sqft' => 'required',
      // 'item_templates.*.item_template_infill.*.actual_infill_area' => 'required',
      // 'item_templates.*.item_template_infill.*.bible_suggested' => 'required',
      // 'item_templates.*.item_template_infill.*.is_glass' => 'required',
      // 'item_templates.*.item_template_infill.*.infill_type_id_fk' => 'required',
      // 'item_templates.*.item_template_infill.*.infill_thickness_id_fk' => 'required',
      // 'item_templates.*.item_template_infill.*.infill_unit_cost' => 'required',
      // 'item_templates.*.item_template_infill.*.infill_total_cost' => 'required',


    ];
  }
  
  public function messages()
  {
    return [
      //general
      'quote_id.required' => 'Quote is required.',
      'description.required' => 'Description is required.',
      'size.required' => 'Size is required.',
      'quantity.required' => 'Quantity is required.',
      'unit_price.required' => 'Unit price is required.',
      'total.required' => 'Total is required',
      //item_templates
      'item_templates.*.template_code.required' => 'Template code is required',
      'item_templates.*.template_type.required' => 'Template type is required',
      'item_templates.*.material_cost.required' => 'Material cost is required',
      'item_templates.*.material_cost.numeric' => 'Material cost should be numeric',
      'item_templates.*.fabrication_cost.required' => 'Fabrication cost is required',
      'item_templates.*.fabrication_cost.numeric' => 'Fabrication cost should be numeric',
      'item_templates.*.glass_cost.required' => 'Glass cost is required',
      'item_templates.*.glass_cost.numeric' => 'Glass cost should be numeric',
      
      //item_template_settings
      'item_templates.*.item_template_settings.*.field_code.required' => 'Field code is required',
      'item_templates.*.item_template_settings.*.field_name.required' => 'Field name is required',
      'item_templates.*.item_template_settings.*.field_value.required' => 'Field value is required',
      'item_templates.*.item_template_settings.*.field_data_type.required' => 'Data type is required',
      //item_template_profiles
      'item_templates.*.item_template_profiles.*.aluminium.required' => 'Aluminium is required',
      'item_templates.*.item_template_profiles.*.formula.required' => 'Formula is required',
      'item_templates.*.item_template_profiles.*.qty_length.required' => 'Quantity length is required',
      'item_templates.*.item_template_profiles.*.qty_length.numeric' => 'Quantity length should be numeric',
      'item_templates.*.item_template_profiles.*.kg_meter.required' => 'Kg/meter is required',
      'item_templates.*.item_template_profiles.*.kg_meter.numeric' => 'Kg/meter should be numeric',
      'item_templates.*.item_template_profiles.*.amount.required' => 'Amount is required',
      'item_templates.*.item_template_profiles.*.amount.numeric' => 'Amount should be numeric',
      
      //item_template_accessories
      'item_templates.*.item_template_accessories.*.acc_ref.required' => 'Accessory ref is required',
      'item_templates.*.item_template_accessories.*.description.required' => 'Accessory description is required',
      'item_templates.*.item_template_accessories.*.formula.required' => 'Accessory formula is required',
      'item_templates.*.item_template_accessories.*.qty_length.required' => 'Quantity length is required',
      'item_templates.*.item_template_accessories.*.qty_length.numeric' => 'Quantity length should be numeric',
      'item_templates.*.item_template_accessories.*.mu_cost_rs.required' => 'Mu cost rs is required',
      'item_templates.*.item_template_accessories.*.mu_cost_rs.numeric' => 'Mu cost rs should be numeric',
      'item_templates.*.item_template_accessories.*.total_price.required' => 'Total price is required',
      'item_templates.*.item_template_accessories.*.total_price.numeric' => 'Total price should be numeric',
      
    ];
  }

}
