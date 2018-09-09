<?php

namespace Tests\Browser;

use App\Pizza;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ExampleTest extends DuskTestCase
{
    /**
     * Test Home Page
     * @throws \Throwable
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('CossackFood');
        });
    }
}
