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
                $table->addColumn('description', 'text');
                $table->addColumn('creator_id', 'integer', ['unsigned' => true, 'length' => 10, 'default' => 0]);
                $table->addColumn('location', 'string', ['length' => 255, 'default' => '']);
                $table->addColumn('start', 'datetime');
                $table->addColumn('end', 'datetime');
                $table->addColumn('fb_event', 'string', ['length' => 511, 'default' => '']);
                $table->addColumn('active', 'boolean');
                $table->addColumn('repeating', 'integer', ['length' => 10, 'notnull' => false, 'default' => null]);

                $table->setPrimaryKey(['id']);
            });
        }
    }
];