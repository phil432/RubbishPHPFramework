<?php
require_once __dir__.'/../../Utils/Functions.php';
require_once __dir__.'/../../Config.php';
require_once __dir__.'/../../Routing/Actions.php';

class UriMatcher {
    protected $nodeArray;

    function __construct() {
        $this->nodeArray = loadJsonFromFile($GLOBALS['URI_NODE_JSON_PATH']);
    }

    /* Takes a URI. returns the appropriate action */
    function resolveUri($uriArray) {
        $resolvedNode = $this->nodeArray;
        $uriSuccessfullyResolved = false;
        $uriArraySize = sizeof($uriArray);

        for ($x = 0; $x < $uriArraySize; $x++) {
            $resolvedNode = $this->scanLevelForMatch($resolvedNode, $uriArray[$x]);
            if ($resolvedNode != null) {
                if (($uriArraySize == ($x + 1) || $resolvedNode->overRidingAction == true) && $resolvedNode->action != null) {
                    return $resolvedNode->action;
                }
            }
        }
        return PAGE_NOT_FOUND_ACTION;
    }

    /* Scans currently resolved URI level to see if next node can be resolved */
    function scanLevelForMatch($nodeArray, $uriSnippet) {
        if ($nodeArray) {
            foreach ($nodeArray as $node) {
                if (@preg_match($node->regexString, $uriSnippet)) {
                    return $node;
                }
            }
        }
        return null;
    }

    function checkIfNodeIsLeaf($resolvedNode) {

    }
}
