<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'usuario.ver']);
        Permission::create(['name' => 'usuario.crear']);
        Permission::create(['name' => 'usuario.editar']);
        Permission::create(['name' => 'usuario.eliminar']);
    }

    public function test_guests_cannot_access_users_index(): void
    {
        $response = $this->get(route('admin.users.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_without_permission_cannot_access_users_index(): void
    {
        $user = User::factory()->create(['is_active' => true]);
        $this->actingAs($user);

        $response = $this->get(route('admin.users.index'));
        $response->assertStatus(403);
    }

    public function test_authenticated_user_with_permission_can_access_users_index(): void
    {
        $user = User::factory()->create(['is_active' => true]);
        $user->givePermissionTo('usuario.ver');
        $this->actingAs($user);

        $response = $this->get(route('admin.users.index'));
        $response->assertStatus(200);
    }

    public function test_inactive_user_cannot_acess_users_index(): void
    {
        $user = User::factory()->create(['is_active' => false]);
        $user->givePermissionTo('usuario.ver');
        $this->actingAs($user);

        $response = $this->get(route('admin.users.index'));
        $response->assertRedirect();
    }

    // Test para crear usuarios

    public function test_guest_cannot_access_users_create(): void
    {
        $response = $this->get(route('admin.users.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_without_permission_cannot_access_users_create(): void
    {
        $user = User::factory()->create(['is_active' => true]);
        $this->actingAs($user);

        $response = $this->get(route('admin.users.create'));
        $response->assertStatus(403);
    }

    public function test_authenticated_user_with_permission_can_access_users_create(): void
    {
        $user = User::factory()->create(['is_active' => true]);
        $user->givePermissionTo('usuario.crear');
        $this->actingAs($user);

        $response = $this->get(route('admin.users.create'));
        $response->assertStatus(200);
    }

    // Test para editasr usuarios
    public function test_guest_cannot_access_users_edit(): void
    {
        $userToEdit = User::factory()->create();

        $response = $this->get(route('admin.users.edit', $userToEdit));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_without_permission_cannot_access_users_edit(): void
    {
        $user = User::factory()->create(['is_active' => true]);
        $userToEdit = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('admin.users.edit', $userToEdit));
        $response->assertStatus(403);
    }

    public function test_authenticated_user_with_permission_can_access_users_edit(): void
    {
        $user = User::factory()->create(['is_active' => true]);
        $userToEdit = User::factory()->create();
        $user->givePermissionTo('usuario.editar');
        $this->actingAs($user);

        $response = $this->get(route('admin.users.edit', $userToEdit));
        $response->assertStatus(200);
    }

    public function test_user_edit_returns_404_for_nonexistent_user(): void
    {
        $user = User::factory()->create(['is_active' => true]);
        $user->givePermissionTo('usuario.editar');
        $this->actingAs($user);

        $response = $this->get(route('admin.users.edit', 9999));
        $response->assertStatus(404);
    }

    public function test_inactive_user_cannot_access_users_edit(): void
    {
        $user = User::factory()->create(['is_active' => false]);
        $userToEdit = User::factory()->create();
        $user->givePermissionTo('usuario.editar');
        $this->actingAs($user);

        $response = $this->get(route('admin.users.edit', $userToEdit));
        $response->assertRedirect();
    }
}
