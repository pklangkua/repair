<?php
function authenticate($user, $password){
	if(empty($user) || empty($password)) return false;
	
	$ldap_host = "ldap://129.10.15.2:389";
	
	$ldap_dn = "DC=dmh2,DC=go,DC=th";
	
	$ldap_user_group = "Users";
	
	$ldap_manager_group = "dmhcloud";
	
	$ldap_usr_dom = "@dmh2.go.th";
	
	$ldap = ldap_connect($ldap_host);
	
	ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3);
	ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);
 
	// verify user and password
	if($bind = @ldap_bind($ldap, $user.$ldap_usr_dom, $password)) {
		// valid
		// check presence in groups
		$filter = "(sAMAccountName=".$user.")";
		$attr = array("memberof","displayName");
		$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap, $result);
		$displayName = $entries[0]['displayname'];
       // $surname = $entries[0]['sn'];
		ldap_unbind($ldap);
 
		// check groups
		$access = 0;
		foreach($entries[0]['memberof'] as $grps) {
			// is manager, break loop
			if(strpos($grps, $ldap_manager_group)) { $access = 2; break; }
 
			// is user
			if(strpos($grps, $ldap_user_group)) $access = 1;
			//if(strpos($grps, $displayname)) $disname ;
		}
 
		if($access != 0) {
			// establish session variables
			$_SESSION['user'] = $user;
			$_SESSION['access'] = $access;
			$_SESSION['fullname'] = $displayName;
			return true;
		} else {
			// user has no rights
			return false;
		}
 
	} else {
		// invalid name or password
		return false;
	}
}
?>