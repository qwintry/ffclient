<?php

    use yii\db\Migration;

    class m130524_201442_init extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->execute("
                CREATE TABLE `user` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `username` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
                    `auth_key` VARCHAR(32) NOT NULL COLLATE 'utf8_unicode_ci',
                    `password_hash` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
                    `password_reset_token` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
                    `email` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
                    `status` SMALLINT(6) NOT NULL DEFAULT '10',
                    `created_at` INT(11) NOT NULL,
                    `updated_at` INT(11) NOT NULL,
                    `first_name` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
                    `last_name` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
                    `ff_id` INT(9) NULL DEFAULT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE INDEX `username` (`username`),
                    UNIQUE INDEX `email` (`email`),
                    UNIQUE INDEX `ff_id` (`ff_id`),
                    UNIQUE INDEX `password_reset_token` (`password_reset_token`)
                )
                COLLATE='utf8_unicode_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=8
            ;");
        }

        public function down()
        {
            $this->dropTable('{{%user}}');
        }
    }