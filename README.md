zerowing
========

    All your servers are belong to us
    
    
TODO LIST (ordered by priority) :

- [ ] Add FOS User Bundle
- [ ] FOS UB Security filter
- [x] Provoke several SQL Errors
- [x] Detect several SQL Errors
- [x] Provoke 1 XSS
- [x] Detect 1 XSS
- [ ] PHPCS 101
- [ ] Retrieve SQL data
- [ ] MOAR ?

TEAM :

- CARON Morgan – Lead Developper
- POLIN Ronan  – Developper
- LAWSON Clarisse – Developper
- TARRIERE Milena - intern
- LE SAOUT Morgane – intern 
- CABROL Margaux – intern

## Description

*Zerowing* is a pentesting API. Register, prove you are the owner of the given domain name, 
  and test your routes and pages on different attacks
  
## API Documentation

To be done.

## Contribute

### GIT

- No push on master
- Only ask pull requests for tested code


### Document your code

The coding style follows PSR-1 and PSR-2. Thus all files pushed to master should perfectly pass 
PHP CodeSniffer tests.

Here are some templates for you to follow, strings between "%%" are for you to name.


#### Template de début de fichier (pour chaque fichier)
 
    /**
     * File %myfile.extension%
     *
     * PHP Version 5.6
     *
     * @category  %Controller | Interface | ...%
     * @package   %namespace%
     * @author    %name% <%youremail@exaple.com%>
     * @copyright %year% %name%
     * @license   MIT http://choosealicense.com/licenses/mit/
     * @link      http://zerowing.lorem.ovh
     */

#### Template de classe

 
    /**
     * %Description%
     * Class      %classname%
     * @category  %Class | Abstract | Interface%
     * @package   %namespace%
     * @author    %name% <%youremail@exaple.com%>
     * @copyright %year% %name%
     * @license   MIT http://choosealicense.com/licenses/mit/
     * @link      http://zerowing.lorem.ovh
     */
    
#### Template de méthode

    /**
    * %Description%
    * @var %Type Hint% $%name% //%var description%
    * @param %Type Hint% $%name% //%param description%
    * @return %Type Hint%
    */
    
####  Template de variable

    /**
     * %Description%
     * @var %Type Hint%
     */
     
 