<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    public function test_public_homepage_is_available_to_guests(): void
    {
        $this->withoutVite();

        $this->get('/')
            ->assertOk();
    }

    public function test_homepage_describes_the_programme_and_its_two_phases(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Design for inclusion and learning impact');
        $response->assertSee('Acceleration for responsible scale');

        $text = strtolower(strip_tags($response->getContent()));

        $this->assertStringContainsString('growth-stage venture acceleration', $text);
        $this->assertStringContainsString('two programme phases', $text);
    }
}
