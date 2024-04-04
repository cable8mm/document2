<?php

use App\Actions\CleanTemplateAction;

it('run CleanTemplateAction', function () {
    (new CleanTemplateAction())->execute();

    expect(
        public_path('index.html')
    )->not->toBeFile();
});
