<?php
use Cviebrock\EloquentSluggable\Sluggable;

return [
    'source'             => null,
    'method'             => null,
    'onUpdate'           => true,
    'separator'          => '-',
    'unique'             => true,
    'uniqueSuffix'       => null,
    'firstUniqueSuffix'  => 2,
    'includeTrashed'     => false,
    'reserved'           => null,
    'maxLength'          => null,
    'maxLengthKeepWords' => true,
    'slugEngineOptions'  => [],
    'method' => ['Illuminate\\Support\\Str', 'slug'],
];