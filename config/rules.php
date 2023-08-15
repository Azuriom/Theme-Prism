<?php

return [
    'color' => ['required', new \Azuriom\Rules\Color()],
    'title' => 'nullable|string',
    'footer_description' => 'required|string',
    'footer_links' => 'nullable|array',
];
