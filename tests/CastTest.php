<?php

    use PHPUnit\Framework\TestCase;
    use Fyi\Jakob\Cast;

	final class CastTest extends TestCase
	{	
		public static function setUpBeforeClass(): void
		{ }

        public function test_shouldBe_sameString_when_string ()
        {
            $this->assertEquals(
                Cast::emptyStringIfNull("Test"),
                "Test"
            );
        }

        public function test_shouldBe_emptyString_when_null ()
        {
            $this->assertEquals(
                Cast::emptyStringIfNull(null),
                ""
            );
        }
	}