<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class UserFilter extends ApiFilter
{
    protected $safeParams = [
        "id" => ['eq', 'gt', 'lt'],
        "firstname" => ['eq'],
        "other" => ['eq'],
        "username" => ['eq'],
        "email" => ['eq'],
        "type" => ['eq'],
        "address" => ['eq'],
        "number" => ['eq'],
        "language" => ['eq'],
        "emailVerifiedAt" => ['eq'],
    ];

    protected $columnMap = [
        "id" => "id"
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
