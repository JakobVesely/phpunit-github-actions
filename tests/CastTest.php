<?php

    use PHPUnit\Framework\TestCase;
    use Fyi\Jakob\Cast;

	final class CastTest extends TestCase
	{	
        public function test_shouldBe_sameString_when_string ()
        {
            $this->assertEquals(
                "Test",
                Cast::emptyStringIfNull("Test")
            );
        }

        public function test_shouldBe_emptyString_when_null ()
        {
            $this->assertEquals(
                "",
                Cast::emptyStringIfNull(null)
            );
        }

        public function test_shouldBe_true_when_int1 ()
        {
            $this->assertEquals(
                true,
                Cast::boolVal(1)
            );
        }

        public function test_shouldBe_false_when_int0 ()
        {
            $this->assertEquals(
                false,
                Cast::boolVal(0)
            );
        }

        public function test_shouldBe_true_when_stringTrue ()
        {
            $this->assertEquals(
                true,
                Cast::boolVal("true")
            );
        }

        public function test_shouldBe_false_when_stringFalse ()
        {
            $this->assertEquals(
                false,
                Cast::boolVal("false")
                
            );
        }

        public function test_shouldBe_formattedStringWithTwoDecimalsAndSymbol_when_floatValue ()
        {
            $this->assertEquals(
                "32.13%",
                Cast::percentval(32.12839)
            );
        }

        public function test_shouldBe_DMY_when_unixTime ()
        {
            $unixTime = 1595066025; // GMT: Saturday, 18. July 2020 09:53:45

            $this->assertEquals(
                "18.07.2020",
                Cast::formatDateDmy($unixTime)
            );
        }
	}