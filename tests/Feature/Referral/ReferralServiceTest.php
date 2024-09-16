<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Referrals\Referral;
use App\Models\User;
use App\Services\Referrals\ReferralService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReferralServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_user_by_refkey(): void
    {
        $service = ReferralService::make();
        $user = User::factory()->create(['ref_key' => 'user_refkey']);

        $refUser = $service->getUserByRefKey('user_refkey');
        $this->assertNotNull($refUser);

        $refUser = $service->getUserByRefKey('aaa');
        $this->assertNull($refUser);

        $refRecord = $service->getReferralRecordForUser($user);
        $this->assertNull($refRecord);
    }

    public function test_attach_referral_by_key(): void
    {
        $service = ReferralService::make();
        $user = User::factory()->create(['ref_key' => 'user_refkey']);
        $userParent1 = User::factory()->create(['ref_key' => 'refkey1']);

        $refRecord = $service->attachReferral($user, '');
        $this->assertNull($refRecord);
        $refRecord = $service->attachReferral($user, 'aaa');
        $this->assertNull($refRecord);

        $refRecord = $service->attachReferral($user, 'refkey1');
        $this->assertNotNull($refRecord);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);

        $refRecord2 = $service->attachReferral($user, 'refkey1');
        $this->assertNotNull($refRecord2);
        $this->assertEquals($refRecord2->id, $refRecord->id);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);

        $refRecord = $service->getReferralRecordForUser($user);
        $this->assertEquals($refRecord2->id, $refRecord->id);

    }

    public function test_get_user_from_referral_record(): void
    {
        $service = ReferralService::make();
        $user = User::factory()->create(['ref_key' => 'user_refkey']);
        $userParent1 = User::factory()->create(['ref_key' => 'refkey1']);

        $refRecord = $service->attachReferral($user, 'refkey1');
        $this->assertNotNull($refRecord);

        $refRecord = $service->getReferralRecordForUser($user);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertEquals($refRecord->parent1_id, $refRecord->parentUser->id);
        $this->assertEquals($refRecord->parentUser->id, $userParent1->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);

        $userFromRecord = $service->getParentReferralUserForUser($user);
        $this->assertNotNull($refRecord->parentUser);
        $this->assertEquals($refRecord->parentUser->id, $userFromRecord->id);
        $this->assertEquals($userFromRecord->id, $userParent1->id);

    }

    public function test_attach_multiple_referrals(): void
    {
        $service = ReferralService::make();
        $user = User::factory()->create(['ref_key' => 'user_refkey1']);

        $userParent1 = User::factory()->create(['ref_key' => 'refkey1']);
        $userParent2 = User::factory()->create(['ref_key' => 'refkey2']);
        $userParent3 = User::factory()->create(['ref_key' => 'refkey3']);

        $this->assertEquals(0, Referral::get()->count());

        $refRecord = $service->attachReferral($user, 'wrongkey');
        $this->assertNull($refRecord);

        $refRecord = $service->attachReferral($user, 'refkey1');

        $this->assertNotNull($refRecord);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);

        $refRecord = $service->attachReferral($user, 'refkey2');
        $this->assertNotNull($refRecord);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent2->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);

        $refRecord2 = $service->getReferralRecordForUser($user);
        $this->assertEquals($refRecord2->id, $refRecord->id);
        $this->assertEquals($refRecord2->user_id, $user->id);
        $this->assertEquals($refRecord2->parent1_id, $userParent2->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);


        $refRecord = $service->attachReferral($user, 'refkey3');
        $this->assertNotNull($refRecord);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent3->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);

        $refRecord = $service->attachReferral($user, 'refkey1');
        $this->assertNotNull($refRecord);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);

        $this->assertEquals(1, Referral::count());
        $this->assertEquals(4, Referral::withTrashed()->count());

        // Second user
        $user2 = User::factory()->create(['ref_key' => 'user_refkey2']);
        $refRecord = $service->attachReferral($user2, 'refkey1');
        $this->assertNotNull($refRecord);
        $this->assertEquals($refRecord->user_id, $user2->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);

        $refRecord = $service->attachReferral($user2, 'refkey2');
        $this->assertEquals($refRecord->user_id, $user2->id);
        $this->assertEquals($refRecord->parent1_id, $userParent2->id);

        $this->assertEquals(2, Referral::count());
        $this->assertEquals(6, Referral::withTrashed()->count());

        // dd(Referral::count(), Referral::withTrashed()->count());
    }

    public function test_multilevel_referrals_no_change(): void
    {
        $service = ReferralService::make();
        $user = User::factory()->create(['ref_key' => 'user_refkey1']);

        $userParent1 = User::factory()->create(['ref_key' => 'refkey1']);
        $userParent2 = User::factory()->create(['ref_key' => 'refkey2']);
        $userParent3 = User::factory()->create(['ref_key' => 'refkey3']);

        $this->assertEquals(0, Referral::get()->count());

        $refRecord = $service->attachReferral($user, 'refkey1');
        $refRecord = $service->attachReferral($userParent1, 'refkey2');
        $this->assertNotNull($refRecord);
        $this->assertEquals($refRecord->user_id, $userParent1->id);
        $this->assertEquals($refRecord->parent1_id, $userParent2->id);
        $this->assertNull($refRecord->parent2_id);
        $this->assertNull($refRecord->parent3_id);

        $refRecordUser = $service->getReferralRecordForUser($user);
        $refRecordParent1 = $service->getReferralRecordForUser($userParent1);
        $this->assertNotNull($refRecordUser);
        $this->assertNotNull($refRecordParent1);
        $this->assertNotEquals($refRecordParent1->id, $refRecordUser->id);

        // Check nothing change for user1
        $this->assertEquals($refRecordUser->parent1_id, $userParent1->id);
        $this->assertNull($refRecordUser->parent2_id);
        $this->assertNull($refRecordUser->parent3_id);

    }

    public function test_multilevel_referrals_no_changes(): void
    {
        $service = ReferralService::make();
        $user = User::factory()->create(['ref_key' => 'user_refkey1']);

        $userParent1 = User::factory()->create(['ref_key' => 'refkey1']);
        $userParent2 = User::factory()->create(['ref_key' => 'refkey2']);
        $userParent3 = User::factory()->create(['ref_key' => 'refkey3']);

        $this->assertEquals(0, Referral::get()->count());

        $refRecord = $service->attachReferral($userParent1, 'refkey2');

        $refRecord = $service->attachReferral($user, 'refkey1');
        $this->assertNotNull($refRecord);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertEquals($refRecord->parent2_id, $userParent2->id);
        $this->assertNull($refRecord->parent3_id);

        $refRecord = $service->attachReferral($userParent2, 'refkey3');

        $refRecord = $service->getReferralRecordForUser($user);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertEquals($refRecord->parent2_id, $userParent2->id);
        $this->assertNull($refRecord->parent3_id);


    }

    public function test_multilevel_referrals(): void
    {
        $service = ReferralService::make();
        $user = User::factory()->create(['ref_key' => 'user_refkey1']);

        $userParent1 = User::factory()->create(['ref_key' => 'refkey1']);
        $userParent2 = User::factory()->create(['ref_key' => 'refkey2']);
        $userParent3 = User::factory()->create(['ref_key' => 'refkey3']);

        $this->assertEquals(0, Referral::get()->count());

        $refRecord = $service->attachReferral($userParent2, 'refkey3');
        $refRecord = $service->attachReferral($userParent1, 'refkey2');

        $refRecord = $service->attachReferral($user, 'refkey1');
        $this->assertNotNull($refRecord);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertEquals($refRecord->parent2_id, $userParent2->id);
        $this->assertEquals($refRecord->parent3_id, $userParent3->id);

        // Check parent levels

        $userParent1->refresh();
        $userParent2->refresh();
        $userParent3->refresh();

        $refRecord = $service->getReferralRecordForUser($user);
        $this->assertEquals($refRecord->user_id, $user->id);
        $this->assertEquals($refRecord->parent1_id, $userParent1->id);
        $this->assertEquals($refRecord->parent2_id, $userParent2->id);
        $this->assertEquals($refRecord->parent3_id, $userParent3->id);

        $refRecord = $service->getReferralRecordForUser($userParent1);
        $this->assertEquals($refRecord->user_id, $userParent1->id);
        $this->assertEquals($refRecord->parent1_id, $userParent2->id);
        $this->assertEquals($refRecord->parent2_id, $userParent3->id);
        $this->assertEquals($refRecord->parent3_id, null);

        $refRecord = $service->getReferralRecordForUser($userParent2);
        $this->assertEquals($refRecord->user_id, $userParent2->id);
        $this->assertEquals($refRecord->parent1_id, $userParent3->id);
        $this->assertEquals($refRecord->parent2_id, null);
        $this->assertEquals($refRecord->parent3_id, null);

        $refRecord = $service->getReferralRecordForUser($userParent3);
        $this->assertNull($refRecord);

        //

        $refParentUser = $service->getParentReferralUserForUser($user);
        $this->assertEquals($refParentUser->id, $userParent1->id);

        $refParentUser = $service->getParentReferralUserForUser($userParent1);
        $this->assertEquals($refParentUser->id, $userParent2->id);

        $refParentUser = $service->getParentReferralUserForUser($userParent2);
        $this->assertEquals($refParentUser->id, $userParent3->id);

        $refParentUser = $service->getParentReferralUserForUser($userParent3);
        $this->assertNull($refParentUser);

        $userParent1->refresh();
        $userParent2->refresh();
        $userParent3->refresh();
        $this->assertCount(1, $userParent1->referrals);
        $this->assertCount(1, $userParent2->referrals);
        $this->assertCount(1, $userParent3->referrals);

        $this->assertCount(0, $userParent1->referralsLevel2);
        $this->assertCount(1, $userParent2->referralsLevel2);
        $this->assertCount(1, $userParent3->referralsLevel2);

        $user2 = User::factory()->create(['ref_key' => 'user_refkey2']);
        $user3 = User::factory()->create(['ref_key' => 'user_refkey3']);

        $service->attachReferral($user2, 'refkey1');
        $service->attachReferral($user3, 'refkey2');
        $refParentUser = $service->getParentReferralUserForUser($user2);
        $this->assertEquals($refParentUser->id, $userParent1->id);

        $userParent1->refresh();
        $userParent2->refresh();
        $userParent3->refresh();
        $this->assertCount(2, $userParent1->referrals);
        $this->assertCount(2, $userParent2->referrals);
        $this->assertCount(1, $userParent3->referrals);

        $this->assertCount(0, $userParent1->referralsLevel2);
        $this->assertCount(2, $userParent2->referralsLevel2);
        $this->assertCount(2, $userParent3->referralsLevel2);

    }
}
