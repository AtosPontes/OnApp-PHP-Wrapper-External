<?PHP
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM Firewall Rule
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define( 'ONAPP_GETRESOURCE_MOVE', 'move' );
define( 'ONAPP_GETRESOURCE_UPDATE', 'update_firewall_rules' );
define( 'ONAPP_GETRESOURCE_UPDATE_DEFAULTS', 'update_defaults' );

/**
 * VM Firewall Rule
 *
 * The OnApp_VirtualMachine_FirewallRule class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer $id
 * @property string  $address
 * @property string  $position
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $command
 * @property integer $port
 * @property string  $protocol
 * @property integer $network_interface_id
 */
class OnApp_VirtualMachine_FirewallRule extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'firewall_rule';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'firewall_rules';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name virtual_machine_firewall_rules
				 * @method GET
				 * @alias     /virtual_machines/:virtual_machine_id/firewall_rules(.:format)
				 * @format    {:controller=>"firewall_rules", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name virtual_machine_firewall_rule
				 * @method GET
				 * @alias     /virtual_machines/:virtual_machine_id/firewall_rules/:id(.:format)
				 * @format    {:controller=>"firewall_rules", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias     /virtual_machines/:virtual_machine_id/firewall_rules(.:format)
				 * @format    {:controller=>"firewall_rules", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias  /virtual_machines/:virtual_machine_id/firewall_rules/:id(.:format)
				 * @format {:controller=>"firewall_rules", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias     /virtual_machines/:virtual_machine_id/firewall_rules/:id(.:format)
				 * @format    {:controller=>"firewall_rules", :action=>"destroy"}
				 */
				$resource = 'virtual_machines/' . $this->virtual_machine_id . '/' . $this->URLPath;
				break;

			case ONAPP_GETRESOURCE_MOVE:
				/**
				 * ROUTE :
				 *
				 * @name move_virtual_machine_firewall_rule
				 * @method GET
				 * @alias     /virtual_machines/:virtual_machine_id/firewall_rules/:id/move(.:format)
				 * @format    {:controller=>"firewall_rules", :action=>"move"}
				 */
				$resource = $this->getURL( ONAPP_GETRESOURCE_DEFAULT ) . '/' . $this->id . '/move';
				break;

			case ONAPP_GETRESOURCE_UPDATE:
				/**
				 * ROUTE :
				 *
				 * @name update_firewall_rules_virtual_machine
				 * @method POST
				 * @alias     /virtual_machines/:id/update_firewall_rules(.:format)
				 * @format    {:controller=>"virtual_machines", :action=>"update_firewall_rules"}
				 */
				$resource = 'virtual_machines/' . $this->virtual_machine_id . '/update_firewall_rules';
				break;

			case ONAPP_GETRESOURCE_UPDATE_DEFAULTS:
				/**
				 * ROUTE :
				 *
				 * @name update_firewall_rules_virtual_machine
				 * @method POST
				 * @alias   /virtual_machines/:id/update_firewall_rules(.:format)
				 * @format  {:controller=>"virtual_machines", :action=>"update_firewall_rules"}
				 */
				$resource = '/virtual_machines/' . $this->virtual_machine_id . '/firewall_rules/update_defaults';
				break;

			default:
				$resource = parent::getURL( $action );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $virtual_machine_id VM id
	 * @param mixed   $url_args           additional parameters
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	public function getList( $virtual_machine_id = null, $url_args = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->virtual_machine_id ) ) {
			$virtual_machine_id = $this->virtual_machine_id;
		}

		if( ! is_null( $virtual_machine_id ) ) {
			$this->virtual_machine_id = $virtual_machine_id;

			return parent::getList( $virtual_machine_id, $url_args );
		}
		else {
			$this->logger->logError(
				'getList: property virtual_machine_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * Sends an API request to get the Object after sending,
	 * unserializes the response into an object
	 *
	 * The key field Parameter ID is used to load the Object. You can re-set
	 * this parameter in the class inheriting OnApp class.
	 *
	 * @param integer $id                 Firewall Rule id
	 * @param integer $virtual_machine_id Virtual Machine id
	 *
	 * @return mixed serialized Object instance from API
	 */
	public function load( $id = null, $virtual_machine_id = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->virtual_machine_id ) ) {
			$virtual_machine_id = $this->virtual_machine_id;
		}

		if( is_null( $virtual_machine_id ) &&
			isset( $this->loadedObject ) &&
			! is_null( $this->loadedObject->virtual_machine_id )
		) {
			$virtual_machine_id = $this->loadedObject->virtual_machine_id;
		}

		if( is_null( $id ) && ! is_null( $this->id ) ) {
			$id = $this->id;
		}

		if( is_null( $id ) &&
			isset( $this->loadedObject ) &&
			! is_null( $this->loadedObject->id )
		) {
			$id = $this->loadedObject->id;
		}

		$this->logger->logMessage( 'load: Load class ( id => ' . $id . ' ).' );

		if( ! is_null( $id ) && ! is_null( $virtual_machine_id ) ) {
			$this->id                 = $id;
			$this->virtual_machine_id = $virtual_machine_id;

			$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LOAD ) );
			$result                = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
			$this->loadedObject = $result;

			return $result;
		}
		else {
			if( is_null( $id ) ) {
				$this->logger->logError(
					'load: property id not set.',
					__FILE__,
					__LINE__
				);
			}
			else {
				$this->logger->logError(
					'load: property virtual_machine_id not set.',
					__FILE__,
					__LINE__
				);
			}
		}
	}

	/**
	 * Moves Firewall Rule to the upper or lower position
	 *
	 * @param string $position [down|up] direction to move
	 *
	 * @return void
	 */
	public function move( $position ) {
		if( ! $position ) {
			$this->logger->logError(
				'_GETAction: Firewall rule move position have to be specified', __FILE__, __LINE__
			);
		}
		else {
			$data = array(
				'root' => 'tmp_holder',
				'data' => array(
					'position' => $position
				)
			);

			$this->sendGet( ONAPP_GETRESOURCE_MOVE, $data );
		}
	}

	/**
	 * Applies all custom Firewall Rules for particular VM
	 *
	 * @param integer $virtual_machine_id VM Id
	 */
	public function update( $virtual_machine_id = null ) {
		if( $virtual_machine_id ) {
			$this->virtual_machine_id = $virtual_machine_id;
		}

		$this->sendPost( ONAPP_GETRESOURCE_UPDATE );
	}

	/**
	 * Updates default firewall rules for all network interfaces for particular virtual machine
	 *
	 * @param integer $virtual_machine_id VM id
	 * @param array   $networkInterfaces  =  array( {$NETWORK_INTERFACE_ID} => {COMMAND} );
	 *
	 * @return void
	 */
	public function updateDefaults( $virtual_machine_id, $networkInterfaces ) {
		if( $virtual_machine_id ) {
			$this->virtual_machine_id = $virtual_machine_id;
		}

		foreach( $networkInterfaces as $interface_id => $command ) {
			$network_interfaces[ $interface_id ][ 'default_firewall_rule' ] = $command;
		}
		$data = array(
			'root' => 'network_interfaces',
			'data' => $network_interfaces
		);
		$this->sendPut( ONAPP_GETRESOURCE_UPDATE_DEFAULTS, $data );
	}
}