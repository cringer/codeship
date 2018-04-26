<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewUrlsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_view_urls()
    {
        // Load some sample data
        $url = factory(\App\Url::class)->create([
            'shortened_url' => 'http://tSQ1r84',
            'original_url' => 'http://www.google.com',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/view-urls')
                ->assertPathIs('/view-urls')
                ->assertSee('Manage URLs')
                ->assertSee('http://tSQ1r84')
                ->assertSee('http://www.google.com');
        });
    }

    /** @test */
    function a_user_can_click_view_urls()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/view-urls')
                ->clickLink('View URLs')
                ->assertPathIs('/view-urls');
        });
    }

        /** @test */
        function a_user_can_click_add_url()
        {
            $this->browse(function (Browser $browser) {
                $browser->visit('/view-urls')
                    ->clickLink('Add URL')
                    ->assertPathIs('/manage-url');
            });
        }
}
