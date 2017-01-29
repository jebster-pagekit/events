<?php

/**
 * Created by PhpStorm.
 * User: jeggy
 * Date: 1/24/17
 * Time: 10:16 PM
 */

namespace Jebster\Events\Model;

use Pagekit\Database\ORM\ModelTrait;
use Pagekit\Application as App;

/**
 * @Entity(tableClass="@jebster_event")
 */
class Event
{
    use ModelTrait;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column */
    public $title = '';

    /** @Column(type="text") */
    public $description = '';

    /** @Column(type="integer") */
    public $creator_id;

    /** @BelongsTo(targetEntity="Pagekit\User\Model\User", keyFrom="creator_id") */
    public $creator;

    /** @Column */
    public $location = '';

    /** @Column(type="datetime") */
    public $start;

    /** @Column(type="datetime") */
    public $end;

    /** @Column */
    public $fb_event = '';

    /** @Column(type="boolean") */
    public $active = true;

    /** @Column(type="integer") */
    public $repeating = null;
}