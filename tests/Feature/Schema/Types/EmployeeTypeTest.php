<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Customer;
use App\Models\Employee;
use Tests\TestCase;

class EmployeeTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_employee_type()
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

    /**
     * @test
     */
    public function graphql_endpoint_returns_relationships_of_employee_type()
    {
        $model = factory(Employee::class)->create();
        // create customers and associate them with employee
        $customer1 = factory(Customer::class)->create();
        $customer2 = factory(Customer::class)->create();
        $model->customers()->saveMany([$customer1, $customer2]);

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    employee (id: {$model->getKey()}) {
                        customers {
                            customerNumber
                            customerName
                            contactLastName
                            contactFirstName
                            phone
                            addressLine1
                            addressLine2
                            city
                            state
                            postalCode
                            country
                            salesRepEmployeeNumber
                            creditLimit
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.employee.customers', [$customer1->toArray(), $customer2->toArray()]);
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_list_of_employee_type()
    {
        $model = factory(Employee::class)->create();

        $json = $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    employees {
                        edges {
                            node {
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
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.employees.edges.0.node', $model->toArray());
    }
}
