<?php
/**
 * Created by PhpStorm.
 * User: Milena
 * Date: 12/02/2016
 * Time: 11:14
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/sql-error", name="SQL")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }

    private function sqlTest()
    {

        $ch = curl_init("http://www.google.com/search"."?q=lol");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    $result2 = sqlTestGet();
    ?>
    <p><?php echo $result2 ?></p>

}

