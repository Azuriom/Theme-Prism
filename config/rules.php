<?php

$colors = ['red', 'blue', 'green', 'purple', 'orange', 'yellow', 'aqua', 'pink'];

return [
    'color' => ['required', \Illuminate\Validation\Rule::in($colors)],
    'title' => 'nullable|string',
    'use_play_button' => ['filled'],
    'play_button_link' => ['required_with:use_play_button'],
    'footer_description' => 'required|string',
    'footer_links' => 'nullable|array',
];
