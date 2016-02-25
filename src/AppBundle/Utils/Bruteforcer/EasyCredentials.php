<?php
/**
 * File EasyCredentials.php
 *
 * PHP Version 5.6
 *
 * @category  Class
 * @package   zerowing
 * @author    mrgn <xyz@example.com>
 * @copyright 2016 mrgn
 * @license   MIT http://choosealicense.com/licenses/mit/
 * @link      http://lorem.ovh
 */
namespace AppBundle\Utils\Bruteforcer;

class EasyCredentials
{

    private $CREDENTIALS_PATH = __DIR__."/credentials/";

    private $password_files = array(
        "500worst" => "500-worst-passwords.txt",
    );

    private $username_files = array(
        "default" => "credentials/default-users.txt",
    );


    public function get100Passwords($page = 0, $shortname = "500worst")
    {

        $filename = $this->password_files[$shortname];
        $filepath = $this->CREDENTIALS_PATH.$filename;

        return $this->get($page, 100, $filepath);
    }

    private function get($page = 0, $maxitems = 100, $filepath)
    {

        $offset = $page * 100;
        $limit = $offset + $maxitems;

        $buffer = array();

        $handle = @fopen($filepath, "r");
        if ($handle) {
            fseek($handle, $offset);

            while (($line = fgets($handle, 4096)) !== false && $offset < $limit) {
                $buffer[] = $line;
                $offset++;
            }
            if (!feof($handle)) {
            }
            fclose($handle);
        }


        return $buffer;
    }

    public function get100Usernames($page = 0, $shortname = "default")
    {
        $filename = $this->username_files[$shortname];
        $filepath = $this->CREDENTIALS_PATH.$filename;

        return $this->get($page, 100, $filepath);
    }
}