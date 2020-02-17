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
    public function graphql_endpoint_returns_list_of_employee_type()
    {
        $model = factory(Employee::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
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

    /**
     * @test
     */
    public function graphql_endpoint_returns_customers_relationship_of_employee_type()
    {
        $model = factory(Employee::class)->create();
        $relatedModel1 = factory(Customer::class)->create();
        $relatedModel2 = factory(Customer::class)->create();
        $model->customers()->saveMany([$relatedModel1, $relatedModel2]);

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
            ->assertJsonPath('data.employee.customers', [$relatedModel1->toArray(), $relatedModel2->toArray()]);
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_manager_relationship_of_employee_type()
    {
        $model = factory(Employee::class)->create();
        $relatedModel = factory(Employee::class)->create();
        $model->reportsTo = $relatedModel->getKey();
        $model->save();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    employee (id: {$model->getKey()}) {
                        manager {
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
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.employee.manager', $relatedModel->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_office_relationship_of_employee_type()
    {
        $model = factory(Employee::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    employee (id: {$model->getKey()}) {
                        office {
                            officeCode
                            city
                            phone
                            addressLine1
                            addressLine2
                            state
                            country
                            postalCode
                            territory
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.employee.office', $model->office->toArray());
    }
}
