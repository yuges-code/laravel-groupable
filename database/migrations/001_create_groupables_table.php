<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Config\Config;
use Yuges\Groupable\Models\Groupable;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getGroupableClass(Groupable::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            if (Config::getGroupableKeyHas(false)) {
                $table->key(Config::getGroupableKeyType(KeyType::BigInteger));
            }

            $table
                ->foreignIdFor(Config::getGroupClass(Group::class))
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->keyMorphs(
                Config::getGroupableKeyType(KeyType::BigInteger),
                Config::getGroupableRelationName('groupable')
            );

            Config::getPermissionsAnonymous(false)
                ? $table->nullableKeyMorphs(
                    Config::getGrouperatorKeyType(KeyType::BigInteger),
                    Config::getGrouperatorRelationName('grouperator')
                )
                : $table->keyMorphs(
                    Config::getGrouperatorKeyType(KeyType::BigInteger),
                    Config::getGrouperatorRelationName('grouperator')
                );

            $table->order();
            $table->unique(['group_id', 'groupable_id', 'groupable_type']);

            $table->timestamps();
        });
    }
};
