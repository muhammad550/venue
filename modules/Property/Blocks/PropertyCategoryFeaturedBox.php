<?php
namespace Modules\Property\Blocks;

use Modules\Property\Models\PropertyCategory;
use Modules\Template\Blocks\BaseBlock;
use Modules\Core\Models\Terms;

class PropertyCategoryFeaturedBox extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Desc')
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Icon style")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Image BG style")
                        ],
                    ],
                    'default'=>'style_1'
                ],
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('List Item(s)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'    => 'icon',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label' => __('Icon class')
                        ],
                        [
                            'id'           => 'category_id',
                            'type'         => 'select2',
                            'label'        => __('Select category property'),
                            'select2'      => [
                                'ajax'     => [
                                    'url'      => route('property.admin.category.getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'width'    => '100%',
                            ],
                            'pre_selected' => route('property.admin.category.getForSelect2', [
                                'pre_selected' => 1
                            ])
                        ],
                        [
                            'id'    => 'bg_image',
                            'type'  => 'uploader',
                            'label' => __('Background Image Uploader')
                        ],
                    ]
                ],


            ]
        ]);
    }

    public function getName()
    {
        return __('Property: Category Featured Box');
    }

    public function content($model = [])
    {

        if (!empty($model['list_item'])) {
            $ids = \Arr::pluck($model['list_item'], 'category_id');
            if (!empty($ids)) {
                $rows = PropertyCategory::whereIn('id', $ids)->where('status', 'publish')->get();
                foreach ($model['list_item'] as &$item) {
                    $item['category'] = $rows->where('id', $item['category_id'])->first();
                }
            }
        }
        return view('Property::frontend.blocks.category-featured-box.index', $model);
    }
}