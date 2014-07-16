<?php

namespace Zelenin\yii\modules\Tag\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;
use Zelenin\yii\modules\Tag\helpers\TagHelper;
use Zelenin\yii\modules\Tag\models\Item;

class Tag extends InputWidget
{
    /** @var bool $multiple */
    public $multiple = false;
    /** @var array $data */
    public $data = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->data = ArrayHelper::map(Item::find()->fromCategory(TagHelper::getCategoryFromClass($this->model->className()), $this->attribute)->all(), 'id', 'name');
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->multiple) {
            echo Html::activeCheckboxList($this->model, $this->attribute, $this->data);
        } else {
            echo Html::activeDropDownList($this->model, $this->attribute, $this->data, ['prompt' => '', 'class' => 'form-control']);
        }
        parent::run();
    }
}
