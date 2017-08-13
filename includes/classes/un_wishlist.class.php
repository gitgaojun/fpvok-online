<?php 

// File Location: /includes/classes/un_wishlist.class.php

// Include stuff
require_once('un_productlist.class.php');

/** 
 * handles wishlist functions
 *
 * @author untitled
 * @version 0.2
 * @since 0.2
 * @access public
 * @copyright untitled
 *
 */

class un_wishlist extends un_productlist {
    
    /** 
     * unique identifier for a wishlist
     *
     * @var integer
     * @access private
     * @see setWishlistId()
     */
    var $_iWishlistId;
    
    /** 
     * unique identifier for a customer
     *
     * @var integer
     * @access private
     * @see setCustomerId()
     */
    var $_iCustomerId;
    
    /** 
     * default page for errors
     *
     * @var string
     * @access public
     * @see $this->_oMessages->add()
     */
    var $_sName='header';
    
    /** 
     * fields for product list
     *
     * @var array
     * @access private
     * @see setStructure()
     */
    var $_aFields = array(
		'p2w.products_id',
		'w.customers_id',
		'p2w.created',
		'p2w.quantity',
		'p2w.priority',
		'p2w.comment',
		'p.products_price', 
		'p.products_tax_class_id',
		'p.products_image',
		'p.products_date_available',
		'pd.products_name',
		'pd.products_description',
	);
    
    /** 
     * structure for product list
     *
     * @var array
     * @access private
     * @see setStructure()
     */
    var $_aStructure = array(
		array(
			'label'			=>	UN_TABLE_HEADING_PRODUCTS,
			'field'			=>	'pd.products_name',
			'column_order'	=>	1,
			'default'		=>	true,
			'sortable'		=>	true,
			'command'		=>	'product',
		),
		array(
			'label'			=>	UN_TABLE_HEADING_PRICE,
			'field'			=>	'p.products_price',
			'column_order'	=>	2,
			'default'		=>	false,
			'sortable'		=>	true,
			'align'			=>	'right',
			'command'		=>	'price',
		),
		array(
			'label'			=>	UN_TEXT_PRIORITY,
			'field'			=>	'p2w.priority',
			'column_order'	=>	3,
			'default'		=>	false,
			'sortable'		=>	true,
			'align'			=>	'center',
			'command'		=>	'priority_menu_s',
		),
		array(
			'label'			=>	UN_TEXT_REMOVE,
			'field'			=>	'',
			'column_order'	=>	4,
			'default'		=>	false,
			'sortable'		=>	false,
			'align'			=>	'center',
			'command'		=>	'deletewish_checkbox',
		),
		array(
			'label'			=>	UN_TABLE_HEADING_BUY_NOW,
			'field'			=>	'',
			'column_order'	=>	5,
			'default'		=>	false,
			'sortable'		=>	false,
			'align'			=>	'center',
			'command'		=>	'addcart_checkbox',
		),
	);
    
    
    // CONSTRUCTOR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    
    /** 
     * class constructor
     *
     * @param integer $iPollId [optional] poll id
     * @access public
	/*----------------------------------------------------------*/
	function un_wishlist($iCustomerId=NULL) {
    	global $db, $messageStack;
        
        // implement db object
        $this->_oDB =& $db;
        $this->_oMessages =& $messageStack;
        
        // set unique identifier
        if (is_numeric($iCustomerId)) {
            $this->setCustomerId($iCustomerId);
            $this->setWishlistId();
        }
        
	}
    
    
    // PUBLIC METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    
    /**
     * set the _iCustomerId variable for the class
     *
     * @param integer $iCustomerId unique customer identifier
     * @access public
	/*----------------------------------------------------------*/
    function setCustomerId($iCustomerId) {
        
        if (is_numeric($iCustomerId)) {
            $this->_iCustomerId = (int)$iCustomerId;
        }
        
    }
    
    /**
     * set the _iWishlistId variable for the class
     *
     * @param integer $iWishlistId unique wishlist identifier
     * @access public
	/*----------------------------------------------------------*/
    function setWishlistId($iWishlistId=NULL) {
        
        if ( is_numeric($iWishlistId) ) {
            $this->_iWishlistId = (int)$iWishlistId;
        } elseif ( isset($this->_iCustomerId) ) {
        	$iWishlistId = $this->getDefaultWishlistId();
        	if ( !empty($iWishlistId) ) {
				$this->_iWishlistId = $iWishlistId;
        	} else {
        		return $this->_createDefaultWishlist();
        	}
        } else {
        	return false;
        }
        
        return true;
    }

	/** 
	 * get default wishlist id
	 *
     * @return integer $iWishlistId unique wishlist identifier
	 * @access public
	/*----------------------------------------------------------*/
	function getDefaultWishlistId($iCustomerId=NULL) {
	
		if ( !empty($iCustomerId) ) {
			$this->setCustomerId($iCustomerId);
		}
		
		if ( empty($this->_iCustomerId) ) {
			return false;
		}
		
		$sql = "SELECT 
					id 
				FROM 
					".UN_TABLE_WISHLISTS." w 
				WHERE 
					w.customers_id=".$this->_iCustomerId." 
					and w.default_status=1 
					";
		
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error getting default wishlist id.');
				return false;
		}
		
		return (int)$result->fields['id'];
	}
	
	function getWishlistId() {
		
		return $this->_iWishlistId;
	}
	
	function getCustomerData() {
	
		if ( !isset($this->_iWishlistId) || un_is_empty($this->_iWishlistId) ) {
			return false;
		}
		
		$sql = "SELECT 
					* 
				FROM 
					".UN_TABLE_WISHLISTS." w, 
					".TABLE_CUSTOMERS." c 
				WHERE 
					w.id=".$this->_iWishlistId." 
					and w.customers_id=c.customers_id 
					";
		
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error getting customer data.');
				return false;
		}
		
		return $result;
	}

	/** 
	 * get permission to view wishlist id
	 *
     * @param integer $iWishlistId unique wishlist identifier
     * @return boolean
	 * @access public
	/*----------------------------------------------------------*/
	function hasPermission() {
		
		if ( un_is_empty($this->_iWishlistId) ) {
			$this->_oMessages->add($this->_sName, 'You do not have permission.');
			return false;
		}
		
		if ( un_is_empty($this->_iCustomerId) ) {
			$this->_oMessages->add($this->_sName, 'You do not have permission.');
			return false;
		}		
		
		$sql = "SELECT 
					count(id) as items_count 
				FROM 
					".UN_TABLE_WISHLISTS." 
				WHERE 
					id='".$this->_iWishlistId."' 
					and customers_id='".$this->_iCustomerId."' 
				";
		
		$result = $this->_oDB->Execute($sql);
		if ( (int)$result->fields['items_count']==0 ) {
			$this->_oMessages->add($this->_sName, 'You do not have permission.');
				return false;
		}
		
		return true;
	}
    
    /** 
     * get a single wishlist
     *
     * @return array
     * @access public
	/*----------------------------------------------------------*/
    function getWishlist() {
        
        if ( $this->_iWishlistId ) {
        
			$sql = "SELECT 
						* 
					FROM 
						".UN_TABLE_WISHLISTS." w 
					WHERE 
						w.id=".$this->_iWishlistId." 
					";
					
			$result = $this->_oDB->Execute($sql);
			if ( !$result ) {
				$this->_oMessages->add($this->_sName, 'Error getting wishlist.');
				return false;
			}
        
        } else {
			$this->_oMessages->add($this->_sName, 'Error getting wishlist: id not set.');
        	return false;
        }
			
		return $result;
    }
    
    /** 
     * get wishlists associated with customer
     *
     * @return array
     * @access public
	/*----------------------------------------------------------*/
    function getWishlists() {
        
        if ( $this->_iCustomerId ) {
        
			$sql = "SELECT 
						w.id,
						w.customers_id,
						w.created,
						w.modified,
						w.name,
						w.comment,
						w.default_status,
						w.public_status,
						count(p.products_id) as items_count 
					FROM 
						".UN_TABLE_WISHLISTS." w 
					LEFT JOIN 
						".UN_TABLE_PRODUCTS_TO_WISHLISTS." p2w ON w.id=p2w.un_wishlists_id 
					LEFT JOIN 
						".TABLE_PRODUCTS." p ON p2w.products_id=p.products_id 
					WHERE 
						w.customers_id=".$this->_iCustomerId." 
					GROUP BY
						w.id 
					";
					
			$result = $this->_oDB->Execute($sql);
			if ( !$result ) {
				$this->_oMessages->add($this->_sName, 'Error getting wishlists.');
				return false;
			}
        
        } else {
			$this->_oMessages->add($this->_sName, 'Error getting wishlist: customer id not set.');
        	return false;
        }
			
		return $result;
    }
    
    /** 
     * get html select menu of customer's wishlists
     *
     * @return string -- html select menu of customer's wishlists
     * @access public
	/*----------------------------------------------------------*/	 
	function getWishlistMenu($sName, $sDefault = '', $sParameters = '') {
		
		$sql = "SELECT 
					w.id, 
					w.name 
				FROM 
					" . UN_TABLE_WISHLISTS . " w 
				WHERE 
					w.customers_id='".$this->_iCustomerId."' 
				ORDER BY 
					w.name 
				";
		
		$result = $this->_oDB->Execute($sql);
		
		while ( !$result->EOF ) {
			$aValues[] = array(
				'id' => $result->fields['id'],
				'text' => $result->fields['name']
				);
			$result->MoveNext();
		}
	
		return zen_draw_pull_down_menu($sName, $aValues, $sDefault, $sParameters);
	}
    
    /** 
     * find wishlists associated with customer data
     *
     * @return array
     * @access public
	/*----------------------------------------------------------*/
    function findWishlists($aArgs) {
        
		$sql = "SELECT 
					w.id, w.name, w.comment, w.public_status, c.customers_id, c.customers_firstname, c.customers_lastname, c.customers_email_address, ab.entry_city, ab.entry_state 
				FROM 
					".UN_TABLE_WISHLISTS." w, 
					".TABLE_CUSTOMERS." c, 
					".TABLE_ADDRESS_BOOK." ab 
				WHERE 
					c.customers_firstname like '".$aArgs['firstname']."' 
					and c.customers_lastname like '".$aArgs['lastname']."' 
					and c.customers_email_address like '".$aArgs['email']."' 
					and w.customers_id = c.customers_id 
					and c.customers_default_address_id = ab.address_book_id 
					and w.public_status=1 
				";
/* 				dump($sql); exit; */
				
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error finding wishlists.');
			return false;
		}
			
		return $result;
    }
    
    /** 
     * get a products in wishlist
     *
     * @return array
     * @access public
	/*----------------------------------------------------------*/
	function getProductsQuery() {
		
		$this->_sSqlFrom = "from ".UN_TABLE_WISHLISTS." w, ".UN_TABLE_PRODUCTS_TO_WISHLISTS." p2w, ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd ";
		
		$this->_sSqlWhere = "where w.id = '".$this->_iWishlistId."' 
			and pd.language_id = '".(int)$_SESSION['languages_id']."' 
			and p.products_status = 1 
			and w.id = p2w.un_wishlists_id 
			and p2w.products_id = p.products_id 
			and p2w.products_id = pd.products_id ";
			
		return parent::getProductsQuery();
    }

    /** 
     * determine if wishlist is accessible
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function isPublic() {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
        
        $sql = "SELECT 
                    public_status 
                FROM 
                    ".UN_TABLE_WISHLISTS." 
                WHERE 
                	id=".$this->_iWishlistId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error determining if wishlist is private.');
            return false;
        }
        
		if ( (int)$result->fields['public_status']==1 ) {
			return true;
		} else {
			return false;
		}
    }

    /** 
     * make default
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function makeDefault() {
		
		if ( !isset($this->_iCustomerId) ) {
			return false;
		}
        
        $sql = "UPDATE 
                    ".UN_TABLE_WISHLISTS." 
                SET 
                	default_status=0 
                WHERE 
                	customers_id=".$this->_iCustomerId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error zeroing default.');
            return false;
        }
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
        
        $sql = "UPDATE 
                    ".UN_TABLE_WISHLISTS." 
                SET 
                	default_status=1 
                WHERE 
                	id=".$this->_iWishlistId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error setting default.');
            return false;
        }
        
		return true;
    }

    /** 
     * make public
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function makePublic() {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
        
        $sql = "UPDATE 
                    ".UN_TABLE_WISHLISTS." 
                SET 
                	public_status=1 
                WHERE 
                	id=".$this->_iWishlistId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error making wishlist public.');
            return false;
        }
        
		return true;
    }

    /** 
     * make private
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function makePrivate() {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
        
        $sql = "UPDATE 
                    ".UN_TABLE_WISHLISTS." 
                SET 
                	public_status=0 
                WHERE 
                	id=".$this->_iWishlistId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error making wishlist private.');
            return false;
        }
        
		return true;
    }
    
	
    // PRIVATE METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::

    /** 
     * create default wishlist
     *
     * @return integer $iWishlistId unique wishlist identifier
     * @access private
	/*----------------------------------------------------------*/
    function _createDefaultWishlist() {
		
		$result = $this->createWishlist('Default', '', 1, 1);
		if ( $result===false ) {
			$this->_oMessages->add($this->_sName, 'Error creating default wishlist.');
			return false;
		}
		$this->_iWishlistId = $result;
		
		return $result;
	}

    /** 
     * determine if product is in wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function _inWishlist($products_id) {
        
        $sql = "SELECT 
                    count(p2w.products_id) AS items_count 
                FROM 
                    ".UN_TABLE_WISHLISTS." w, 
                    ".UN_TABLE_PRODUCTS_TO_WISHLISTS." p2w 
                WHERE 
                	w.customers_id=".$this->_iCustomerId." 
                	AND p2w.products_id=".$products_id." 
                	AND w.id=p2w.un_wishlists_id ";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error determining if product in wishlist.');
            return false;
        }
        
		if ( (int)$result->fields['items_count'] > 0 ) {
			return true;
		} else {
			return false;
		}
    }
    
     
    // INSERT METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::

    /** 
     * create a new wishlist
     *
     * @param string $name name for wishlist
     # @param string $comment comment for wishlist
     # @param boolean $default indicates default wishlist for customer
     * @return integer $iWishlistId unique wishlist identifier
     * @access public
	/*----------------------------------------------------------*/
    function createWishlist($name='', $comment='', $default_status=0, $public_status=1) {
		
		if ( !isset($this->_iCustomerId) ) {
			return false;
		}

		$sql = "INSERT INTO ".UN_TABLE_WISHLISTS." (
					`customers_id`, 
					`created`, 
					`modified`, 
					`name`, 
					`comment`, 
					`default_status`, 
					`public_status` 
				) VALUES (
					'".$this->_iCustomerId."', 
					NOW(), 
					NOW(), 
					'".$name."', 
					'".$comment."', 
					'".$default_status."', 
					'".$public_status."' 
				)";
  
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error creating wishlist.');
			return false;
		}
		
		return $this->_oDB->Insert_ID();
	}

    /** 
     * add wishlist
     *
     * @param array $aArgs notes item values
     * @return integer $iWishlistId unique wishlist identifier
     * @access public
	/*----------------------------------------------------------*/
    function addWishlist($aArgs) {
		
		if ( !isset($this->_iCustomerId) ) {
			return false;
		}

        // create new record
		$sql = "INSERT INTO ".UN_TABLE_WISHLISTS." (
					`customers_id`, 
					`created`, 
					`modified`, 
					`name`, 
					`comment`, 
					`public_status`
				) VALUES (
					'".$this->_iCustomerId."', 
					NOW(), 
					NOW(), 
					'".$aArgs['name']."', 
					'".$aArgs['comment']."', 
					'".$aArgs['public_status']."'
				)";
  
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error adding wishlist item.');
			return false;
		}
		
		return true;
	}

    /** 
     * edit wishlist
     *
     * @param array $aArgs notes item values
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
    function editWishlist($aArgs) {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}

        // create new record
		$sql = "UPDATE ".UN_TABLE_WISHLISTS." SET 
					modified=NOW(), 
					name='".$aArgs['name']."', 
					comment='".$aArgs['comment']."', 
					public_status='".$aArgs['public_status']."' 
				WHERE 
					id='".$this->_iWishlistId."' 
				";
  
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error editing wishlist item.');
			return false;
		}
		
		return true;
	}

    /** 
     * add a product to wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
    function addProduct($products_id, $quantity=1, $priority=2, $comment='') {

		if ( $this->_inWishlist($products_id) ) {
			$this->updateProduct($products_id, $quantity);
			
		} else {

			if ( !empty($this->_iWishlistId) ) {
				$sql = "INSERT INTO ".UN_TABLE_PRODUCTS_TO_WISHLISTS." (
							`products_id`, 
							`un_wishlists_id`, 
							`created`, 
							`modified`, 
							`quantity`, 
							`priority`, 
							`comment`
						) VALUES (
							'".$products_id."', 
							'".$this->_iWishlistId."', 
							NOW(), 
							NOW(), 
							'".$quantity."', 
							'".$priority."', 
							'".$comment."' 
						)";
      
				$result = $this->_oDB->Execute($sql);
				if ( !$result ) {
					$this->_oMessages->add($this->_sName, 'Error adding product to wishlist.');
					return false;
				}
			}
			return true;
		}
		
    }

    /** 
     * update quantity of product already in wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function updateProduct($products_id, $quantity=NULL, $priority=2, $comment='') {

		if ( empty($quantity) ) {
			return true;
		}

		if ( !empty($this->_iWishlistId) ) {
			$sql = "UPDATE ".UN_TABLE_PRODUCTS_TO_WISHLISTS."
                SET 
                	modified = NOW(), 
                	quantity = '".$quantity."', 
                	priority = '".$priority."', 
                	comment = '".$comment."' 
                WHERE 
                	products_id = '".$products_id."' 
                	AND un_wishlists_id = '".$this->_iWishlistId."' ";
			$this->_oDB->Execute($sql);
			return true;
		} else {
			return false;
		}
	}

    /** 
     * move product from one wishlist to another
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function moveProduct($products_id, $wishlists_id) {

		if ( !empty($this->_iWishlistId) ) {
			$sql = "UPDATE ".UN_TABLE_PRODUCTS_TO_WISHLISTS."
                SET 
                	modified = NOW(), 
                	un_wishlists_id = '".$wishlists_id."' 
                WHERE 
                	products_id = '".$products_id."' 
                	AND un_wishlists_id = '".$this->_iWishlistId."' ";
			$this->_oDB->Execute($sql);
			return true;
		} else {
			return false;
		}
	}

    
    
    // UPDATE METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::

    /** 
     * delete a wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function deleteWishlist() {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
		
		if ( $this->_iWishlistId==$this->getDefaultWishlistId() ) {
			$this->_oMessages->add($this->_sName, 'Cannot delete default wishlist.');
			return false;
		}

		$sql = "DELETE FROM 
					".UN_TABLE_WISHLISTS." 
				WHERE 
					id='".$this->_iWishlistId."' 
				";
        
        $result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error deleting wishlist.');
            return false;
        }
        
        return true;
	}

    /** 
     * remove a product from wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function removeProduct($products_id) {
		
		// Remove from database
		if ( !empty($this->_iWishlistId) ) {
			$sql = "delete from ".UN_TABLE_PRODUCTS_TO_WISHLISTS." where un_wishlists_id = '".$this->_iWishlistId."' and products_id = '".$products_id."'";
			
			$result = $this->_oDB->Execute($sql);
			if ( !$result ) {
				$this->_oMessages->add($this->_sName, 'Error deleting product from wishlist.');
				return false;
			}
		}
		
		return true;
	}


} // end class

?>