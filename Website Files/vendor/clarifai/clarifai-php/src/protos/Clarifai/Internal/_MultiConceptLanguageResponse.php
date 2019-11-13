<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/clarifai/api/concept_language.proto

namespace Clarifai\Internal;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>clarifai.api.MultiConceptLanguageResponse</code>
 */
class _MultiConceptLanguageResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.clarifai.api.status.Status status = 1;</code>
     */
    private $status = null;
    /**
     * Generated from protobuf field <code>repeated .clarifai.api.ConceptLanguage concept_languages = 2 [(.clarifai.api.utils.cl_show_if_empty) = true];</code>
     */
    private $concept_languages;

    public function __construct() {
        \GPBMetadata\Proto\Clarifai\Api\ConceptLanguage::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.clarifai.api.status.Status status = 1;</code>
     * @return \Clarifai\Internal\Status\_Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Generated from protobuf field <code>.clarifai.api.status.Status status = 1;</code>
     * @param \Clarifai\Internal\Status\_Status $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkMessage($var, \Clarifai\Internal\Status\_Status::class);
        $this->status = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .clarifai.api.ConceptLanguage concept_languages = 2 [(.clarifai.api.utils.cl_show_if_empty) = true];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getConceptLanguages()
    {
        return $this->concept_languages;
    }

    /**
     * Generated from protobuf field <code>repeated .clarifai.api.ConceptLanguage concept_languages = 2 [(.clarifai.api.utils.cl_show_if_empty) = true];</code>
     * @param \Clarifai\Internal\_ConceptLanguage[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setConceptLanguages($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Clarifai\Internal\_ConceptLanguage::class);
        $this->concept_languages = $arr;

        return $this;
    }

}
