<?php
/**
 * Created by PhpStorm.
 * User: jeggy
 * Date: 1/24/17
 * Time: 10:19 PM
 */

return [
    'enable' => function($app){
        $util = $app['db']->getUtility();

        if($util->tableExists('@jebster_event') === false){
            $util->createTable('@jebster_event', function($table){
                $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
                $table->addColumn('title', 'string', ['length' => 255, 'default' => '']);
                $table->addColumn('slug', 'string', ['length' => 255]);
                $table->addColumn('description', 'text');
                $table->addColumn('short_description', 'text');
                $table->addColumn('creator_id', 'integer', ['unsigned' => true, 'length' => 10, 'default' => 0]);
                $table->addColumn('location', 'string', ['length' => 255, 'default' => '']);
                $table->addColumn('map', 'boolean');
                $table->addColumn('start', 'datetime');
                $table->addColumn('end', 'datetime');
                $table->addColumn('active', 'boolean');
                $table->addColumn('repeating', 'integer', ['length' => 10, 'notnull' => false, 'default' => null]);
                $table->addColumn('data', 'json_array', ['notnull' => false]);

                $table->setPrimaryKey(['id']);
                $table->addUniqueIndex(['slug'], '@BLOG_POST_SLUG');
            });
        }
    }
];