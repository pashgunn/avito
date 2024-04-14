<?php

namespace Tests\Feature;

use App\Models\Banner;
use App\Models\Feature;
use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BannerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withHeader('token', config('app.admin_token'));
    }

    /**
     * Test creating a valid banner.
     *
     * @return void
     */
    public function test_can_create_banner()
    {
        $feature = Feature::factory()->create();
        $tags = Tag::factory(2)->create();

        $data = [
            'tag_ids' => $tags->pluck('id')->toArray(),
            'feature_id' => $feature->id,
            'content' => json_encode(['message' => 'This is a test banner']),
            'is_active' => true,
        ];

        $response = $this->postJson('/api/banner', $data);

        $response
            ->assertCreated()
            ->assertJsonStructure(['banner_id']);

        $this->assertDatabaseHas('banners', [
            'id' => $response->original->id,
            'feature_id' => $data['feature_id'],
        ]);
    }

    /**
     * Test validation errors for required fields.
     *
     * @param  string  $missingField  Field to be omitted from the request data
     *
     * @dataProvider missingFieldProvider
     *
     * @return void
     */
    public function test_validation_errors_for_missing_fields(string $missingField)
    {
        $feature = Feature::factory()->create();
        $tags = Tag::factory(2)->create();

        $data = [
            'tag_ids' => $tags->pluck('id')->toArray(),
            'feature_id' => $feature->id,
            'content' => json_encode(['message' => 'This is a test banner']),
            'is_active' => true,
        ];

        unset($data[$missingField]);

        $response = $this->postJson('/api/banner', $data);

        $response->assertBadRequest();
    }

    public static function missingFieldProvider(): array
    {
        return [
            ['tag_ids'],
            ['feature_id'],
            ['content'],
            ['is_active'],
        ];
    }

    /**
     * Test validation error for invalid tag IDs.
     *
     * @return void
     */
    public function test_validation_error_for_invalid_tag_ids()
    {
        $nonExistentTagId = Tag::max('id') + 1;

        $feature = Feature::factory()->create();
        $data = [
            'tag_ids' => [$nonExistentTagId],
            'feature_id' => $feature->id,
            'content' => json_encode(['message' => 'This is a test banner']),
            'is_active' => true,
        ];

        $response = $this->postJson('/api/banner', $data);

        $response->assertBadRequest();
    }

    /**
     * Test validation error for invalid feature ID.
     *
     * @return void
     */
    public function test_validation_error_for_invalid_feature_id()
    {
        $tags = Tag::factory(2)->create();
        $nonExistentFeatureId = Feature::max('id') + 1;

        $data = [
            'tag_ids' => $tags->pluck('id')->toArray(),
            'feature_id' => $nonExistentFeatureId,
            'content' => json_encode(['message' => 'This is a test banner']),
            'is_active' => true,
        ];

        $response = $this->postJson('/api/banner', $data);

        $response->assertBadRequest();
    }

    public function test_get_banner_with_all_parameters()
    {
        $feature = Feature::factory()->create();
        $tag = Tag::factory()->create();
        $banner = Banner::factory()->create([
            'feature_id' => $feature->id,
            'is_active' => true,
        ]);
        $banner->tags()->attach($tag->id);

        $data = [
            'tag_id' => $tag->id,
            'feature_id' => $feature->id,
            'use_last_revision' => true,
        ];

        $response = $this->json('GET', '/api/user_banner', $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'content',
        ]);

        $response->assertJsonPath('content', json_decode($banner->content));
    }

    public function test_get_banner_with_nonexistent_id()
    {
        $tag = Tag::factory()->create();

        $feature = Feature::factory()->create();

        $data = [
            'tag_id' => $tag->id,
            'feature_id' => $feature->id,
        ];

        $response = $this->json('GET', '/api/user_banner', $data);

        $response->assertNotFound();
    }

    public function test_access_denied_for_inactive_banner_with_token()
    {
        $feature = Feature::factory()->create();
        $tag = Tag::factory()->create();
        $banner = Banner::factory()->create([
            'feature_id' => $feature->id,
            'is_active' => false,
        ]);
        $banner->tags()->attach($tag->id);

        $data = [
            'tag_id' => $tag->id,
            'feature_id' => $feature->id,
        ];
        $this->withHeader('token', config('app.user_token'));

        $response = $this->json('GET', '/api/user_banner', $data);

        $response->assertForbidden();
    }

    public function test_get_banner_using_cached_data()
    {
        $feature = Feature::factory()->create();
        $tag = Tag::factory()->create();
        $banner = Banner::factory()->create([
            'feature_id' => $feature->id,
            'is_active' => true,
        ]);
        $banner->tags()->attach($tag->id);

        $data = [
            'tag_id' => $tag->id,
            'feature_id' => $feature->id,
            'use_last_revision' => false,
        ];

        $response1 = $this->json('GET', '/api/user_banner', $data); // Fetches and caches data
        $response1->assertOk();

        $response2 = $this->json('GET', '/api/user_banner', $data); // Uses cached data
        $response2->assertOk();

        $this->assertEquals($response1->json(), $response2->json()); // Assert responses are identical
    }

    public function test_get_last_revision_banner()
    {
        $feature = Feature::factory()->create();
        $tag = Tag::factory()->create();
        $banner = Banner::factory()->create([
            'feature_id' => $feature->id,
            'content' => json_encode(['message' => 'Test content']),
            'is_active' => true,
        ]);
        $banner->tags()->attach($tag->id);

        $data = [
            'tag_id' => $tag->id,
            'feature_id' => $feature->id,
            'use_last_revision' => false,
        ];

        $response1 = $this->json('GET', '/api/user_banner', $data); // Fetches and caches data
        $response1->assertOk();

        $banner->update(['content' => json_encode(['message' => 'This is a test banner'])]);

        $data['use_last_revision'] = true;
        $response2 = $this->json('GET', '/api/user_banner', $data); // Uses non cached data
        $response2->assertOk();

        $this->assertNotEquals($response1->json(), $response2->json()); // Assert responses are not identical
    }
}
