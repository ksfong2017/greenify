<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/vision/v1/text_annotation.proto

namespace GPBMetadata\Google\Cloud\Vision\V1;

class TextAnnotation
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Cloud\Vision\V1\Geometry::initOnce();
        \GPBMetadata\Google\Api\Annotations::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0af00e0a2c676f6f676c652f636c6f75642f766973696f6e2f76312f7465" .
            "78745f616e6e6f746174696f6e2e70726f746f1216676f6f676c652e636c" .
            "6f75642e766973696f6e2e76311a1c676f6f676c652f6170692f616e6e6f" .
            "746174696f6e732e70726f746f2296040a0e54657874416e6e6f74617469" .
            "6f6e122b0a05706167657318012003280b321c2e676f6f676c652e636c6f" .
            "75642e766973696f6e2e76312e50616765120c0a04746578741802200128" .
            "091a3d0a1044657465637465644c616e677561676512150a0d6c616e6775" .
            "6167655f636f646518012001280912120a0a636f6e666964656e63651802" .
            "200128021ad5010a0d4465746563746564427265616b124c0a0474797065" .
            "18012001280e323e2e676f6f676c652e636c6f75642e766973696f6e2e76" .
            "312e54657874416e6e6f746174696f6e2e4465746563746564427265616b" .
            "2e427265616b5479706512110a0969735f70726566697818022001280822" .
            "630a09427265616b54797065120b0a07554e4b4e4f574e100012090a0553" .
            "504143451001120e0a0a535552455f5350414345100212120a0e454f4c5f" .
            "535552455f53504143451003120a0a0648595048454e1004120e0a0a4c49" .
            "4e455f425245414b10051ab1010a0c5465787450726f706572747912530a" .
            "1264657465637465645f6c616e67756167657318012003280b32372e676f" .
            "6f676c652e636c6f75642e766973696f6e2e76312e54657874416e6e6f74" .
            "6174696f6e2e44657465637465644c616e6775616765124c0a0e64657465" .
            "637465645f627265616b18022001280b32342e676f6f676c652e636c6f75" .
            "642e766973696f6e2e76312e54657874416e6e6f746174696f6e2e446574" .
            "6563746564427265616b22af010a045061676512450a0870726f70657274" .
            "7918012001280b32332e676f6f676c652e636c6f75642e766973696f6e2e" .
            "76312e54657874416e6e6f746174696f6e2e5465787450726f7065727479" .
            "120d0a057769647468180220012805120e0a066865696768741803200128" .
            "05122d0a06626c6f636b7318042003280b321d2e676f6f676c652e636c6f" .
            "75642e766973696f6e2e76312e426c6f636b12120a0a636f6e666964656e" .
            "636518052001280222e6020a05426c6f636b12450a0870726f7065727479" .
            "18012001280b32332e676f6f676c652e636c6f75642e766973696f6e2e76" .
            "312e54657874416e6e6f746174696f6e2e5465787450726f706572747912" .
            "3a0a0c626f756e64696e675f626f7818022001280b32242e676f6f676c65" .
            "2e636c6f75642e766973696f6e2e76312e426f756e64696e67506f6c7912" .
            "350a0a7061726167726170687318032003280b32212e676f6f676c652e63" .
            "6c6f75642e766973696f6e2e76312e506172616772617068123b0a0a626c" .
            "6f636b5f7479706518042001280e32272e676f6f676c652e636c6f75642e" .
            "766973696f6e2e76312e426c6f636b2e426c6f636b5479706512120a0a63" .
            "6f6e666964656e636518052001280222520a09426c6f636b54797065120b" .
            "0a07554e4b4e4f574e100012080a0454455854100112090a055441424c45" .
            "1002120b0a0750494354555245100312090a0552554c45521004120b0a07" .
            "424152434f4445100522cf010a0950617261677261706812450a0870726f" .
            "706572747918012001280b32332e676f6f676c652e636c6f75642e766973" .
            "696f6e2e76312e54657874416e6e6f746174696f6e2e5465787450726f70" .
            "65727479123a0a0c626f756e64696e675f626f7818022001280b32242e67" .
            "6f6f676c652e636c6f75642e766973696f6e2e76312e426f756e64696e67" .
            "506f6c79122b0a05776f72647318032003280b321c2e676f6f676c652e63" .
            "6c6f75642e766973696f6e2e76312e576f726412120a0a636f6e66696465" .
            "6e636518042001280222ce010a04576f726412450a0870726f7065727479" .
            "18012001280b32332e676f6f676c652e636c6f75642e766973696f6e2e76" .
            "312e54657874416e6e6f746174696f6e2e5465787450726f706572747912" .
            "3a0a0c626f756e64696e675f626f7818022001280b32242e676f6f676c65" .
            "2e636c6f75642e766973696f6e2e76312e426f756e64696e67506f6c7912" .
            "2f0a0773796d626f6c7318032003280b321e2e676f6f676c652e636c6f75" .
            "642e766973696f6e2e76312e53796d626f6c12120a0a636f6e666964656e" .
            "636518042001280222ad010a0653796d626f6c12450a0870726f70657274" .
            "7918012001280b32332e676f6f676c652e636c6f75642e766973696f6e2e" .
            "76312e54657874416e6e6f746174696f6e2e5465787450726f7065727479" .
            "123a0a0c626f756e64696e675f626f7818022001280b32242e676f6f676c" .
            "652e636c6f75642e766973696f6e2e76312e426f756e64696e67506f6c79" .
            "120c0a047465787418032001280912120a0a636f6e666964656e63651804" .
            "20012802427b0a1a636f6d2e676f6f676c652e636c6f75642e766973696f" .
            "6e2e7631421354657874416e6e6f746174696f6e50726f746f50015a3c67" .
            "6f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f67" .
            "6c65617069732f636c6f75642f766973696f6e2f76313b766973696f6ef8" .
            "0101a202044743564e620670726f746f33"
        ), true);

        static::$is_initialized = true;
    }
}
