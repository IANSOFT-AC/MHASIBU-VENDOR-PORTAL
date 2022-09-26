<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%username_field_from_users}}`.
 */
class m220926_142613_drop_username_field_from_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%user}}', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
    }
}
