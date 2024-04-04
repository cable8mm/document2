<?php

use App\Actions\CopyTemplateAction;

test('CopyTemplateAction run', function () {
    (new CopyTemplateAction('laravel'))->execute();

    expect(
        public_path('index.html')
    )->toBeFile();
});
