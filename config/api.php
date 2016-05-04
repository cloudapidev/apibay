<?php
return array(
 		"apiUrl"=>"http://122.248.203.206:8080/RestCoreApi",
// 		"apiUrl"=>"http://192.168.2.244",
		
		//Numbers
		"numbers"=>array(
				//purchased Numbers
			'buyNumbers'=>"/v2/PurchasedPhoneNumbers",
			"editNumber"=>"/v2/PurchasedPhoneNumbers/",//   /v2/PurchasedPhoneNumbers/{number}
			"showList"=>"/v2/PurchasedPhoneNumbers",
			"showDetails"=>"/v2/PurchasedPhoneNumbers/{0}",//  /v2/PurchasedPhoneNumbers/{number}
			"doReleased"=>"/v2/PurchasedPhoneNumbers/{number}", //  /v2/PurchasedPhoneNumbers/{number}
				//Availabel Number
			"showIdleList"=>"/v2/AvailablePhoneNumbers/Idle",
			"showSelectedList"=>"/v2/AvailablePhoneNumbers/Selected",
			"doSelected"=>"/v2/AvailablePhoneNumbers/", //  /v2/AvailablePhoneNumbers/{number}
			"doRemoved"=>"/v2/AvailablePhoneNumbers/{number}",//    /v2/AvailablePhoneNumbers/{number}
		),
		//Trunks
		"trunks"=>array(
			"showList"=>"/v2/Trunks",
			"create"=>"/v2/Trunks", //create New
			"getInfo"=>"/v2/Trunks/", ///v2/Trunks/{sipTrunkId}  
			"editInfo"=>"/v2/Trunks/", ///v2/Trunks/{sipTrunkId}
			//Authentication ( Credentials )
			"addAuth"=>"/v2/Trunks/{sipTrunkId}/Credentials/{sipTrunkAuthId}" , //"addAuth"=>"/v2/Trunks/{0}/Credentials/{1}"
			"removeAuth"=>"/v2/Trunks/{sipTrunkId}/Credentials/{sipTrunkAuthId}",//"removeAuth"=>"/v2/Trunks/{0}/Credentials/{1}"
			"showAuthList"=>"/v2/Trunks/{sipTrunkId}/Credentials",
			"createAuth"=>"/v2/Credentials",
			"editAuth"=>"/v2/Credentials/{id}", ///v2/Credentials/{id}
			'selectAuthList'=>"/v2/Credentials/{0}", ///v2/Credentials/{sipTrunkId}
			"allAuthList"=>"/v2/Credentials",

			//IP Access 
			"addIpAccess"=>"/v2/Trunks/{0}/IpAccessControlLists/{1}",///v2/Trunks/{sipTrunkId}/IpAccessControlLists/{sipTrunkIpId}
			"selectedIpList"=>"/v2/Trunks/{0}/IpAccessControlLists",// /v2/Trunks/{sipTrunkId}/IpAccessControlLists
			"removeIpAccess"=>"/v2/Trunks/{0}/IpAccessControlLists/{1}", // /v2/Trunks/{sipTrunkId}/IpAccessControlLists/{sipTrunkIpId}
			"createIp"=>"/v2/IpAccessControlLists",
			"editIp"=>"/v2/IpAccessControlLists/{id}", ///v2/IpAccessControlLists/{id}
			"allTrunksIpList"=>"/v2/IpAccessControlLists/", ///v2/IpAccessControlLists/{sipTrunkId}
			"allIpList"=>"/v2/IpAccessControlLists", ///v2/IpAccessControlLists
			//
			"createOrigin"=>"/v2/Trunks/{0}/OriginationUrls", // /v2/Trunks/{trunk sid}/OriginationUrls
			"editOrigin"=>"/v2/Trunks/{0}/OriginationUrls/{1}", // /v2/Trunks/{trunk sid}/OriginationUrls/{id}
			"showAllOriginList"=>"/v2/Trunks/{0}/OriginationUrls", ///v2/Trunks/{trunk sid}/OriginationUrls

			//Assigned Numbers
			"AssignedPhoneNumbers"=>"/v2/Trunks/{sipTrunkId}/AssignedPhoneNumbers",
		),
		
		//serverApps
		"serverApps"=>array(
				"showList"=>"/v2/ServerApplications",//show List
				"createServerApp"=>"/v2/ServerApplications",
				"editServerApp"=>"/v2/ServerApplications/{0}",//v2/ServerApplications/{app_id}
				"removeApp"=>"/v2/ServerApplications/{0}",//v2/ServerApplications/{app_id}

		),
		//clientApps
	    "clientApps"=>array(
			"showList"=>"/v2/ClientApplications",
			"create"=>"/v2/ClientApplications", //create New

		)
);