<?php

namespace App\Helpers;

use App\Configuration;
use Jumbojett\OpenIDConnectClient;


class OIDCHelper{
    

  public static function auth(){

    $efaas_url = env("EFAAS_URL", "somedefaultvalue");
    $efaas_client_id = env("EFAAS_CLIENT_ID", "default");
    $efaas_client_secret = env("EFAAS_CLIENT_SECRET", "default");
    $efaas_client_redirect_url = env("EFAAS_CLIENT_REDIRECT_URL", "default");

    $oidc = new OpenIDConnectClient($efaas_url, $efaas_client_id, $efaas_client_secret);
    $oidc->setRedirectURL($efaas_client_redirect_url);

    $oidc->setResponseTypes(array('code', 'id_token'));
    $oidc->addScope(array('openid', 'profile'));
    $oidc->addAuthParam(array('response_mode' => 'form_post'));
    
    $oidc->authenticate();

    return $oidc;

  }

}

