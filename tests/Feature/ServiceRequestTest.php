<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceRequestTest extends TestCase
{
    use RefreshDatabase;

    private function validData($categoryId, $overrides = [])
    {
        return array_merge([
            'category_id' => $categoryId,
            'title'       => 'Broken ceiling light',
            'description' => 'The corridor light does not turn on.',
            'location'    => 'Block A, Room 204',
            'priority'    => 'high',
        ], $overrides);
    }

    public function test_guest_is_redirected_to_login()
    {
        $this->get('/requests')->assertRedirect('/login');
    }

    public function test_user_can_create_request()
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::create(['name' => 'Electrical']);

        $response = $this->actingAs($user)
            ->post('/requests', $this->validData($category->id));

        $response->assertRedirect('/requests');
        $this->assertDatabaseHas('service_requests', [
            'title'   => 'Broken ceiling light',
            'user_id' => $user->id,
        ]);
    }

    public function test_title_is_required()
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::create(['name' => 'Electrical']);

        $response = $this->actingAs($user)
            ->post('/requests', $this->validData($category->id, ['title' => '']));

        $response->assertSessionHasErrors('title');
    }

    public function test_user_cannot_edit_another_users_request()
    {
        $owner = User::factory()->create(['role' => 'user']);
        $other = User::factory()->create(['role' => 'user']);
        $category = Category::create(['name' => 'Electrical']);

        $item = ServiceRequest::create(
            $this->validData($category->id, ['user_id' => $owner->id])
        );

        $this->actingAs($other)
            ->get("/requests/{$item->id}/edit")
            ->assertStatus(403);
    }

    public function test_admin_can_change_status()
    {
        $owner = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create(['name' => 'Electrical']);

        $item = ServiceRequest::create(
            $this->validData($category->id, ['user_id' => $owner->id])
        );

        $response = $this->actingAs($admin)->put(
            "/requests/{$item->id}",
            $this->validData($category->id, ['status' => 'completed'])
        );

        $response->assertRedirect('/requests');
        $this->assertDatabaseHas('service_requests', [
            'id'     => $item->id,
            'status' => 'completed',
        ]);
    }

    public function test_search_finds_matching_request()
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::create(['name' => 'Plumbing']);

        ServiceRequest::create($this->validData($category->id, [
            'user_id' => $user->id,
            'title'   => 'Broken ceiling light',
        ]));
        ServiceRequest::create($this->validData($category->id, [
            'user_id'     => $user->id,
            'title'       => 'Leaking tap',
            'description' => 'Water drips all day.',
        ]));

        $this->actingAs($user)
            ->get('/requests?search=Leaking')
            ->assertSee('Leaking tap')
            ->assertDontSee('Broken ceiling light');
    }
}