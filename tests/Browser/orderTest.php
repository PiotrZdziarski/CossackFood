<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class orderTest extends DuskTestCase
{
    /**
     * test Order Page
     * @throws \Throwable
     */
    public function testOrderSubpage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/order')
                    ->assertSee('Order Online!')
                    ->assertSee('Summary');
        });
    }
}
