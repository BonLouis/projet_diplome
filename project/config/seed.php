<?php
return [
    'clean_images' => env('CLEAN_STORAGE_AT_SEED', false),
    'nb_posts' => intval(env('NB_POST_AT_SEED', 20)),
];