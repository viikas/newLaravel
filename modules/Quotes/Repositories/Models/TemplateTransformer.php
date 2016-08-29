<?php namespace Modules\Quotes\Repositories\Models;

use Fractal;

class TemplateTransformer extends Fractal\TransformerAbstract
{
	public function transform($data)
	{
	    return [
	        'template_id'      => (int) $data->id,
	        'template_code'   => $data->code,
	        'description'    => $data->description,
                'image'    => $data->image,
                'template_type'    => $data->type,
                'created_date'    => $data->created_at,
                'updated_date'    => $data->updated_at,
                'active'    => $data->is_active,
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/books/'.$book->id,
                ]
            ],
	    ];
	}
}



