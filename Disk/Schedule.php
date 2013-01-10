<?php
/**
 * Scheduleds
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Disk
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 * Managing Disk Backups Schedules
 *
 * The OnApp_Disk_Schedule class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The OnApp_Disk_Schedule class represents Disk Backups Schedules.
 * The OnApp class is a parent of ONAPP_Disk_Schedule class.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
define( 'ONAPP_GETRESOURCE_LIST_BY_DISK_ID', 'get list by disk id' );

/**
 * Magic properties used for autocomplete
 *
 * @property integer $id
 * @property integer $duration
 * @property integer $target_id
 * @property string  $schedule_logs
 * @property string  $period
 * @property string  $updated_at
 * @property string  $action
 * @property string  $start_at
 * @property integer $user_id
 * @property integer $failure_count
 * @property string  $params
 * @property string  $status
 * @property string  $target_type
 * @property string  $created_at
 */
class OnApp_Disk_Schedule extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'schedule';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'schedules';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		$show_log_msg = true;
		switch( $action ) {
			case ONAPP_GETRESOURCE_LIST_BY_DISK_ID:
				$resource = 'settings/disks/' . $this->target_id . '/' . $this->URLPath;
				break;

			default:
				$resource     = parent::getURL( $action );
				$show_log_msg = false;
		}

		if( $show_log_msg ) {
			$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $disk_id Virtual Machine Disk id
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	public function getListByDiskId( $disk_id = null ) {
		if( $disk_id ) {
			$this->target_id = $disk_id;
		}

		$this->activate( ONAPP_ACTIVATE_GETLIST );

		$this->logger->logMessage( 'getList: Get Transaction list.' );

		$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LIST_BY_DISK_ID ) );
		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		$result = $this->doCastResponseToClass( $response );

		if( ! empty( $response[ 'errors' ] ) ) {
			return false;
		}

		return ( is_array( $result ) || ! $result ) ? $result : array( $result );
	}

	public function save() {
		if( $this->target_id ) {
			//todo check this code
			$this->fields[ 'target_id' ][ ONAPP_FIELD_REQUIRED ]        = true;
			$this->fields[ 'target_type' ][ ONAPP_FIELD_REQUIRED ]      = true;
			$this->fields[ 'target_type' ][ ONAPP_FIELD_DEFAULT_VALUE ] = 'Disk';
			$this->fields[ 'action' ][ ONAPP_FIELD_REQUIRED ]           = true;
			$this->fields[ 'action' ][ ONAPP_FIELD_DEFAULT_VALUE ]      = 'autobackup';
		}

		return parent::save();
	}
}