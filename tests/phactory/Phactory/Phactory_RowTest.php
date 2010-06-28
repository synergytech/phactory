<?php
require_once 'PHPUnit/Framework.php';

require_once PHACTORY_PATH . '/Phactory/Row.php';

/**
 * Test class for Phactory_Row.
 * Generated by PHPUnit on 2010-06-28 at 09:17:32.
 */
class Phactory_RowTest extends PHPUnit_Framework_TestCase
{
	protected $pdo;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
		$this->pdo = new PDO("sqlite:test.db");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("CREATE TABLE `user` ( name VARCHAR(256) )");

        Phactory::setConnection($this->pdo);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {        
		Phactory::reset();

        $this->pdo->exec("DROP TABLE `user`");
    }

    /**
     * @todo Implement testSave().
     */
    public function testSave()
    {
		$name = "testuser";
		
		//create Phactory_Row object and add user to table
		$phactory_row = new Phactory_Row('user', array('name' => $name));
		$phactory_row->save();
		
        // retrieve expected user from database
        $stmt = $this->pdo->query("SELECT * FROM `user`");
        $db_user = $stmt->fetch();

		// test retrieved db row
        $this->assertEquals($db_user['name'], $name);
    }
}
?>
