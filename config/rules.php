<?php

$colors = ['red', 'blue', 'green', 'purple', 'orange', 'yellow', 'aqua', 'pink'];

return [
    'color' => ['required', \Illuminate\Validation\Rule::in($colors)],
    'title' => 'nullable|string',
    'footer_description' => 'required|string',
    'footer_links' => 'nullable|array',
];
