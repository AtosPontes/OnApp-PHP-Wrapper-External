<?php
/**
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing CDN Report Top Fifty Http Error Code
 *
 * The OnApp_CDNReport_TopFifty_HttpErrorCode class uses the following basic methods:
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNReport_TopFifty_HttpErrorCode extends OnApp {
    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */

    public function initFields($version = null, $className = '') {
        switch ($version) {
            case 5.4:
                $this->fields = array(
                    'resourceId' => array(
                        ONAPP_FIELD_MAP => '_resourceId',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'errorRequest' => array(
                        ONAPP_FIELD_MAP => '_errorRequest',
                        ONAPP_FIELD_TYPE => 'integer',
                    )
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
        }
        parent::initFields($version, __CLASS__);

        return $this->fields;
    }
}