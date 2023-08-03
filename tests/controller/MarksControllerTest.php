<?php
/**
 * This class is a part of the package controller and the package
 * is a part of the project expression.
 *
 * Integrated ICT Pvt. Ltd. Jwagal, Lalitpur, Nepal.
 * https://www.integratedict.com.np
 * https://www.semantro.com
 *
 * Created by Santa on 2023-07-28, 9:00 PM.
 */

namespace controller;

include_once('model\actions.php');
include_once('controller\marks_controller.php');

use model\Actions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class MarksControllerTest extends TestCase
{
    /**
     * Test of the valid rule given and the parsing status should pass.
     */
    /** @test */
    public function testCreateValid()
    {
        $controller = new MarksController($this->getValidRuleData(), Actions::CREATE);
        $rule = $controller->getRuleData()->create_rule();
        $actual_status = $rule[1];
        Assert::assertSame(true, $actual_status);
    }
    /**
     * Test of invalid rule given and the parsing status to be failed.
     */
    /** @test */
    public function testCreateInvalid()
    {
        $controller = new MarksController($this->getInvalidRuleData(), Actions::CREATE);
        $rule = $controller->getRuleData()->create_rule();
        $actual_status = $rule[1];
        Assert::assertSame(false, $actual_status);
    }

    /** @test */
    public function testVariables()
    {
        $controller = new MarksController($this->getvalidRuleData(), Actions::CREATE);
        $rule = $controller->getRuleData()->create_rule();
        $no_of_variables = 5;
        Assert::assertSame($no_of_variables, count($rule[0]) - 1);
    }

    /**
     * @test
     * Verify the rule updates.
     * Needs to work.
     */
    public function testRuleUpdates()
    {
        Assert::assertSame(true, true);
    }


    /**
     * @return string
     */
    private function getValidRuleData(): string
    {
        return '
                {
                "teacher_id": "aa97-ba8a",
                "subject_id": "4409-9989",
                "year": 2023,
                "department": "Computer",
                "section": "A",
                "semester": "fall",
                "category": "Theory",
                "rule": "attendance * 0.70 + ut * 1.20 + assignment * 1.20 + assessment * 1.20 * assessment * 0.5",
                "description": "weighted evaluation metric for the theory evaluation of web technology"
            }
        ';
    }

    private function getInvalidRuleData(): string
    {
        return '
                {
                "teacher_id": "aa97-ba8a",
                "subject_id": "4409-9989",
                "year": 2023,
                "department": "Computer",
                "section": "A",
                "semester": "fall",
                "category": "Theory",
                "rule": "attendance * 0.70 +*ut * 1.20 + assignment * 1.20 + assessment * 1.20 * assessment *",
                "description": "weighted evaluation metric for the theory evaluation of web technology"
            }
        ';
    }
}
