<?php

namespace App;


class XLIFFDocument
{

    private $stringContent;

    private $xmlContent;

    private $content = array();

    private $body = array();

    private $language;

    /**
     * XLIFFDocument constructor.
     * @param $fileContent
     */
    function __construct($fileContent)
    {
        $this->stringContent = $fileContent;

        $this->xmlContent = simplexml_load_string($fileContent);

        $this->content = json_decode(json_encode($this->xmlContent), TRUE);

        $this->body = $this->content['file']['body'];
        $this->language = isset($this->content['@attributes']['lang']) ?
            $this->content['@attributes']['lang'] :
            (isset($this->content['file']['@attributes']['source-language']) ?
                $this->content['file']['@attributes']['source-language'] : "none");
    }

    /**
     * @return mixed
     */
    public function getStringContent()
    {
        return $this->stringContent;
    }

    /**
     * @param mixed $stringContent
     * @return XLIFFDocument
     */
    public function setStringContent($stringContent)
    {
        $this->stringContent = $stringContent;
        return $this;
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getXmlContent()
    {
        return $this->xmlContent;
    }

    /**
     * @param \SimpleXMLElement $xmlContent
     * @return XLIFFDocument
     */
    public function setXmlContent($xmlContent)
    {
        $this->xmlContent = $xmlContent;
        return $this;
    }

    /**
     * @return array|mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param array|mixed $content
     * @return XLIFFDocument
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param array $body
     * @return XLIFFDocument
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     * @return XLIFFDocument
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

}