<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 15:11
     */

    namespace app\modules\ffClient\models\forms;

    class SpecialRequestForm extends ApiForm
    {
        public $customerFiles;

        public function rules()
        {
            return [
                [
                    ['customerFiles'],
                    'file',
                    'skipOnEmpty' => true,
                    'extensions'  => 'png, jpg, pdf, jpeg, bmp',
                    'maxFiles'    => 10,
                ],
            ];
        }
    }