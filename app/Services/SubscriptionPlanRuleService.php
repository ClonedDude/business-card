<?php

namespace App\Services;

use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Validator;
use App\Models\SubscriptionPlanRule;

class SubscriptionPlanRuleService {
    public function createSubscriptionPlanRule(int $id, array $data)
    {
        $validated = Validator::make($data, [
            "rules.*.subscription_rule_id" => ["required", "exists:subscription_rules,id"],
            "rules.*.subscription_plan_id" => ["required", "exists:subscription_plans,id"],
            "rules.*.value" => ["required"],
        ])->validate();

        foreach ($validated["rules"] as $rule) {
            $subscription_plan_rule = SubscriptionPlanRule::create(
                array_merge(
                    $rule,
                    ["subscription_plan_id" => $id]
                )
            );
        }

        return $subscription_plan_rule;
    }

    public function updateSubscriptionPlanRule(int $id, array $data)
    {
        $validated = Validator::make($data, [
            "rules.*.id" => ["sometimes", "exists:id,subscription_plan_rules"],
            "rules.*.subscription_rule_id" => ["required", "exists:id,subscription_rules"],
            "rules.*.value" => ["required"],
        ])->validate();

        $updated_subscription_plan_rule_id = [];

        foreach ($validated["rules"] as $rule) {
            $subscription_plan_rule = SubscriptionPlanRule::find($id);

            if ($subscription_plan_rule) {
                $subscription_plan_rule->update($rule);

                array_push($updated_subscription_plan_rule_id, $rule["subscription_plan_rule_id"]);
            } else {
                $subscription_plan_rule = SubscriptionPlanRule::create(
                    array_merge(
                        $rule,
                        ["subscription_plan_id" => $id]
                    )
                );
            }
        }

        SubscriptionPlanRule::where("subscription_plan_id", $id)
            ->whereNotIn("id", $updated_subscription_plan_rule_id)
            ->delete();

        return $subscription_plan_rule;
    }

    public function deleteSubscriptionPlanRule(int $id)
    {
        $subscription_plan_rule = SubscriptionPlanRule::find($id);

        return $subscription_plan_rule->delete();
    }
}