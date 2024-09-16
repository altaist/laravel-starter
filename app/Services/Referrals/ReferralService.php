<?php

namespace App\Services\Referrals;

use App\Models\Referrals\Offer;
use App\Models\Referrals\OfferUser;
use App\Models\Referrals\Referral;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReferralService extends BaseService
{
    use RefreshDatabase;

    public function attachReferral(User $user, string $refKey)
    {
        $parentUser = $this->getUserByRefKey($refKey);
        if(!$parentUser) {
            return null;
        }

        $parentUser2 = $this->getParentReferralUserForUser($parentUser);
        $parentUser3 = $this->getParentReferralUserForUser($parentUser2);

        $parentUserId2 = $parentUser2->id ?? null;
        $parentUserId3 = $parentUser3->id ?? null;

        $referral = $this->getReferralRecordForUser($user);
        if(!$referral) {
            $referral = new Referral();
        } elseif ($referral->parent1_id != $parentUser->id ) {
            // У нас замена
            $referral->delete();
            $referral = new Referral();
        }

        $referral->user_id = $user->id;
        $referral->parent1_id = $parentUser->id;
        $referral->parent2_id = $parentUserId2;
        $referral->parent3_id = $parentUserId3;

        $referral->save();
        return $referral;
    }

    public function getUserByRefKey(string $refKey)
    {
        return User::byRefKey($refKey)->first();
    }

    public function getParentReferralUserForUser(?User $user)
    {
        if(!$user) {
            return null;
        }
        $refRecord = $this->getReferralRecordForUser($user);
        return $refRecord->parentUser ?? null;
    }

    public function getReferralRecordForUser(?User $user)
    {
        return Referral::byUserId($user->id ?? null)->first();
    }



    /* */
    private function getReferralRecordByParentLevel(int $userId, int $parentUserId, int $level = 1)
    {
        return Referral::query()
            ->where('user_id', $userId)
            ->where('parent' . $level . '_id', $parentUserId)
            ->first();
    }

    private function getReferralRecordByUserAndOffer(User $user, Offer $offer)
    {
        return Referral::where('user_id', $user->id)->where('offer_id', $offer->id)->firstOrFail();
    }

    private function getReferralRecordByOfferKey(string $refKey)
    {
        $offerUser = OfferUser::byKey($refKey)->first();
        $offer = $offerUser->offer;
        $user = $offerUser->user;

        return $this->getReferralRecordByUserAndOffer($user, $offer);
    }


}
