<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Config\Config;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getGroupClass(Group::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key(Config::getGroupKeyType(KeyType::BigInteger));

            Config::getPermissionsAnonymous(false)
                ? $table->nullableKeyMorphs(
                    Config::getGrouperatorKeyType(KeyType::BigInteger),
                    Config::getGrouperatorRelationName('grouperator')
                )
                : $table->keyMorphs(
                    Config::getGrouperatorKeyType(KeyType::BigInteger),
                    Config::getGrouperatorRelationName('grouperator')
                );
        });

        Schema::table($this->table, function (Blueprint $table) {
            $table
                ->foreignIdFor(Config::getGroupClass(Group::class), 'parent_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('slug')->unique();
            $table->string('name');
            $table->string('type')->nullable();

            $table->order();

            $table->timestamps();
        });
    }
};
