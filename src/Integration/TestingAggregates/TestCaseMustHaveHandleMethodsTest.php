<?php

namespace EventSauce\Integration\TestingAggregates;

use EventSauce\EventSourcing\AggregateRootId;
use EventSauce\EventSourcing\AggregateRootTestCase;
use EventSauce\EventSourcing\Integration\TestingAggregates\DummyAggregate;
use EventSauce\EventSourcing\Integration\TestingAggregates\DummyCommand;
use EventSauce\EventSourcing\UuidAggregateRootId;
use LogicException;

class TestCaseMustHaveHandleMethodsTest extends AggregateRootTestCase
{
    protected function aggregateRootId(): AggregateRootId
    {
        return UuidAggregateRootId::create();
    }

    protected function aggregateRootClassName(): string
    {
        return DummyAggregate::class;
    }

    /**
     * @test
     */
    public function missing_handle_methods_result_in_logic_exception()
    {
        $this->expectException(LogicException::class);
        $this->when(new DummyCommand($this->aggregateRootId()));
        $this->assertScenario();
    }
}