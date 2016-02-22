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
use AppBundle\Utils\Reporter;
use AppBundle\Utils\Target;
use AppBundle\Utils\Pentester;

class SqlErrorController extends Controller
{

    /**
     * Stores all reports made by Pentesters
     * @var  Reporter\Report[]
     */
    private $_log;

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * Receive a request OK
     * Creates a Target OK
     * Calls Ryan Gosling with Target OK
     * Sends a Response OK
     *
     * @Route("/sql-error")
     */
    public function doSqlError(Request $request)
    {
        //création de la target
        $target = new Target\SqlTarget();
        $target->setUrl($request->get('url'));
        $target->setParameters($request->query->all());

        /**
         * SQL pentesting service
         * todo put in priv var ?
         * @var $sqlPentester Pentester\SqlPentester
         */
        //création du goslinger
        $goslingPentester = $this->get('app.pentester.sql');

        //appel du goslinger et sauvegarde des logs
        $this->_log[] = $goslingPentester->testAndGetReport($target);

        //renvoyer une réponse
        return $this->render('@App/dump.html.twig', array(
            'report' => $this->_log
        ));
    }
}

