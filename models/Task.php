<?php

namespace app\models;

use yii\db\ActiveRecord;

class Task extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%tasks}}';
    }

    public function fields(): array
    {
        return [
            'id',
            'parent_id',
            'name',
            'description',
            'user_id',
            'assigned_to_id',
            'validated_by_id',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function extraFields(): array
    {
        return [
            'creator', 'assignedTo', 'validator', 'files', 'comments'
        ];
    }

    public function getCreator(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getAssignedTo(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'assigned_to_id']);
    }

    public function getValidator(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'validated_by_id']);
    }

    public function getFiles(): \yii\db\ActiveQuery
    {
        return $this->hasMany(TaskFile::class, ['task_id', 'id']);
    }

    public function getComments(): \yii\db\ActiveQuery
    {
        return $this->hasMany(TaskComment::class, ['task_id', 'id']);
    }
}