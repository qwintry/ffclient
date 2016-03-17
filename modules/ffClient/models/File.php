<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 26.02.2016
     * Time: 14:37
     */

    namespace app\modules\ffClient\models;

    use yii\base\Exception;
    use yii\web\UploadedFile;

    class File extends UploadedFile
    {
        public $uploadPath;
        public $uploadedFilePath;

        /**
         * File constructor.
         */
        public function init()
        {
            parent::init();
            $this->uploadPath = \Yii::getAlias('@webroot/uploads/');
        }

        /**
         * @param \yii\web\UploadedFile $file
         *
         * @return bool
         */
        public function upload()
        {
            $this->uploadedFilePath = $this->uploadPath.md5($this->baseName).'.'.$this->extension;
            if (!$this->saveAs($this->uploadedFilePath)) {
                throw new Exception('File not uploaded', 500);
            }
        }

        /**
         * @return string
         * @throws \yii\base\Exception
         */
        public function getBase64Encoded()
        {
            if ($this->uploadedFilePath && file_exists($this->uploadedFilePath)) {
                return base64_encode(file_get_contents($this->uploadedFilePath));
            }

            throw new Exception('File not uploaded', 500);
        }

        /**
         * @return bool
         * @throws \yii\base\Exception
         */
        public function delete()
        {
            if ($this->uploadedFilePath && file_exists($this->uploadedFilePath)) {
                return unlink($this->uploadedFilePath);
            }

            throw new Exception('File not uploaded', 500);
        }
    }