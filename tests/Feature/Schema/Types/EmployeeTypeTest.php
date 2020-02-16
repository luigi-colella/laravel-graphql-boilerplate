<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Employee;
use Tests\TestCase;

class EmployeeTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_employee_type_correctly()
    {
        $model = factory(Employee::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    employee (id: {$model->getKey()}) {
                        employeeNumber
                        lastName
                        firstName
                        extension
                        email
                        officeCode
                        reportsTo
                        jobTitle
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.employee', $model->toArray());
    }
}
