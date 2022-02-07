<?php

use PHPUnit\Framework\TestCase;

class GeradorCurlTest extends TestCase
{

  /**
   * @test
   * @group obtemCurl
   */
  function obtemCurl() {
    $url = "http://exemplo.com";
    $contentType = "application/json";
    $curl = GeradorCurl::obtemCurl($url,"POST", ["Content-Type: $contentType"], json_encode(["foo" => "bar"]));
    self::assertEquals(
      $url,
      curl_getinfo($curl, CURLINFO_EFFECTIVE_URL)
    );
  }

  /**
   * @test
   * @group obtemCurl
   */
  function obtemCurlExceptionMetodoHttp() {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Método http inválido. Este deve ser 'POST','GET' ou 'PUT'");
    GeradorCurl::obtemCurl("http://exemplo.com","FOO",["Content-Type: application/json"],json_encode((["foo" => "bar"])));
  }

  /**
   * @test
   * @group obtemCurl
   * @doesNotPerformAssertions
   */
  function obtemCurlMetodoHttp() {
    GeradorCurl::obtemCurl("http://exemplo.com","GET",["Content-Type: application/json"],json_encode((["foo" => "bar"])));
    GeradorCurl::obtemCurl("http://exemplo.com","POST",["Content-Type: application/json"],json_encode((["foo" => "bar"])));
    GeradorCurl::obtemCurl("http://exemplo.com","PUT",["Content-Type: application/json"],json_encode((["foo" => "bar"])));
  }

  /**
   * @test
   * @group obtemCurl
   * @doesNotPerformAssertions
   */
  function obtemCurlDadosVazios() {
    GeradorCurl::obtemCurl("http:exemplo.com", "GET", ["Content-Type: application/json"]);
  }

}
