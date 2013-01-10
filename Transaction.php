<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Transactions
 *
 * The system records in the database a detailed log of all the transactions
 * happening to your virtual machines. You can view the transactions output from
 * the Control Panel.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Transactions
 *
 * This class represents the Transactions of the OnApp installation.
 *
 * The OnApp_Transaction class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer     $id
 * @property string      $action
 * @property mixed       $actor
 * @property string      $created_at
 * @property integer     $dependent_transaction_id
 * @property string      $log_output
 * @property string      $params
 * @property integer     $parent_id
 * @property string      $parent_type
 * @property integer     $pid
 * @property integer     $priority
 * @property string      $status
 * @property string      $updated_at
 * @property integer     $user_id
 * @property boolean     $allowed_cancel
 * @property string      $identifier
 * @property string      $start_after
 * @property string      $started_at
 */
class OnApp_Transaction extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'transaction';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'transactions';

	public function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param int   $page
	 * @param mixed $url_args additional parameters
	 *
	 * @return the array of Object instances
	 */
	public function getList( $page = 1, $url_args = null ) {
		$data = array(
			'root' => 'page',
			'data' => $page,
		);

		return parent::getList( $data, $url_args );
	}

	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getURL( $action );
		/**
		 * ROUTE :
		 *
		 * @name transactions
		 * @method GET
		 * @alias   /settings/nameservers(.:format)
		 * @format  {:controller=>"transactions", :action=>"index"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name transaction
		 * @method GET
		 * @alias    /transactions/:id(.:format)
		 * @format   {:controller=>"transactions", :action=>"show"}
		 */
	}

	/**
	 * Load transaction with log_output
	 *
	 * @param type $id
	 *
	 * @return type
	 */
	public function load_with_output( $id ) {
		$this->id = $id;
		return $this->sendGet( ONAPP_GETRESOURCE_LOAD, null, array( 'log' => '' ) );
	}
}