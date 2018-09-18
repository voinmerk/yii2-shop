<?php
namespace backend\widgets;

use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

/*
 * CategoryList Class
 *
 * Виджет построения дерева категорий
 * 
 * Обладает тримя параметрами
 *
 * 
 */
class CategoryList extends Widget
{
	/*public $categories;

	public $current_id;*/

    public function init()
    {
        parent::init();

        /*$categories = ArrayHelper::map($this->categories, 'id', 'name');

        echo '<select name="">';

        foreach($this->categories as $category) {

        	$id = $category->parent_id;
        	$name = $category->name;

        	$prefix = '';

        	$selected = ($id != $this->current_id ? '' : ' selected');

        	if($categories[$id] !)
        	
        	echo '<option value="' . $id . '"' . $selected . '>' . $prefix . $name . '</option>';

        }

        echo '</select>';*/
    }
}
