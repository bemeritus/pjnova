<?php

namespace Laravel\Nova\Testing\Browser\Components\Modals;

use Laravel\Dusk\Browser;

class RestoreResourceModalComponent extends ModalComponent
{
    /**
     * Modal confirmation button.
     *
     * @return void
     */
    public function confirm(Browser $browser)
    {
        $browser->click('@confirm-restore-button');
    }

    /**
     * Modal cancelation button.
     *
     * @return void
     */
    public function cancel(Browser $browser)
    {
        $browser->click('@cancel-restore-button');
    }
}
