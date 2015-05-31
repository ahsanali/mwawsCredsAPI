<?php

if (!defined('MEDIAWIKI')) {
    exit(1);
}

require_once ( "$IP/includes/api/ApiBase.php" );

global $wgAPIModules;

/**
 * If set, this variable control which name the action will be available under, in
 * the API - default is 's3creds'
 */
global $wgMWS3CredsAPI_ActionName;

if (!isset($wgMWS3CredsAPI_ActionName) || is_null($wgMWS3CredsAPI_ActionName)) {
    $wgMWS3CredsAPI_ActionName = 's3creds';
}

$wgAPIModules[$wgMWS3CredsAPI_ActionName] = 'MWS3CredsAPI';


class MWS3CredsAPI extends ApiBase {


    private $ACTION_NAME;

    public function __construct($query, $moduleName) {
        parent :: __construct($query, $moduleName);
        global $wgMWS3CredsAPI_ActionName;
        $this->ACTION_NAME = $wgMWS3CredsAPI_ActionName;
    }

    public function execute() {
        global $wgUser;
        $r = new HttpRequest('http://169.254.169.254/latest/meta-data/iam/security-credentials/', HttpRequest::METH_GET);
        try {
            $r->send();
            if ($r->getResponseCode() == 200) {
                $role = $r->getResponseBody();
            $r = new HttpRequest('http://169.254.169.254/latest/meta-data/iam/security-credentials/'.$role, HttpRequest::METH_GET);
            $r->send();
            $this->getResult()->addValue(array($this->ACTION_NAME, 'results'), 'items', $r->getResponseBody(););  
            }
        } catch (HttpException $ex) {
            echo $ex;
        }
    }

}
