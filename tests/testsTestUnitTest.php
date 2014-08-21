<?php
/* 
* @Author: sxf
* @Date:   2014-08-19 16:15:57
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-19 16:18:32
*/

namespace Test;

/**
 * Class UnitTest
 */
class UnitTest extends \UnitTestCase {

    public function testTestCase() {

        $this->assertEquals('works',
            'works',
            'This is OK'
        );

        $this->assertEquals('works',
            'works1',
            'This wil fail'
        );
    }
}


?>
