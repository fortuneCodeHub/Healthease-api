<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomerFilter extends ApiFilter
{
    protected $safeParams = [
        "id" => ['eq', 'gt', 'lt'],
        "userId" => ['eq', 'gt', 'lt'],
        "age" => ['eq', 'gt', 'gte', 'lt', 'lte'],
        "weight" => ['eq', 'gt', 'gte', 'lt', 'lte'],
        "height" => ['eq', 'gt', 'gte', 'lt', 'lte'],
        "allergies" => ['eq'],
        "healthIssues" => ['eq'],
        "genotype" => ['eq'],
        "bloodGroup" => ['eq'],
        "userLang" => ['eq'],
        "plan" => ['eq'],
        "planExp" => ['eq'],
    ];

    protected $columnMap = [
        "id" => "id",
        "userId" => "user_id",
        "age" => "age",
        "weight" => "weight",
        "height" => "height"
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<='
    ];

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParams as $params => $operators) {
            $query = $request->query($params);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$params] ?? $params;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}
