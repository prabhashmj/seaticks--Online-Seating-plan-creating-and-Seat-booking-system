<?php

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;



class PhotoSphere extends DataObject
{
    private static $db = [
        'Title' => 'Varchar',
        'Markers' => 'Text'
    ];

    private static $has_one = [
        'Image' => Image::class,
    ];

    private static $owns = [
        'Image'
    ];
}
