<?php

class GeradorCurl
{

  static function obtemCurl($url, $httpMethod, $httpHeader, $dados = null) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeader);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $dados);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    assert(curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true));

    switch($httpMethod) {
      case "POST": curl_setopt($curl, CURLOPT_POST, 1);
      break;
      case "GET": curl_setopt($curl, CURLOPT_HTTPGET, true);
      break;
      case "PUT": curl_setopt($curl, CURLOPT_PUT, 1);
      break;
      default:
        throw new InvalidArgumentException("Método http inválido. Este deve ser 'POST','GET' ou 'PUT'");
    }
    return $curl;
  }

}
