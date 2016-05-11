<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 14:24
     */

    namespace app\modules\ffClient\models\forms;
    /**
     * Class OutgoingForm
     * @package app\modules\ffClient\models\forms
     */
    class OutgoingForm extends ApiForm
    {
        public $address;
        public $passportFiles;

        public function rules()
        {
            return [
                [
                    ['passportFiles'],
                    'file',
                    'skipOnEmpty' => true,
                    'extensions'  => 'png, jpg, pdf, jpeg, bmp',
                    'maxFiles'    => 10,
                ],
            ];
        }
    }