<?php
/**
 * File AppBundle.php
 *
 * PHP Version 5.6
 *
 * @category  Class
 * @package   Zerowing
 * @author    mrgn <xyz@example.com>
 * @copyright 2016 mrgn
 * @license   MIT http://choosealicense.com/licenses/mit/
 * @link      http://lorem.ovh
 */

namespace AppBundle;

use AppBundle\Utils\Security\WsseFactory;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AppBundle
 * @category  Class
 * @package   AppBundle
 * @author    mrgn <xyz@example.com>
 * @license   MIT http://choosealicense.com/licenses/mit/
 * @link      http://lorem.ovh
 */
class AppBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        //$extension = $container->getExtension('security');
        //$extension->addSecurityListenerFactory(new WsseFactory());
    }

    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
